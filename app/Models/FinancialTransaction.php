<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    protected $fillable = [
        'type',
        'description',
        'amount',
        'category',
        'transaction_date'
    ];
    
    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'date'
    ];
}