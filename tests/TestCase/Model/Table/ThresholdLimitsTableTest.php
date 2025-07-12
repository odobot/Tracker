<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ThresholdLimitsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ThresholdLimitsTable Test Case
 */
class ThresholdLimitsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ThresholdLimitsTable
     */
    protected $ThresholdLimits;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ThresholdLimits',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ThresholdLimits') ? [] : ['className' => ThresholdLimitsTable::class];
        $this->ThresholdLimits = $this->getTableLocator()->get('ThresholdLimits', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ThresholdLimits);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ThresholdLimitsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
