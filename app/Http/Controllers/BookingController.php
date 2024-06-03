<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    // redirect user admin to unconfirmed bookings page
    public function index()
    {
        return redirect('/admin/confirm');
    }

    // booking controller page for guest & login user if there are bookings  
    function booking()
    {
        $result = null;

        if(auth()->check()){
            $result = Booking::with('user')->where('user_id', auth()->user()->id)->get();
        }
        return view('booking', ['title' => 'Booking', 'books' => $result]);
    }

    // create booking data by users
    public function create() {

        request()->validate([
            'date' => ['required'],
            'time' => ['required'],
            'place' => ['required']
            
        ]);
    
        Booking::create([
            'user_id' => auth()->user()->id,
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

        // check if url param is 'terbaru' or 'terlama' & if not prevent from use those url param & redirect 
        if($param == 'terbaru' || $param == 'terlama'){
            $result = Booking::with('user')->where('isConfirmed', null);
            
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
        ]);

        if($result) {
            if(request('booking_id') == '1'){  
                toast("berhasil diterima", 'success');  
                return redirect('admin/confirmed');
            } else{
                toast("berhasil ditolak", 'success');  
                return redirect('admin/confirm');
            }
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
}
