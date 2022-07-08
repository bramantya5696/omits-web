<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableRole extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    =>  [
                'type'              => 'INT',
                'constraint'        => 2,
                'auto_increment'    => true,
            ],
            'name'    =>    [
                'type'          =>  'VARCHAR',
                'constraint'    =>  64,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user_roles');
    }

    public function down()
    {
        $this->forge->dropTable('user_roles');
    }
}
