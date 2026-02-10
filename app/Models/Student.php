<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'guardian_name',
        'guardian_phone',
        'bed_id',
        'admission_date',
        'monthly_fee'
    ];
    
    protected $casts = [
        'admission_date' => 'date',
        'monthly_fee' => 'decimal:2'
    ];
    
    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }
}