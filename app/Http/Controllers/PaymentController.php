<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{

    public function successPay(string $id)
    {
        $result = Booking::where('id', $id)->update(['status' => 'Berhasil']);

        if($result){
            toast('Pembayaraan berhasil', 'success');
        }
        
        return redirect('booking');
    }

    public function failedPay()
    {
        toast('Pembayaraan Gagal', 'error');
        return view('booking');
    }
}
