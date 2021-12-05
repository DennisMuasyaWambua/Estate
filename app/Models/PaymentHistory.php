<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;
    protected $table = 'occupant_payments';
    protected $fillable = [
        'sender_id',
        'receipt_id',
        'amount',
        'created_at',
    ];
}
