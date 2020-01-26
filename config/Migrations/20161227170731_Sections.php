<?php

use Phinx\Migration\AbstractMigration;

class Sections extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('section_types');
        $table->addColumn('section_type', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('upper_age', 'integer')
            ->addColumn('lower_age', 'integer')
            ->addColumn('role_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addForeignKey(
                'role_id',
                'roles',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE',
                ]
            )
            ->create();

        // create the table
        $table = $this->table('sections');
        $table->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('deleted', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('section', 'string', [
                'default' => 'Cubs',
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('section_type_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('scoutgroup_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addForeignKey(
                'section_type_id',
                'section_types',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE',
                ]
            )
            ->addForeignKey(
                'scoutgroup_id',
                'scoutgroups',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE',
                ]
            )
            ->addIndex(['section_type_id'])
            ->create();

        $table = $this->table('users');
        $table->addColumn('section_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addForeignKey(
                'section_id',
                'sections',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE',
                ]
            )
            ->addIndex(['section_id'])
            ->update();

        $table = $this->table('applications');
        $table->addColumn('section_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->renameColumn('section', 'legacy_section')
            ->addForeignKey(
                'section_id',
                'sections',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE',
                ]
            )
            ->addIndex(['section_id'])
            ->update();

        $table = $this->table('attendees');
        $table->addColumn('section_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addForeignKey(
                'section_id',
                'sections',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE',
                ]
            )
            ->addIndex(['section_id'])
            ->update();
    }
}
