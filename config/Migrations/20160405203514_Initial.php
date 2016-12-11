<?php
use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('Balances', ['id' => false, 'primary_key' => ['']]);
        $table
            ->addColumn('Total Value', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('Total Payments', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('Outstanding Balance', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $table = $this->table('BookingSummary', ['id' => false, 'primary_key' => ['']]);
        $table
            ->addColumn('Description', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('SUM(Quantity)', 'decimal', [
                'default' => null,
                'limit' => 32,
                'null' => true,
            ])
            ->create();

        $table = $this->table('UserView', ['id' => false, 'primary_key' => ['']]);
        $table
            ->addColumn('First Name', 'string', [
                'default' => null,
                'limit' => 125,
                'null' => false,
            ])
            ->addColumn('Last Name', 'string', [
                'default' => null,
                'limit' => 125,
                'null' => false,
            ])
            ->addColumn('Scouting Appointment', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('Email Address', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('Scout Group', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('UserName', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('District', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->create();

        $table = $this->table('allergies');
        $table
            ->addColumn('allergy', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('description', 'string', [
                'default' => null,
                'limit' => 999,
                'null' => true,
            ])
            ->create();

        $table = $this->table('applications');
        $table
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('scoutgroup_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('section', 'string', [
                'default' => 'Cubs',
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('permitholder', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modification', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('eventname', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('event_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('osm_event_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('cc_att_total', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('cc_att_cubs', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('cc_att_yls', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('cc_att_leaders', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('cc_inv_count', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('cc_inv_total', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('cc_inv_cubs', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('cc_inv_yls', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('cc_inv_leaders', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addIndex(
                [
                    'event_id',
                ]
            )
            ->addIndex(
                [
                    'scoutgroup_id',
                ]
            )
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $table = $this->table('applications_attendees', ['id' => false, 'primary_key' => ['application_id', 'attendee_id']]);
        $table
            ->addColumn('application_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('attendee_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(
                [
                    'application_id',
                ]
            )
            ->addIndex(
                [
                    'attendee_id',
                ]
            )
            ->addIndex(
                [
                    'attendee_id',
                    'application_id',
                ]
            )
            ->create();

        $table = $this->table('attendees');
        $table
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('scoutgroup_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('role_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('firstname', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('lastname', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('dateofbirth', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('phone', 'string', [
                'default' => null,
                'limit' => 12,
                'null' => true,
            ])
            ->addColumn('phone2', 'string', [
                'default' => null,
                'limit' => 12,
                'null' => true,
            ])
            ->addColumn('address_1', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('address_2', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('city', 'string', [
                'default' => null,
                'limit' => 125,
                'null' => true,
            ])
            ->addColumn('county', 'string', [
                'default' => null,
                'limit' => 125,
                'null' => true,
            ])
            ->addColumn('postcode', 'string', [
                'default' => null,
                'limit' => 8,
                'null' => true,
            ])
            ->addColumn('nightsawaypermit', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('vegetarian', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('osm_generated', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('osm_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addIndex(
                [
                    'role_id',
                ]
            )
            ->addIndex(
                [
                    'scoutgroup_id',
                ]
            )
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $table = $this->table('attendees_allergies', ['id' => false, 'primary_key' => ['attendee_id', 'allergy_id']]);
        $table
            ->addColumn('attendee_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('allergy_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(
                [
                    'allergy_id',
                ]
            )
            ->addIndex(
                [
                    'attendee_id',
                ]
            )
            ->addIndex(
                [
                    'attendee_id',
                    'allergy_id',
                ]
            )
            ->create();

        $table = $this->table('champions');
        $table
            ->addColumn('district_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('firstname', 'string', [
                'default' => null,
                'limit' => 125,
                'null' => false,
            ])
            ->addColumn('lastname', 'string', [
                'default' => null,
                'limit' => 125,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addIndex(
                [
                    'district_id',
                ]
            )
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $table = $this->table('discounts');
        $table
            ->addColumn('discount', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('code', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('text', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('active', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('discount_value', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('discount_number', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('uses', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('max_uses', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addIndex(
                [
                    'code',
                ],
                ['unique' => true]
            )
            ->create();

        $table = $this->table('districts');
        $table
            ->addColumn('district', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('county', 'string', [
                'default' => 'Hertfordshire',
                'limit' => 255,
                'null' => true,
            ])
            ->addIndex(
                [
                    'district',
                ],
                ['unique' => true]
            )
            ->create();

        $table = $this->table('events');
        $table
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 18,
                'null' => false,
            ])
            ->addColumn('full_name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('live', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('new_apps', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('start', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('end', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('deposit', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('deposit_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('deposit_value', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('deposit_inc_leaders', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('deposit_text', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('cubs', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('cubs_value', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('cubs_text', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('yls', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('yls_value', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('yls_text', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('leaders', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('leaders_value', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('leaders_text', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('logo', 'string', [
                'default' => '/Monkey.png',
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('address', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('city', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('county', 'string', [
                'default' => 'Hertfordshire',
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('postcode', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('invtext_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('legaltext_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('discount_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('intro_text', 'string', [
                'default' => null,
                'limit' => 999,
                'null' => true,
            ])
            ->addColumn('tagline_text', 'string', [
                'default' => null,
                'limit' => 125,
                'null' => true,
            ])
            ->addColumn('location', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('max', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('max_cubs', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('max_yls', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('max_leaders', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('allow_reductions', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('logo_ratio', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('invoices_locked', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('admin_firstname', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('admin_lastname', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('admin_email', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('admin_user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('parent_applications', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('available_apps', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('available_cubs', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addIndex(
                [
                    'discount_id',
                ]
            )
            ->addIndex(
                [
                    'invtext_id',
                ]
            )
            ->addIndex(
                [
                    'legaltext_id',
                ]
            )
            ->addIndex(
                [
                    'admin_user_id',
                ]
            )
            ->create();

        $table = $this->table('invoice_items');
        $table
            ->addColumn('invoice_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('Value', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('Description', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('Quantity', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('itemtype_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('visible', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'invoice_id',
                ]
            )
            ->addIndex(
                [
                    'itemtype_id',
                ]
            )
            ->create();

        $table = $this->table('invoices');
        $table
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('application_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('value', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('paid', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('initialvalue', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'application_id',
                ]
            )
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $table = $this->table('invoices_payments', ['id' => false, 'primary_key' => ['invoice_id', 'payment_id']]);
        $table
            ->addColumn('invoice_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('payment_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('xValue', 'float', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'invoice_id',
                ]
            )
            ->addIndex(
                [
                    'payment_id',
                ]
            )
            ->create();

        $table = $this->table('itemtypes');
        $table
            ->addColumn('itemtype', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('roletype', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('minor', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $table = $this->table('logistic_items');
        $table
            ->addColumn('application_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('logistic_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('param_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addIndex(
                [
                    'application_id',
                ]
            )
            ->addIndex(
                [
                    'logistic_id',
                ]
            )
            ->addIndex(
                [
                    'param_id',
                ]
            )
            ->create();

        $table = $this->table('logistics');
        $table
            ->addColumn('parameter_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('event_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('header', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('text', 'string', [
                'default' => null,
                'limit' => 999,
                'null' => true,
            ])
            ->addIndex(
                [
                    'event_id',
                ]
            )
            ->addIndex(
                [
                    'parameter_id',
                ]
            )
            ->create();

        $table = $this->table('notes');
        $table
            ->addColumn('application_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('invoice_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('visible', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('note_text', 'string', [
                'default' => null,
                'limit' => 999,
                'null' => true,
            ])
            ->addIndex(
                [
                    'application_id',
                ]
            )
            ->addIndex(
                [
                    'invoice_id',
                ]
            )
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $table = $this->table('notifications');
        $table
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('notificationtype_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('new', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('notification_header', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('text', 'string', [
                'default' => null,
                'limit' => 999,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('read_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('notification_source', 'string', [
                'default' => null,
                'limit' => 63,
                'null' => true,
            ])
            ->addColumn('link_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('link_controller', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('link_prefix', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('link_action', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addIndex(
                [
                    'notificationtype_id',
                ]
            )
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $table = $this->table('notificationtypes');
        $table
            ->addColumn('notification_type', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('notification_description', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('icon', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->create();

        $table = $this->table('parameter_sets');
        $table
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->create();

        $table = $this->table('parameters');
        $table
            ->addColumn('parameter', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('constant', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('set_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addIndex(
                [
                    'set_id',
                ]
            )
            ->create();

        $table = $this->table('params');
        $table
            ->addColumn('parameter_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('constant', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addIndex(
                [
                    'parameter_id',
                ]
            )
            ->create();

        $table = $this->table('payments');
        $table
            ->addColumn('value', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('paid', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('cheque_number', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('name_on_cheque', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('payment_notes', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $table = $this->table('roles');
        $table
            ->addColumn('role', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('invested', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('minor', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $table = $this->table('scoutgroups');
        $table
            ->addColumn('scoutgroup', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('district_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('number_stripped', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addIndex(
                [
                    'scoutgroup',
                ],
                ['unique' => true]
            )
            ->addIndex(
                [
                    'district_id',
                ]
            )
            ->create();

        $table = $this->table('sessions', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'string', [
                'default' => '',
                'limit' => 40,
                'null' => false,
            ])
            ->addColumn('data', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('expires', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->create();

        $table = $this->table('settings');
        $table
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('text', 'string', [
                'default' => null,
                'limit' => 999,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('event_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('settingtype_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('number', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'settingtype_id',
                ]
            )
            ->create();

        $table = $this->table('settingtypes');
        $table
            ->addColumn('settingtype', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('description', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->create();

        $table = $this->table('users');
        $table
            ->addColumn('role_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('scoutgroup_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('authrole', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('firstname', 'string', [
                'default' => null,
                'limit' => 125,
                'null' => false,
            ])
            ->addColumn('lastname', 'string', [
                'default' => null,
                'limit' => 125,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('phone', 'string', [
                'default' => null,
                'limit' => 12,
                'null' => false,
            ])
            ->addColumn('address_1', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('address_2', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('city', 'string', [
                'default' => null,
                'limit' => 125,
                'null' => false,
            ])
            ->addColumn('county', 'string', [
                'default' => null,
                'limit' => 125,
                'null' => false,
            ])
            ->addColumn('postcode', 'string', [
                'default' => null,
                'limit' => 8,
                'null' => false,
            ])
            ->addColumn('section', 'string', [
                'default' => 'Cubs',
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('username', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('osm_user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('osm_secret', 'string', [
                'default' => null,
                'limit' => 999,
                'null' => true,
            ])
            ->addColumn('osm_section_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('osm_linked', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('osm_linkdate', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('osm_current_term', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('osm_term_end', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('reset', 'string', [
                'default' => null,
                'limit' => 999,
                'null' => true,
            ])
            ->addColumn('last_login', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('logins', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addIndex(
                [
                    'username',
                ],
                ['unique' => true]
            )
            ->addIndex(
                [
                    'role_id',
                ]
            )
            ->addIndex(
                [
                    'scoutgroup_id',
                ]
            )
            ->create();

        $this->table('applications')
            ->addForeignKey(
                'event_id',
                'events',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'scoutgroup_id',
                'scoutgroups',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('applications_attendees')
            ->addForeignKey(
                'application_id',
                'applications',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'attendee_id',
                'attendees',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('attendees')
            ->addForeignKey(
                'role_id',
                'roles',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'scoutgroup_id',
                'scoutgroups',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('attendees_allergies')
            ->addForeignKey(
                'allergy_id',
                'allergies',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'attendee_id',
                'attendees',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('champions')
            ->addForeignKey(
                'district_id',
                'districts',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('events')
            ->addForeignKey(
                'discount_id',
                'discounts',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'invtext_id',
                'settings',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'legaltext_id',
                'settings',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('invoice_items')
            ->addForeignKey(
                'invoice_id',
                'invoices',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'itemtype_id',
                'itemtypes',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('invoices')
            ->addForeignKey(
                'application_id',
                'applications',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('invoices_payments')
            ->addForeignKey(
                'invoice_id',
                'invoices',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'payment_id',
                'payments',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('logistic_items')
            ->addForeignKey(
                'application_id',
                'applications',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'logistic_id',
                'logistics',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'param_id',
                'params',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('logistics')
            ->addForeignKey(
                'event_id',
                'events',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'parameter_id',
                'parameters',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('notes')
            ->addForeignKey(
                'application_id',
                'applications',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'invoice_id',
                'invoices',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'SET_NULL'
                ]
            )
            ->update();

        $this->table('notifications')
            ->addForeignKey(
                'notificationtype_id',
                'notificationtypes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('parameters')
            ->addForeignKey(
                'set_id',
                'parameter_sets',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('params')
            ->addForeignKey(
                'parameter_id',
                'parameters',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('payments')
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('scoutgroups')
            ->addForeignKey(
                'district_id',
                'districts',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('settings')
            ->addForeignKey(
                'settingtype_id',
                'settingtypes',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('users')
            ->addForeignKey(
                'role_id',
                'roles',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'scoutgroup_id',
                'scoutgroups',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

    }

    public function down()
    {
        $this->table('applications')
            ->dropForeignKey(
                'event_id'
            )
            ->dropForeignKey(
                'scoutgroup_id'
            )
            ->dropForeignKey(
                'user_id'
            );

        $this->table('applications_attendees')
            ->dropForeignKey(
                'application_id'
            )
            ->dropForeignKey(
                'attendee_id'
            );

        $this->table('attendees')
            ->dropForeignKey(
                'role_id'
            )
            ->dropForeignKey(
                'scoutgroup_id'
            )
            ->dropForeignKey(
                'user_id'
            );

        $this->table('attendees_allergies')
            ->dropForeignKey(
                'allergy_id'
            )
            ->dropForeignKey(
                'attendee_id'
            );

        $this->table('champions')
            ->dropForeignKey(
                'district_id'
            )
            ->dropForeignKey(
                'user_id'
            );

        $this->table('events')
            ->dropForeignKey(
                'discount_id'
            )
            ->dropForeignKey(
                'invtext_id'
            )
            ->dropForeignKey(
                'legaltext_id'
            );

        $this->table('invoice_items')
            ->dropForeignKey(
                'invoice_id'
            )
            ->dropForeignKey(
                'itemtype_id'
            );

        $this->table('invoices')
            ->dropForeignKey(
                'application_id'
            )
            ->dropForeignKey(
                'user_id'
            );

        $this->table('invoices_payments')
            ->dropForeignKey(
                'invoice_id'
            )
            ->dropForeignKey(
                'payment_id'
            );

        $this->table('logistic_items')
            ->dropForeignKey(
                'application_id'
            )
            ->dropForeignKey(
                'logistic_id'
            )
            ->dropForeignKey(
                'param_id'
            );

        $this->table('logistics')
            ->dropForeignKey(
                'event_id'
            )
            ->dropForeignKey(
                'parameter_id'
            );

        $this->table('notes')
            ->dropForeignKey(
                'application_id'
            )
            ->dropForeignKey(
                'invoice_id'
            )
            ->dropForeignKey(
                'user_id'
            );

        $this->table('notifications')
            ->dropForeignKey(
                'notificationtype_id'
            )
            ->dropForeignKey(
                'user_id'
            );

        $this->table('parameters')
            ->dropForeignKey(
                'set_id'
            );

        $this->table('params')
            ->dropForeignKey(
                'parameter_id'
            );

        $this->table('payments')
            ->dropForeignKey(
                'user_id'
            );

        $this->table('scoutgroups')
            ->dropForeignKey(
                'district_id'
            );

        $this->table('settings')
            ->dropForeignKey(
                'settingtype_id'
            );

        $this->table('users')
            ->dropForeignKey(
                'role_id'
            )
            ->dropForeignKey(
                'scoutgroup_id'
            );

        $this->dropTable('Balances');
        $this->dropTable('BookingSummary');
        $this->dropTable('UserView');
        $this->dropTable('allergies');
        $this->dropTable('applications');
        $this->dropTable('applications_attendees');
        $this->dropTable('attendees');
        $this->dropTable('attendees_allergies');
        $this->dropTable('champions');
        $this->dropTable('discounts');
        $this->dropTable('districts');
        $this->dropTable('events');
        $this->dropTable('invoice_items');
        $this->dropTable('invoices');
        $this->dropTable('invoices_payments');
        $this->dropTable('itemtypes');
        $this->dropTable('logistic_items');
        $this->dropTable('logistics');
        $this->dropTable('notes');
        $this->dropTable('notifications');
        $this->dropTable('notificationtypes');
        $this->dropTable('parameter_sets');
        $this->dropTable('parameters');
        $this->dropTable('params');
        $this->dropTable('payments');
        $this->dropTable('roles');
        $this->dropTable('scoutgroups');
        $this->dropTable('sessions');
        $this->dropTable('settings');
        $this->dropTable('settingtypes');
        $this->dropTable('users');
    }
}
