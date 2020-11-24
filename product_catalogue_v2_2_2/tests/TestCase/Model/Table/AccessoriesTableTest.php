<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccessoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccessoriesTable Test Case
 */
class AccessoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AccessoriesTable
     */
    public $Accessories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Accessories',
        'app.Products',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Accessories') ? [] : ['className' => AccessoriesTable::class];
        $this->Accessories = TableRegistry::getTableLocator()->get('Accessories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Accessories);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
