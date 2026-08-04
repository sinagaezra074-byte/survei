<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SidebarRecord extends Model
{
    protected $fillable = [
        'sidebar_id',
    ];

    public function sidebar(): BelongsTo
    {
        return $this->belongsTo(Sidebar::class);
    }

    public function values(): HasMany
    {
        return $this->hasMany(SidebarRecordValue::class, 'record_id');
    }
}
