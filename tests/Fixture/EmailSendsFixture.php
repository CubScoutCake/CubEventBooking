<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmailSendsFixture
 *
 */
class EmailSendsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'sent' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'message_id' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'user_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'subject' => ['type' => 'string', 'length' => 511, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'routing_domain' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'from_address' => ['type' => 'string', 'length' => 511, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'friendly_from' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'notification_type_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'notification_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'deleted' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        '_indexes' => [
            'email_sends_message_id' => ['type' => 'index', 'columns' => ['message_id'], 'length' => []],
            'email_sends_user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
            'email_sends_notification_id' => ['type' => 'index', 'columns' => ['notification_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'email_sends_notification_id' => ['type' => 'foreign', 'columns' => ['notification_id'], 'references' => ['notifications', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'email_sends_notification_type_id' => ['type' => 'foreign', 'columns' => ['notification_type_id'], 'references' => ['notification_types', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'email_sends_user_id' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'created' => 1487718602,
            'modified' => 1487718602,
            'sent' => 1487718602,
            'message_id' => 'Lorem ipsum dolor sit amet',
            'user_id' => 1,
            'subject' => 'Lorem ipsum dolor sit amet',
            'routing_domain' => 'Lorem ipsum dolor sit amet',
            'from_address' => 'Lorem ipsum dolor sit amet',
            'friendly_from' => 'Lorem ipsum dolor sit amet',
            'notification_type_id' => 1,
            'notification_id' => 1,
            'deleted' => null
        ],
    ];
}
