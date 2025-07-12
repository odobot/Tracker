<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TenMinuteDataTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TenMinuteDataTable Test Case
 */
class TenMinuteDataTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TenMinuteDataTable
     */
    protected $TenMinuteData;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.TenMinuteData',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TenMinuteData') ? [] : ['className' => TenMinuteDataTable::class];
        $this->TenMinuteData = $this->getTableLocator()->get('TenMinuteData', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TenMinuteData);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TenMinuteDataTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
