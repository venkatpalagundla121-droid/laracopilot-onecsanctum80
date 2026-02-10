<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role_id',
        'assigned_locations',
        'is_active',
        'last_login_at'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'assigned_locations' => 'array',
        'is_active' => 'boolean',
        'last_login_at' => 'datetime'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($permission)
    {
        return $this->role && $this->role->hasPermission($permission);
    }

    public function isSuperAdmin()
    {
        return $this->role && $this->role->name === 'superadmin';
    }

    public function isAdmin()
    {
        return $this->role && $this->role->name === 'admin';
    }

    public function isWorker()
    {
        return $this->role && $this->role->name === 'worker';
    }

    public function canAccessLocation($locationId)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        return in_array($locationId, $this->assigned_locations ?? []);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}