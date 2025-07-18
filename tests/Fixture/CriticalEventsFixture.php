<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CriticalEventsFixture
 */
class CriticalEventsFixture extends TestFixture
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
                'uuid' => '5647ed8c-148e-4fff-9332-be6d06baba76',
                'device_id' => 1,
                'temperature' => 1,
                'humidity' => 1,
                'current_reading' => 1,
                'gps_x' => 1,
                'gps_y' => 1,
                'status' => 'Lorem ip',
                'critical_label' => 'Lorem ipsum dolor ',
                'timestamp' => '2025-07-17 13:11:34',
            ],
        ];
        parent::init();
    }
}
