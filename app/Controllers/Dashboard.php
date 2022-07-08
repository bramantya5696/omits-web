<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\View\Table;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $model = new User();
        $id = session()->get('id');
        $profilData = $model->select('name, email, sekolah, nisn, wa, kota, provinsi, image, role_id')->find($id);
        
        return view('dashboard/peserta', [
            'title'	=>	'Dashboard'
        ]);
    }

    public function admin()
    {
        $session = session();
        $model = new User();
        $user = $model->select('id, name')->find($session->get('id'));
        // dd(route_to('auth/logout'));

        return view('dashboard/admin', ['title' => 'Dashboard']);
    }

    public function listUser()
    {
        $model = new User();
        $query = $model->select('users.id, users.name, email, sekolah, nisn, wa, kota, provinsi, bukti_nisn, bukti_bayar, user_roles.name as role')
            ->join('user_roles', 'users.role_id = user_roles.id');
        $kategori = $this->request->getGet('kategori');
        $search = $this->request->getGet('search');

        if ($search) {
            $query = $query->where("(users.name LIKE '%".$search."%' OR email LIKE '%".$search."%')");
        }
        if ($kategori) {
            $query = $query->where('role_id', $kategori);
        }
        $userData = $query->paginate(25);

        array_walk($userData, function (&$item)
        {
            $item['bukti_nisn'] = "<a role='button' class='btn btn-primary". ($item['bukti_nisn']?"'":"disabled' aria-disabled='true'")."' href='".($item['bukti_nisn']??"#'")."'>Buka</a>";
            $item['bukti_bayar'] = "<a role='button' class='btn btn-primary". ($item['bukti_bayar']?"'":"disabled' aria-disabled='true'")."' href='".($item['bukti_bayar']??"#'")."'>Buka</a>";
            $item['action'] = "<a role='button' class='btn btn-primary btn-sm mr-2 mb-2' href='" . route_to('Admin::editProfil', $item['id']) . "'>Edit</a>"
                ."<a role='button' class='btn btn-danger btn-sm' href='" . route_to('Admin::deleteUser', $item['id']) . "'>Delete</a>";
        });

        $template = [
            'table_open'	=>	'<table class="table table-hover table-striped table-responsive">'
        ];
        $table = new Table($template);
        $table->setHeading('Id', 'Nama', 'Email', 'Sekolah', 'Nisn', 'No. Wa', 'Kota', 'Provinsi', 'Bukti NISN', 'Bukti Bayar', 'Status', 'Action');

        $roles = $model->builder('user_roles')->select()->get()->getResultArray();
        
        $data = [
            'title' =>  'List User',
            'table' =>  $table->generate($userData),
            'pager' =>  $model->pager,
            'roles'	=>	$roles,
            'req'   =>  $this->request,
        ];

        return view('dashboard/list_user', $data);
    }

    public function editProfil()
    {
        $model = new User();
        $id = session()->get('id');
        $profilData = $model->select('id, name, email, sekolah, nisn, wa, kota, provinsi, image, bukti_nisn, role_id')->find($id);

        return view('dashboard/edit_peserta',[
            'title' =>  'Edit Profil',
            'user'	=>	$profilData,
        ]);
    }

    public function changePassword()
    {
        return view('dashboard/ubah_password',[
            'title'	=>	'Ubah Password'
        ]);
    }

    public function pembayaran()
    {
        return view('dashboard/petunjuk_bayar', [
            'title'	=>	'Petunjuk Pembayaran'
        ]);
    }

    public function buktiBayar()
    {
        return view('dashboard/bukti_pembayaran', [
            'title'	=>	'Upload Bukti Bayar'
        ]);
    }
}
