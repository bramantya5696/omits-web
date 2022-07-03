<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'    =>  1,
                'name'  =>  'Admin',
            ],
            [
                'id'    =>  2,
                'name'  =>  'Belum Terverifikasi',
            ],
            [
                'name'  =>  'Peserta SD',
            ],
            [
                'name'  =>  'Peserta SMP',
            ],
            [
                'name'  =>  'Peseerta SMA',
            ],
            [
                'name'  =>  'Peserta MISSION',
            ],
        ];

        $this->db->table('user_roles')->insertBatch($data);
    }
}
