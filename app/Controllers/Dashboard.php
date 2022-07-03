<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\View\Table;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();
        $model = new User();
        $user = $model->select('id, name')->find($session->get('id'));
        // dd(route_to('auth/logout'));

        return view('layouts/main', ['title' => 'Dashboard']);
    }

    public function listUser()
    {
        $model = new User();
        $query = $model->select('id, name, email, sekolah, nisn, wa, kota, provinsi, image, bukti_nisn, bukti_bayar, role_id');
        $kategori = $this->request->getGet('kategori');
        $orderBy = $this->request->getGet('orderBy') ?? 'id';
        $order = $this->request->getGet('order') ?? 'ASC';

        if ($kategori) {
            $query = $query->where('role_id', $kategori);
        }
        $query = $query->orderBy($orderBy, $order);
        $userData = $query->paginate(25);

        $template = [
            'table_open'	=>	'<table class="table table-hover table-striped table-responsive">'
        ];
        $table = new Table($template);
        $table->setHeading('Id', 'Nama', 'Email', 'Sekolah', 'Nisn', 'No. Wa', 'Kota', 'Provinsi', 'Image', 'Bukti NISN', 'Bukti Bayar', 'Role');
        
        $data = [
            'title' =>  'List User',
            'table' =>  $table->generate($userData),
            'pager' =>  $model->pager,
        ];
        // dd($data, $model->pager->links());

        return view('dashboard/list_user', $data);
    }

    public function profilPeserta()
    {
        $model = new User();
        $id = session()->get('id');
        $profilData = $model->select('name, email, sekolah, nisn, wa, kota, provinsi, image, role_id')->find($id);
        dd($profilData);

        // return halaman profil
    }

    public function editProfil()
    {
        $model = new User();
        $id = session()->get('id');
        $profilData = $model->select('name, email, sekolah, nisn, wa, kota, provinsi, image, bukti_nisn, role_id')->find($id);

        // return halaman edit profil
    }

    public function changePassword()
    {
        // return halaman ganti password
    }

    public function pembayaran()
    {
        // return halaman metode pembayaran
    }

    public function buktiBayar()
    {
        // return halaman upload bukti bayar
    }
}
