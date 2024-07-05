<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class PaymentController extends Controller
{

    public function successPay(string $id, string $data)
    {
        $data_decode = json_decode($data);

        if($data_decode->status_code == 200){

                $array_data = [
                    'transaction_id' => $data_decode->transaction_id,
                    'order_id' => $data_decode->order_id,
                    'gross_amount' => $data_decode->gross_amount,
                    'payment_type' => $data_decode->payment_type,
                    'transaction_time' => $data_decode->transaction_time,
                    'transaction_status' => $data_decode->transaction_status,
                    'booking_id' => $id,
            ];
            
            $result = Payment::create($array_data);

            if($result){
                toast($data_decode->status_message,'success');
            }
        }
        
        return redirect('/booking');
        // Log::info(json_encode($data->all()));
        // return response()->json(['data' => $data->all()]);
        // $result = Booking::where('id', $id)->update(['status' => 'Berhasil']);

        // if($result){
        //     toast('Pembayaraan berhasil', 'success');
        // }
        
        // return $result;
    }

    public function failedPay()
    {
        toast('Pembayaraan Gagal', 'error');
        return view('booking');
    }


    public function invoice(Request $request)
    {


        
        $result = Booking::find($request['id']);
        $buyedPackage = "" . $result->package->category ."-". $result->package->type."";
        
        // dd($result->user, $result->payment, $result->package);
        
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

        $item = InvoiceItem::make($buyedPackage)->quantity(1)->pricePerUnit($result->payment->gross_amount);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->notes($notes)
            ->status('Terbayar')
            ->addItem($item);

        return $invoice->stream();
    }
}
