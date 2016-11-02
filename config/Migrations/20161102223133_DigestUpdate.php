<?php
use Migrations\AbstractMigration;

class DigestUpdate extends AbstractMigration
{

    public function up()
    {

        $this->table('users')
            ->addColumn('digest_hash', 'string', [
                'default' => null,
                'length' => 255,
                'null' => true,
            ])
            ->addColumn('pw_salt', 'string', [
                'default' => null,
                'length' => 255,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('users')
            ->removeColumn('digest_hash')
            ->removeColumn('pw_salt')
            ->update();
    }
}

