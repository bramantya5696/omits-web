<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    =>  [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'name'  =>  [
                'type'          => 'VARCHAR',
                'constraint'    => 128,
            ],
            'email' =>  [
                'type'          => 'VARCHAR',
                'constraint'    => 128,
                'unique'	    =>	true,
            ],
            'sekolah'   =>  [
                'type'          => 'VARCHAR',
                'constraint'    => 128,
            ],
            'nisn'  =>  [
                'type'          => 'VARCHAR',
                'constraint'    => 128,
            ],
            'wa'    =>  [
                'type'          => 'VARCHAR',
                'constraint'    => 128,
            ],
            'kota'  =>  [
                'type'          => 'VARCHAR',
                'constraint'    => 128,
            ],
            'provinsi'  =>  [
                'type'          => 'VARCHAR',
                'constraint'    => 128,
            ],
            'image' =>  [
                'type'          => 'VARCHAR',
                'constraint'    => 128,
                'null'	        =>	true,
            ],
            'bukti_nisn'    =>  [
                'type'          => 'VARCHAR',
                'constraint'    => 128,
                'null'	        =>	true,
            ],
            'bukti_bayar'    =>  [
                'type'          => 'VARCHAR',
                'constraint'    => 128,
                'null'	        =>	true,
            ],
            'password'  =>  [
                'type'          => 'VARCHAR',
                'constraint'    => 256,
            ],
            'role_id'   =>  [
                'type'          => 'INT',
                'constraint'    => 2,
            ],
            'is_active' =>  [
                'type'          => 'INT',
                'constraint'    => 1,
            ],
            'created_at'    =>  [
                'type'	=>	'DATETIME',
            ],
            'updated_at'	=>	[
                'type'	=>	'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('role_id', 'user_roles', 'id');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
