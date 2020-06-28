<?php

namespace Spatie\DiskMonitor;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Spatie\DiskMonitor\DiskMonitor
 */
class DiskMonitorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'disk-monitor';
    }
}
