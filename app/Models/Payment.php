<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    
    protected $fillable = ['booking_id','transaction_id','order_id','gross_amount','payment_type','transaction_time','transaction_status','file_name'];

    public function booking() : BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
