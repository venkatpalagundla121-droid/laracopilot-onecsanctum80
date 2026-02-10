<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hostel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'location_id',
        'address',
        'contact_number',
        'email',
        'total_floors',
        'description',
        'is_active'
    ];

    protected $casts = [
        'total_floors' => 'integer',
        'is_active' => 'boolean'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function floors()
    {
        return $this->hasMany(Floor::class);
    }

    public function financialTransactions()
    {
        return $this->hasMany(FinancialTransaction::class);
    }
}