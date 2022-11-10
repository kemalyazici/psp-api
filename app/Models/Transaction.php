<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transactionId',
        'status',
        'operation',
        'paymentMethod',
        'date',
        'user_id',
        'customer_id',
        'amount',
        'currency'
    ];
    use HasFactory;
}
