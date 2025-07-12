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
                'uuid' => 'b0469968-ef2a-46e0-b2a8-19cbd1d3e47c',
                'device_id' => 1,
                'temperature' => 1,
                'humidity' => 1,
                'current_reading' => 1,
                'status' => 1,
                'timestamp' => '2025-07-03 07:38:24',
            ],
        ];
        parent::init();
    }
}
