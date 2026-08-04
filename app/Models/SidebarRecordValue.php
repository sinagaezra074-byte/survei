<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SidebarRecordValue extends Model
{
    protected $fillable = [
        'record_id',
        'field_id',
        'value',
    ];

    public function record(): BelongsTo
    {
        return $this->belongsTo(SidebarRecord::class, 'record_id');
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(SidebarField::class, 'field_id');
    }
}
