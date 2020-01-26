<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\DiscountsTable Test Case
 */
class DiscountsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DiscountsTable
     */
    public $Discounts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Discounts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Discounts') ? [] : ['className' => 'App\Model\Table\DiscountsTable'];
        $this->Discounts = TableRegistry::get('Discounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Discounts);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Discounts->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'discount' => 'Lorem ipsum dolor sit amet',
                'code' => 'ABCDEF',
                'text' => 'Lorem ipsum dolor sit amet',
                'active' => 1,
                'discount_value' => 1,
                'discount_number' => 1,
                'uses' => 0,
                'max_uses' => 1,
            ],
            [
                'id' => 2,
                'discount' => 'Lorem ipsum dolor go amet',
                'code' => 'BCDEFG',
                'text' => 'Lorem This dolor sit amet',
                'active' => 0,
                'discount_value' => 1,
                'discount_number' => 1,
                'uses' => 1,
                'max_uses' => 1,
            ],
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $badData = [
            'id' => 3,
            'discount' => 'Lorem ipsum fish go amet',
            'code' => 'CDEFGH',
            'text' => 'Lorem This dolor goat amet',
            'active' => 0,
            'discount_value' => 'Monkey',
            'discount_number' => 'Goat',
            'uses' => 1,
            'max_uses' => 1,
        ];

        $goodData = [
            'id' => 3,
            'discount' => 'Lorem ipsum fish go amet',
            'code' => 'CDEFGH',
            'text' => 'Lorem This dolor goat amet',
            'active' => 0,
            'discount_value' => 1,
            'discount_number' => 1,
            'uses' => 1,
            'max_uses' => 1,
        ];

        $expected = [
            [
                'id' => 1,
                'discount' => 'Lorem ipsum dolor sit amet',
                'code' => 'ABCDEF',
                'text' => 'Lorem ipsum dolor sit amet',
                'active' => 1,
                'discount_value' => 1,
                'discount_number' => 1,
                'uses' => 0,
                'max_uses' => 1,
            ],
            [
                'id' => 2,
                'discount' => 'Lorem ipsum dolor go amet',
                'code' => 'BCDEFG',
                'text' => 'Lorem This dolor sit amet',
                'active' => 0,
                'discount_value' => 1,
                'discount_number' => 1,
                'uses' => 1,
                'max_uses' => 1,
            ],
            [
                'id' => 3,
                'discount' => 'Lorem ipsum fish go amet',
                'code' => 'CDEFGH',
                'text' => 'Lorem This dolor goat amet',
                'active' => 0,
                'discount_value' => 1,
                'discount_number' => 1,
                'uses' => 1,
                'max_uses' => 1,
            ],
        ];

        $badEntity = $this->Discounts->newEntity($badData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->Discounts->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Discounts->save($badEntity));
        $this->Discounts->save($goodEntity);

        $query = $this->Discounts->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $badData = [
            'id' => 3,
            'discount' => 'Lorem ipsum fish go amet',
            'code' => 'ABCDEF',
            'text' => 'Lorem This dolor goat amet',
            'active' => 0,
            'discount_value' => 1,
            'discount_number' => 1,
            'uses' => 1,
            'max_uses' => 1,
        ];

        $goodData = [
            'id' => 3,
            'discount' => 'Lorem ipsum fish go amet',
            'code' => 'CDEFGH',
            'text' => 'Lorem This dolor goat amet',
            'active' => 0,
            'discount_value' => 1,
            'discount_number' => 1,
            'uses' => 1,
            'max_uses' => 1,
        ];

        $expected = [
            [
                'id' => 1,
                'discount' => 'Lorem ipsum dolor sit amet',
                'code' => 'ABCDEF',
                'text' => 'Lorem ipsum dolor sit amet',
                'active' => 1,
                'discount_value' => 1,
                'discount_number' => 1,
                'uses' => 0,
                'max_uses' => 1,
            ],
            [
                'id' => 2,
                'discount' => 'Lorem ipsum dolor go amet',
                'code' => 'BCDEFG',
                'text' => 'Lorem This dolor sit amet',
                'active' => 0,
                'discount_value' => 1,
                'discount_number' => 1,
                'uses' => 1,
                'max_uses' => 1,
            ],
            [
                'id' => 3,
                'discount' => 'Lorem ipsum fish go amet',
                'code' => 'CDEFGH',
                'text' => 'Lorem This dolor goat amet',
                'active' => 0,
                'discount_value' => 1,
                'discount_number' => 1,
                'uses' => 1,
                'max_uses' => 1,
            ],
        ];

        $badEntity = $this->Discounts->newEntity($badData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->Discounts->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Discounts->save($badEntity));
        $this->Discounts->save($goodEntity);

        $query = $this->Discounts->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
