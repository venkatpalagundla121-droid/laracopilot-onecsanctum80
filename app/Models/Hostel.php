<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    protected $fillable = [
        'name',
        'location_id',
        'address',
        'contact_number',
        'total_floors'
    ];
    
    protected $casts = [
        'total_floors' => 'integer'
    ];
    
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    
    public function floors()
    {
        return $this->hasMany(Floor::class);
    }
}