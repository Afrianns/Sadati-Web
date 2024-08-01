<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\User;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{

    public function __construct()
    {
        // Set your Merchant Server Key
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = env('IS_PRODUCTION');
        // Set sanitization on (default)
        Config::$isSanitized = env('IS_SANITIZED');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = env('IS_3DS');

        // Config::$overrideNotifUrl = 'https://www';
    }

    // redirect user admin to unconfirmed bookings page
    public function index()
    {
        // return view('admin/admin-home', ['title' => "Beranda"]);
        return redirect('/admin/confirm');
    }

    // booking controller page for guest & login user if there are bookings  
    function booking()
    {
        $result = null;

        if(auth()->check()){
            // dd(auth()->user);
            $result = Booking::with('user','payment')->where('user_id', auth()->user()->id)->paginate(5);
        }

        $packages = Package::all();
        return view('booking', ['title' => 'Booking', 'bookings' => $result, 'packages' => $packages]);
    }

    // create booking data by users
    public function create(Request $request) {

        $data = Package::find($request->package);

        $res = $request->validate([
            'date' => ['required'],
            'time' => ['required'],
            'place' => ['required', 'min:5'],
            'package' => ['required']
        ]);

        
        Booking::create([
            'user_id' => auth()->user()->id,
            'package_id' => $res['package'],
            'date' => $res['date'],
            'time' => $res['time'],
            'price' => $data->price,
            'place' => $res['place'],
            'note' => $request->note
        ]);
        
        toast("Booking anda telah dibuat <br>Silahkan tunggu konfirmasi dari kami",'success');
        return redirect()->back();
    }
    // unconfirm booking page that need admin to confirm
    public function confirm()
    {
        // check if url param sort is exist & if didnt then add default value 
        if(!isset($_GET["sort"])){
            $param = 'terbaru';
        } else{
            $param = $_GET['sort'];
        }

        // denies if login user isnt admin
        if (Gate::denies('admin')){
            return redirect()->back();
        }

        // check if url param is 'terbaru' or 'terlama' & if not match prevent from use those url param & redirect 
        if($param == 'terbaru' || $param == 'terlama'){
            $result = Booking::with(['user','package'])->where('isConfirmed', null);
            
            if($param == 'terbaru'){
                $result = $result->orderBy("created_at",'desc'); 
            } else {
                $result = $result->orderBy("created_at", 'asc'); 
            }

            $result = $result->get();
            // dd($result);
            return view("admin/confirm", ['title' => 'BUTUH KONFIRMASI', 'bookings' => $result]);

        } else{   
            return redirect("admin");
        }
    }
    
    // confirmed page for admin 
    public function confirmed() 
    {
        // dd(request()->all());

        // check if url param sort is exist & if didnt then add default value 
        if(!isset($_GET["sort"]) && !isset($_GET['Ptype'])){
            $sort = 'terdekat';
            $type = 'paid';
        } else{
            $sort = $_GET['sort'];
            $type = $_GET['Ptype'];
        }

        if (Gate::denies('admin')){
            return redirect()->back();
        }
        $result = Booking::with('user','payment','package')->where('isConfirmed', true)->where('isFinished', null);

        $isSort = $sort == 'terdekat' || $sort == 'terlama';
        $isType = $type == 'paid' || $type == 'unpaid';

        $count = $result->get();

         // check if url param is 'terdekat' or 'terlama' & if not prevent from use those url param & redirect 
         if($isSort && $isType){
            // dd($sort, $type);
            if($type == 'paid'){
                $result = $result->has('payment');
            } else{
                $result = $result->doesntHave('payment');
            }
        
             if($sort == 'terdekat'){
                $result = $result->orderBy("date",'asc'); 
            } else {
                $result = $result->orderBy("date", 'desc'); 
            }

            $result = $result->get();

        } 
        return view("admin/confirmed", ['title' => 'TERKONFIRMASI','bookings' => $result, 'total' => $count]);
    }

    public function addHistoryPost(Request $request)
    {
        // dd($request->all());   
        $result = Booking::where("id", $request->booking_id)->update([
            'isFinished' => true,
            'admin_note' => $request->admin_note
        ]);

        if($result){
            toast('Berhasil Ditutup <br> bisa dicek di daftar riwayat', 'success');
        } else{            
            toast('Gagal Ditutup', 'error');
        }

        return redirect('admin/confirmed');
    }

    public function history()
    {

        // check if parameter if exist or not
        // if(!isset($_GET['Ptype'])){
        //     $type = 'paid';
        // } else{
        //     $type = $_GET['Ptype'];
        // }

        $result = Booking::where("isFinished", true)->orWhere("isConfirmed", false);

        return view('admin/history', ['title' => "Riwayat",'completedBooks' => $result->get()]);
    }


    // controller 'patch' for accept or reject user's booking with boolean value
    public function Confirmation()
    {
        if (Gate::denies('admin')){
            return redirect()->back();
        }

        $token = null;

        // if reservation get acc then call payment token
        if(request("value") == 1){
            $token = $this->payment(request('booking_id'));
        }

        // $this->payment(request('booking_id'));
        $result = Booking::where('id', request('booking_id'))->update([
            'isConfirmed' => request('value'),
            'token' => $token,
            'admin_note' => request('admin_note')
        ]);

        if($result) {
            if(request('value') == 1) {
                toast("berhasil diterima", 'success');  
                return redirect('admin/confirmed');
            } else if(request('value') == 0){
                toast("berhasil ditolak", 'success');  
                return redirect('admin/confirm');
            }
        }

        toast("Proses konfirmasi gagal", 'error');   
        return redirect('admin/confirm');
    }

    // controller delete for user if not yet confirmed or rejected (cannot delete if its already accepted)
    public function delete_by_user()
    {

        $result = Booking::find(request('booking_id'));
        
        // delete the file
        if($result->payment){
            if(File::exists("storage/" . $result->payment->file_name)){
                File::delete("storage/" . $result->payment->file_name);
            }
        }
        
        // delete the booking
        $result->delete();

        if ($result){
            toast("Data booking berhasil dihapus", 'success');
            return redirect()->back();
        }
        toast("Data booking gagal dihapus", 'error');
    }

    // payment method
    public function payment(string $id)
    {
        
        $result = Booking::find($id);
        // dd($result->package);

        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'type' => $result->package->type,
                'category' => $result->package->category,
                'gross_amount' => $result->package->price,
            ],
            'customer_details' => [
                'name' => $result->user->name,
                'address' => $result->user->address,
                'email' => $result->user->email,
                'phone' => $result->user->phone_number,
            ],

            // "callbacks" => [
            //      "finish" => env("APP_URL")
            // ]
        ];
        
        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
