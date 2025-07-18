<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ThresholdLimitsFixture
 */
class ThresholdLimitsFixture extends TestFixture
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
                'device_id' => 1,
                'variable' => '88ce9f87-feb8-4e10-a52b-673b16660b4c',
                'lower_limit' => 1,
                'upper_limit' => 1,
            ],
        ];
        parent::init();
    }
}
