<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $fillable = [
        'hostel_id',
        'floor_number',
        'floor_name',
        'total_rooms'
    ];
    
    protected $casts = [
        'floor_number' => 'integer',
        'total_rooms' => 'integer'
    ];
    
    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }
    
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}