<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionSidebar extends Model
{
    protected $fillable = [
        'permission_id',
        'sidebar_name',
        'is_allowed',
    ];

    protected $casts = [
        'is_allowed' => 'boolean',
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
