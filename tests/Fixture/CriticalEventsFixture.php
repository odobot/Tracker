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
                'uuid' => 'fe454016-d2bb-473c-96fa-987a219870eb',
                'device_id' => 1,
                'variable' => 'Lorem ipsum dolor sit amet',
                'value' => 1,
                'threshold_type' => 'Lorem ip',
                'threshold_value' => 1,
                'timestamp' => '2025-07-03 09:31:03',
            ],
        ];
        parent::init();
    }
}
