<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'guardian_name',
        'guardian_phone',
        'guardian_email',
        'bed_id',
        'admission_date',
        'checkout_date',
        'monthly_fee',
        'security_deposit',
        'payment_status',
        'notes',
        'is_active'
    ];

    protected $casts = [
        'admission_date' => 'date',
        'checkout_date' => 'date',
        'monthly_fee' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }

    public function financialTransactions()
    {
        return $this->hasMany(FinancialTransaction::class);
    }

    protected static function booted()
    {
        static::created(function ($student) {
            $student->bed->markAsOccupied();
        });

        static::deleted(function ($student) {
            $student->bed->markAsAvailable();
        });
    }
}