<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'floor_id',
        'room_number',
        'room_type',
        'bed_capacity',
        'rent_per_bed',
        'amenities',
        'is_active'
    ];

    protected $casts = [
        'bed_capacity' => 'integer',
        'rent_per_bed' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function beds()
    {
        return $this->hasMany(Bed::class);
    }

    public function availableBeds()
    {
        return $this->hasMany(Bed::class)->where('is_occupied', false)->where('status', 'Available');
    }
}