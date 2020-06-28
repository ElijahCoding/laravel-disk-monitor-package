<?php

namespace Spatie\DiskMonitor\Models;

use Illuminate\Database\Eloquent\Model;

class DiskMonitorEntry extends Model
{
    protected $guarded = [];

    public static function last(): ?self
    {
        return static::orderByDesc('id')->first();
    }
}
