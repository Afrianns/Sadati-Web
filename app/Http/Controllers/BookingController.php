<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    public function index()
    {
        return redirect('/admin/confirm');
    }

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
    
    public function confirm()
    {

        if (Gate::denies('admin')){
            return redirect()->back();
        }
        
        $result = Booking::with('user')->where('isConfirmed',null)->get();
        return view("admin/confirm", ['title' => 'BUTUH KONFIRMASI', 'bookings' => $result]);
    }
    
    public function confirmed() 
    {
        if (Gate::denies('admin')){
            return redirect()->back();
        }
        $result = Booking::with('user')->where('isConfirmed', true)->get();
        return view("admin/confirmed", ['title' => 'TERKONFIRMASI','bookings' => $result]);
    }


    public function Confirmation()
    {
        if (Gate::denies('admin')){
            return redirect()->back();
        }

        $result = Booking::where('id', request('booking_id'))->update([
            'isConfirmed' => request('value'),
        ]);

        if($result) {
            toast("Konfirmasi berhasil", 'success');   
            return redirect('admin/confirmed');
        }

        toast("Konfirmasi gagal", 'error');   
        return redirect()->back();
    }

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
