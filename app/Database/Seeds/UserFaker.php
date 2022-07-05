<?php

namespace App\Database\Seeds;

use App\Models\User;
use CodeIgniter\Database\Seeder;
use CodeIgniter\Test\Fabricator;

class UserFaker extends Seeder
{
    public function run()
    {
        $fabricator = new Fabricator(User::class);
        $data = $fabricator->make(55);
        $this->db->table('users')->insertBatch($data);
    }
}
