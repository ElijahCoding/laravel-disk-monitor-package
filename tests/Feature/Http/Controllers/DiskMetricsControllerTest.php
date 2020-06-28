<?php

namespace Spatie\DiskMonitor\Tests\Feature\Http\Controllers;

use Spatie\DiskMonitor\Tests\TestCase;

class DiskMetricsControllerTest extends TestCase
{
    public function test_it_can_display_list_of_entries()
    {
        $this->get('disk-monitor')
            ->assertOk();
    }
}
