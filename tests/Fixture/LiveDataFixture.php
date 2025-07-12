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
                'uuid' => '2f8ef613-5593-4ba0-a325-54c5616eacd3',
                'device_id' => 1,
                'temperature' => 1.5,
                'humidity' => 1.5,
                'current_reading' => 1.5,
                'status' => 1,
                'timestamp' => '',
            ],
        ];
        parent::init();
    }
}
