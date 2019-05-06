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
    ],
    'eventStatuses' => [
        [
            'event_status' => 'New',
            'live' => false,
            'accepting_applications' => false,
            'spaces_full' => false,
            'pending_date' => true,
            'status_order' => 1
        ],
        [
            'event_status' => 'Ready',
            'live' => true,
            'accepting_applications' => false,
            'spaces_full' => false,
            'pending_date' => true,
            'status_order' => 2
        ],
        [
            'event_status' => 'Open',
            'live' => true,
            'accepting_applications' => true,
            'spaces_full' => false,
            'pending_date' => false,
            'status_order' => 3
        ],
        [
            'event_status' => 'Full',
            'live' => true,
            'accepting_applications' => false,
            'spaces_full' => true,
            'pending_date' => false,
            'status_order' => 4
        ],
        [
            'event_status' => 'In Progress',
            'live' => true,
            'accepting_applications' => false,
            'spaces_full' => false,
            'pending_date' => false,
            'status_order' => 5
        ],
        [
            'event_status' => 'Over',
            'live' => false,
            'accepting_applications' => false,
            'spaces_full' => false,
            'pending_date' => false,
            'status_order' => 6
        ],
    ]
];
