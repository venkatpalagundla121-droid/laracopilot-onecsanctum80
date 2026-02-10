<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Floor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'hostel_id',
        'floor_number',
        'floor_name',
        'total_rooms',
        'description',
        'is_active'
    ];

    protected $casts = [
        'floor_number' => 'integer',
        'total_rooms' => 'integer',
        'is_active' => 'boolean'
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