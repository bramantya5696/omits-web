<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Admin extends BaseController
{
    public function editProfil($id)
    {
        $model = new User();
        $data = $model->select('id, name, email, sekolah, nisn, wa, kota, provinsi, role_id')->find($id);
    }

    public function saveProfil()
    {
        $model = new User();
        $model->save($this->request->getPost());
        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    public function exportToExcel($role = 0)
    {
        $model = new User();
        $query = $model->select('id, name, email, sekolah, nisn, wa, kota, provinsi, image, bukti_nisn, bukti_bayar, role_id');
        if ($role) {
            $query->where('role_id', $role);
        }
        $data = $query->find();
        return view('export_excel', [$data]);
    }
}
