<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bed extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'room_id',
        'bed_number',
        'bed_type',
        'status',
        'is_occupied'
    ];

    protected $casts = [
        'is_occupied' => 'boolean'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function markAsOccupied()
    {
        $this->update([
            'is_occupied' => true,
            'status' => 'Occupied'
        ]);
    }

    public function markAsAvailable()
    {
        $this->update([
            'is_occupied' => false,
            'status' => 'Available'
        ]);
    }
}