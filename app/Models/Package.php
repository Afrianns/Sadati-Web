<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'type',
        'price',
        'sub_type',
        'description',
    ];


    public function booking(): HasOne
    {
        return $this->HasOne(Booking::class);   
    }
}
