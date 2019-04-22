<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2019-04-22
 * Time: 17:51
 */

return [
    'applicationStatuses' => [
        [
            'application_status' => 'New',
            'active' => 1,
            'no_money' => 1,
            'reserved' => 0,
            'attendees_added' => 0
        ],
        [
            'application_status' => 'Cancelled',
            'active' => 0,
            'no_money' => 1,
            'reserved' => 0,
            'attendees_added' => 0
        ],
        [
            'application_status' => 'Reserved',
            'active' => 1,
            'no_money' => 1,
            'reserved' => 1,
            'attendees_added' => 0
        ],
        [
            'application_status' => 'Awaiting Payment',
            'active' => 1,
            'no_money' => 1,
            'reserved' => 0,
            'attendees_added' => 1
        ],
        [
            'application_status' => 'Complete',
            'active' => 1,
            'no_money' => 0,
            'reserved' => 0,
            'attendees_added' => 1
        ],
        [
            'application_status' => 'Expired',
            'active' => 0,
            'no_money' => 1,
            'reserved' => 1,
            'attendees_added' => 0
        ],
    ]
];
