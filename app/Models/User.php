<?php

namespace App\Models;

use CodeIgniter\Model;
use Faker\Generator;

class User extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name', 'email', 'sekolah', 'nisn', 'wa',
        'kota', 'provinsi', 'image', 'bukti_nisn',
        'bukti_bayar', 'password', 'role_id', 'is_active',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = ['setImageLink'];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }

    public static function getImageLink(string $imageID)
    {
        return 'https://drive.google.com/uc?id=' . $imageID . '&export=view';
    }

    public function setImageLink($data)
    {
        if (($data['method'] == 'find' && !isset($data['id'])) || $data['method']=='findAll') {
            foreach($data['data'] as $key => $item) {
                $data['data'][$key]['bukti_nisn'] = isset($item['bukti_nisn']) ? $this->getImageLink($item['bukti_nisn']) : null;
                $data['data'][$key]['bukti_bayar'] = isset($item['bukti_bayar']) ? $this->getImageLink($item['bukti_bayar']) : null;
            }
        }
        return $data;
    }

    public function fake(Generator &$faker)
    {
        return [
            'name'  =>  $faker->name,
            'email' =>  $faker->email,
            'sekolah'	=>	'ITS',
            'nisn'	=>	(string) $faker->randomNumber(5, true) . (string) $faker->randomNumber(5, true),
            'wa'	=>	$faker->phoneNumber,
            'kota'	=>	$faker->city,
            'provinsi'	=>	'',
            'image'	=>	null,
            'bukti_nisn'    =>  $faker->randomAscii(),
            'bukti_bayar'   =>  $faker->randomAscii(),
            'password'	=>	password_hash($faker->password, PASSWORD_DEFAULT),
            'role_id'	=>	$faker->numberBetween(1, 6),
            'is_active'	=>	$faker->boolean,
        ];
    }
}
