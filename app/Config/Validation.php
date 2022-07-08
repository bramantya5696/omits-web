<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        // 'list'   => 'CodeIgniter\Validation\Views\list',
        'list'   => 'App\Views\Errors\list_errors',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    public $login = [
        'email' => 'required',
        'password'  => 'required',
    ];

    public $login_errors = [
        'email'    =>    [
            'required'      =>  'Email tidak boleh kosong',
        ],
        'password'    =>    [
            'required'      =>  'password tidak boleh kosong'
        ]
    ];

    public $registration = [
        'name'  =>  'required',
        'email' =>  'required|valid_email|is_unique[users.email]',
        'no_wa' =>  'required',
        'password'    =>    'required|min_length[8]',
        'confirm_password'  =>  'required|matches[password]',
    ];

    public $registration_errors = [
        'name'    =>    [
            'required'      =>  'Nama tidak boleh kosong'
        ],
        'email'    =>    [
            'required'      =>  'Email tidak boleh kosong',
            'valid_email'   =>  'Mohon masukkan email yang valid',
            'is_unique'     =>  'Email sudah terdaftar'
        ],
        'no_wa' => [
            'required'      => 'Nomor Whatsapp tidak boleh kosong'
        ],
        'password'  =>    [
            'min_length'    =>  'Password minimal berisi 8 karakter'
        ],
        'confirm_password'  =>  [
            'matches'       =>  'Password dan konfirmasi password tidak sesuai'
        ]
    ];

    public $reset_pass = [
        'password'    =>    'min_length[8]',
        'confirm_password'    =>    'matches[password]'
    ];

    public $reset_pass_errors = [
        'password'    =>    [
            'min_length'   =>   'Password minimal berisi 8 karakter'
        ],
        'confirm_password'    =>    [
            'matches'   =>  'Password dan konfirmasi password tidak sesuai'
        ]
    ];

    public $profil = [
        'name'  =>  'required',
        'sekolah'   =>  'required',
        'wa'    =>  'required',
        'kota'  =>  'required',
        'provinsi'  =>  'required',
        'bukti_nisn'    =>  'uploaded[bukti_nisn]|max_size[bukti_nisn, 2048]|is_image[bukti_nisn]',
    ];

    public $profil_errors = [
        'name'  =>  [
            'required'    =>    'Nama tidak boleh kosong',
        ],
        'sekolah'  =>  [
            'required'    =>    'Sekolah tidak boleh kosong',
        ],
        'wa'  =>  [
            'required'    =>    'Nomor WA tidak boleh kosong',
        ],
        'kota'  =>  [
            'required'    =>    'Kota tidak boleh kosong',
        ],
        'provinsi'  =>  [
            'required'    =>    'Provinsi tidak boleh kosong',
        ],
        'bukti_nisn'    =>    [
            'uploaded'  =>  'Terjadi kesalahan, Silakan coba lagi',
            'max_size'  =>  'File tidak boleh lebih dari 2 MB',
            'is_image'  =>  'File yang diupload bukan gambar',
        ]
    ];
}
