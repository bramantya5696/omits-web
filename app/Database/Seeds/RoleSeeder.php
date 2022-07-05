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
                'id'    =>  3,
                'name'  =>  'Peserta SD',
            ],
            [
                'id'    =>  4,
                'name'  =>  'Peserta SMP',
            ],
            [
                'id'    =>  5,
                'name'  =>  'Peserta SMA',
            ],
            [
                'id'    =>  6,
                'name'  =>  'Peserta MISSION',
            ],
        ];

        $this->db->table('user_roles')->insertBatch($data);
    }
}
