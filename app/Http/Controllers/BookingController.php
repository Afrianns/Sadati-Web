<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\User;
use Midtrans\Config;
use Midtrans\Snap;

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
            $result = Booking::with('user')->where('user_id', auth()->user()->id)->get();
        }

        $packages = Package::all();
        return view('booking', ['title' => 'Booking', 'books' => $result, 'packages' => $packages]);
    }

    // create booking data by users
    public function create() {

        $res = request()->validate([
            'date' => ['required'],
            'time' => ['required'],
            'place' => ['required', 'min:5'],
            'package' => ['required']
        ]);

        // dd($res, request('package'));
        
        Booking::create([
            'user_id' => auth()->user()->id,
            'package_id' => request('package'),
            'date' => request('date'),
            'time' => request('time'),
            'place' => request('place')
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
                $result = $result->orderBy("created_at",'asc'); 
            } else {
                $result = $result->orderBy("created_at", 'desc'); 
            }

            $result = $result->get();
            return view("admin/confirm", ['title' => 'BUTUH KONFIRMASI', 'bookings' => $result]);

        } else{   
            return redirect("admin");
        }
    }
    
    // confirmed page for admin 
    public function confirmed() 
    {
        // check if url param sort is exist & if didnt then add default value 
        if(!isset($_GET["sort"])){
            $param = 'terdekat';
        } else{
            $param = $_GET['sort'];
        }

        if (Gate::denies('admin')){
            return redirect()->back();
        }
         // check if url param is 'terdekat' or 'terlama' & if not prevent from use those url param & redirect 
         if($param == 'terdekat' || $param == 'terlama'){
             $result = Booking::with('user')->where('isConfirmed', true);
             if($param == 'terdekat'){
                $result = $result->orderBy("date",'asc'); 
            } else {
                $result = $result->orderBy("date", 'desc'); 
            }
            $result = $result->get();

            return view("admin/confirmed", ['title' => 'TERKONFIRMASI','bookings' => $result]);
         } else{
            return view("admin/confirmed");
         }
    }


    // controller 'patch' for accept or reject user's booking with boolean value
    public function Confirmation()
    {
        if (Gate::denies('admin')){
            return redirect()->back();
        }
        
        $result = Booking::where('id', request('booking_id'))->update([
            'isConfirmed' => request('value'),
            'token' => $this->payment()
        ]);

        if($result) {
            toast("berhasil diterima", 'success');  
            return redirect('admin/confirmed');
        } else{
            toast("berhasil ditolak", 'success');  
            return redirect('admin/confirm');

        }

        toast("Proses konfirmasi gagal", 'error');   
        return redirect()->back();
    }

    // controller delete for user if not yet confirmed or rejected (cannot delete if its already accepted)
    public function delete_by_user()
    {

        $result = Booking::where('id', request('booking_id'))->delete();
        if ($result){
            toast("Data booking berhasil dihapus", 'success');
            return redirect()->back();
        }
        toast("Data booking gagal dihapus", 'error');
    }

    // payment method
    public function payment()
    {
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => 1000,
            ],
            'customer_details' => [
                'first_name' => 'budi',
                'last_name' => 'pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ],
        ];
        
        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
