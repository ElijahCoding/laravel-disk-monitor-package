<?php

namespace Spatie\DiskMonitor\Commands;

use Illuminate\Console\Command;

class RecordDiskMetrics extends Command
{
    public $signature = 'disk-monitor:record-metrics';

    public $description = 'Record the metrics of a disk.';

    public function handle()
    {
        $this->comment('Recording metrics.....');

        $this->comment('All done');
    }
}
