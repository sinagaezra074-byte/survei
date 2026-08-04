<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sidebar extends Model
{
    protected $fillable = [
        'nama_menu',
        'slug',
        'route',
        'deskripsi',
        'urutan',
        'parent_id',
        'status',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Sidebar::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Sidebar::class, 'parent_id')
            ->orderBy('urutan');
    }

    public function fields(): HasMany
    {
        return $this->hasMany(SidebarField::class)
            ->orderBy('urutan');
    }

    public function records(): HasMany
    {
        return $this->hasMany(SidebarRecord::class);
    }
}
