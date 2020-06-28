<?php

namespace Spatie\DiskMonitor\Tests\Feature\Commands;

use Illuminate\Support\Facades\Storage;
use Spatie\DiskMonitor\Commands\RecordDiskMetricsCommand;
use Spatie\DiskMonitor\Models\DiskMonitorEntry;
use Spatie\DiskMonitor\Tests\TestCase;

class RecordDiskMetricsCommandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');
        Storage::fake('anotherDisk');
    }

    public function test_it_will_record_the_file_count_for_sinlge_disk()
    {
        $this->artisan(RecordDiskMetricsCommand::class)
            ->assertExitCode(0);
        $entry = DiskMonitorEntry::last();
        $this->assertEquals(0, $entry->file_count);

        Storage::disk('local')->put('test.txt', 'text');
        $this->artisan(RecordDiskMetricsCommand::class)
            ->assertExitCode(0);
        $entry = DiskMonitorEntry::last();
        $this->assertEquals(1, $entry->file_count);
    }

    public function test_it_will_record_the_file_count_for_multiple_disks()
    {
        config()->set('disk-monitor.disk_names', ['local', 'anotherDisk']);
        Storage::disk('anotherDisk')->put('text.txt', 'test');

        $this->artisan(RecordDiskMetricsCommand::class)
            ->assertExitCode(0);
        $entries = DiskMonitorEntry::get();
        $this->assertCount(2, $entries);

        $this->assertEquals('local', $entries[0]->disk_name);
        $this->assertEquals(0, $entries[0]->file_count);

        $this->assertEquals('anotherDisk', $entries[1]->disk_name);
        $this->assertEquals(1, $entries[1]->file_count);
    }
}
