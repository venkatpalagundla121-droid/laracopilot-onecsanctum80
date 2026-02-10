<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'pincode',
        'contact_number',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function hostels()
    {
        return $this->hasMany(Hostel::class);
    }

    public function activeHostels()
    {
        return $this->hasMany(Hostel::class)->where('is_active', true);
    }
}