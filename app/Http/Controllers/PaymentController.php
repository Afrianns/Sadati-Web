<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use App\Mail\MailableVerification;
use Illuminate\Support\Facades\Mail;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class PaymentController extends Controller
{
    public function successPay(string $booking_id, string $data)
    {
        // store the array to database
        $data_decode = json_decode($data);

        if($data_decode->status_code == 200){
            
            $file_name = $this->invoice($booking_id, $data_decode->transaction_time, $data_decode->gross_amount);
            
                $array_data = [
                    'transaction_id' => $data_decode->transaction_id,
                    'order_id' => $data_decode->order_id,
                    'gross_amount' => $data_decode->gross_amount,
                    'payment_type' => $data_decode->payment_type,
                    'transaction_time' => $data_decode->transaction_time,
                    'transaction_status' => $data_decode->transaction_status,
                    'booking_id' => $booking_id,
                    'file_name' => $file_name,
            ];
            
            $result = Payment::create($array_data);

            if($result){
                toast('Transaksi berhasil','success');
            }
        }


        Mail::to(auth()->user()->email)->send(new MailableVerification(auth()->user()->name, $file_name));
        
        return redirect('/booking');
    }

    public function failedPay(string $data)
    {
        toast('Pembayaraan Gagal <br> Silahkan coba lagi atau buat reservasi baru', 'error');
        return redirect('/booking');
    }


    public function invoice(string $booking_id, string $transaction_time, string $gross_amount)
    {
        $result = Booking::find($booking_id);
        $buyedPackage = "" . $result->package->category ." - ". $result->package->type."";
                
        $notes = [
            'Trimakasih sudah menggunakan jasa kami',
            'Sadati Photography',
        ];
        $notes = implode("<br>", $notes);

        $customer = new Buyer([
            'custom_fields' => [
                'Nama Pelanggan'=> $result->user->name,
                'email' => $result->user->email,
                'Alamat' => $result->user->address,
                'Nomor HP' => $result->user->phone_number,
            ],
        ]);

        $inital = new Carbon($transaction_time);
        $date = $inital->isoFormat('DD MMMM Y h-m-s');

        $file_name = str_replace(' ','_',$result->user->name . '_' . $date);
        $item = InvoiceItem::make($buyedPackage)->quantity(1)->pricePerUnit($gross_amount);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->notes($notes)
            ->date($inital)
            ->status('Terbayar')
            ->addItem($item)
            ->filename($file_name)
            ->save('public');

        return $invoice->filename;
    }
}
