<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'floor_id',
        'room_number',
        'room_type',
        'bed_capacity'
    ];
    
    protected $casts = [
        'bed_capacity' => 'integer'
    ];
    
    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }
    
    public function beds()
    {
        return $this->hasMany(Bed::class);
    }
}