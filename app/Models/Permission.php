<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];

    public function sidebars()
    {
        return $this->hasMany(PermissionSidebar::class);
    }

    public function actions()
    {
        return $this->hasMany(PermissionAction::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
