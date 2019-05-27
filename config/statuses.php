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
    'reservationStatuses' => [
        [
            'reservation_status' => 'Pending Payment',
            'active' => true,
            'complete' => false,
            'cancelled' => false,
            'status_order' => 2,
        ],
        [
            'reservation_status' => 'Cancelled',
            'active' => false,
            'complete' => false,
            'cancelled' => true,
            'status_order' => 4
        ],
        [
            'reservation_status' => 'Complete',
            'active' => true,
            'complete' => true,
            'cancelled' => false,
            'status_order' => 3,
        ],
        [
            'reservation_status' => 'On Waiting List',
            'active' => false,
            'complete' => false,
            'cancelled' => false,
            'status_order' => 1,
        ],
        [
            'reservation_status' => 'Expired',
            'active' => false,
            'complete' => false,
            'cancelled' => true,
            'status_order' => 4,
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
    ],
    'notificationTypes' => [
        [
            'notification_type' => 'Generic',
            'notification_description' => 'Generic Notification.',
            'icon' => 'fa-envelope',
            'type_code' => 'GEN-NOT',
        ],
        [
            'notification_type' => 'Welcome',
            'notification_description' => 'Welcome to the System Email & Notification.',
            'icon' => 'fa-user',
            'type_code' => 'USR-NEW',
        ],
        [
            'notification_type' => 'Password Reset',
            'notification_description' => 'A password reset password has been triggered.',
            'icon' => 'fa-unlock',
            'type_code' => 'USR-PWD',
        ],
        [
            'notification_type' => 'New Payment Received',
            'notification_description' => 'Notification that a payment has been recorded by an administrator.',
            'icon' => 'fa-receipt',
            'type_code' => 'INV-PAY',
        ],
        [
            'notification_type' => 'Surcharge Added',
            'notification_description' => 'A Payment Surcharge was added to the Invoice.',
            'icon' => 'fa-tag',
            'type_code' => 'INV-SUR',
        ],
        [
            'notification_type' => 'Outstanding Balance',
            'notification_description' => 'Balance Outstanding on Invoice',
            'icon' => 'fa-clock',
            'type_code' => 'INV-OUT',
        ],
        [
            'notification_type' => 'Invoice Attached',
            'notification_description' => 'Invoice is attached to the email.',
            'icon' => 'fa-paperclip',
            'type_code' => 'INV-ATC',
        ],
        [
            'notification_type' => 'Deposit Outstanding',
            'notification_description' => 'Notification of an Invoice where the deposit is past due.',
            'icon' => 'fa-clock',
            'type_code' => 'INV-DEP',
        ],
        [
            'notification_type' => 'Reservation Confirmation',
            'notification_description' => 'Reservation received, awaiting payment.',
            'icon' => 'fa-ticket-alt',
            'type_code' => 'RSV-NEW',
        ],
        [
            'notification_type' => 'Reservation Payment Received',
            'notification_description' => 'Notification that a payment has been recorded against a Reservation by an administrator.',
            'icon' => 'fa-receipt',
            'type_code' => 'RSV-CNF',
        ],
        [
            'notification_type' => 'Reservation Expired',
            'notification_description' => 'Expiration date for Reservation Reached. Reservation is No longer Valid.',
            'icon' => 'fa-ticket-alt',
            'type_code' => 'RSV-EXP',
        ],
        [
            'notification_type' => 'Reservation Cancelled',
            'notification_description' => 'Reservation received, awaiting payment.',
            'icon' => 'fa-ticket-alt',
            'type_code' => 'RSV-CAN',
        ],
    ]
];
