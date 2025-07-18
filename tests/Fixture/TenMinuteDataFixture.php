<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TenMinuteDataFixture
 */
class TenMinuteDataFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'uuid' => 'f06a149b-25c7-4274-9a1c-12907c948aa4',
                'device_id' => 1,
                'temperature' => 1,
                'humidity' => 1,
                'current_reading' => 1,
                'status' => 1,
                'GpsX' => 1,
                'GpsY' => 1,
                'timestamp' => '2025-07-17 14:28:37',
            ],
        ];
        parent::init();
    }
}
