<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CriticalEventsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CriticalEventsTable Test Case
 */
class CriticalEventsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CriticalEventsTable
     */
    protected $CriticalEvents;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.CriticalEvents',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CriticalEvents') ? [] : ['className' => CriticalEventsTable::class];
        $this->CriticalEvents = $this->getTableLocator()->get('CriticalEvents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CriticalEvents);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CriticalEventsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
