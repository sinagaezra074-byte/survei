<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SidebarField extends Model
{
    protected $fillable = [
        'sidebar_id',
        'nama_field',
        'tipe_field',
        'required',
        'placeholder',
        'default_value',
        'urutan',
        'status'
    ];

    public function sidebar(): BelongsTo
    {
        return $this->belongsTo(Sidebar::class);
    }
    public function values()
    {
        return $this->hasMany(SidebarRecordValue::class, 'field_id');
    }
}
