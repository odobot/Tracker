<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LiveDataFixture
 */
class LiveDataFixture extends TestFixture
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
                'uuid' => '3d42c506-d471-4013-820c-a990c557c71f',
                'device_id' => 1,
                'temperature' => 1.5,
                'humidity' => 1.5,
                'current_reading' => 1.5,
                'status' => 1,
                'timestamp' => '',
                'GpsX' => 1.5,
                'GpsY' => 1.5,
            ],
        ];
        parent::init();
    }
}
