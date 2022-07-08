<?php

namespace App\Controllers;

use Google\Client;
use Google\Service\Drive;
use App\Controllers\BaseController;
use App\Models\User;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;
use CodeIgniter\HTTP\Files\UploadedFile;

class Peserta extends BaseController
{
    public function editProfil()
    {
        $model = new User();
        $data = $this->request->getPost();
        $bukti_nisn = $this->request->getFile('bukti_nisn');

        if (!$this->validate('profil')) {
            return redirect()->back()->with('msg', $this->validator->listErrors());
        }

        if (! $bukti_nisn->isValid()) {
            return redirect()->back()->with('msg', $bukti_nisn->getErrorString());
        }
        
        $nisn_id = $this->upload($bukti_nisn);
        $data['bukti_nisn'] = $nisn_id;
        $model->save($data);

        return redirect()->back()->with('success', 'Profil berhasil disimpan');
    }

    public function uploadPembayaran()
    {
        $model = new User();

        if ($this->validate([
            'bukti_bayar'	=>	'uploaded[bukti_bayar]|max_size[bukti_bayar,2048]|is_image[bukti_bayar]'
        ], [
            'bukti_bayar'	=>	[
                'uploaded'	=>  'Terjadi kesalahan saat upload, silakah coba lagi',
                'max_size'	=>	'File tidak boleh lebih dari 2 MB',
                'is_image'	=>	'File yang diupload bukan gambar',
            ]
        ])) {
            $file = $this->request->getFile('bukti_bayar');
            $img_id = $this->upload($file);

            $model->save([
                'id'	=>	session()->get('id'),
                'bukti_bayar'	=>	$img_id,
            ]);

            return redirect()->back()->with('success', 'Bukti pembayaran berhasil disimpan');
        } else {
            return redirect()->back()->with('msg', $this->validator->listErrors());
        }
    }

    public function upload(UploadedFile $file)
    {
        $mime = $file->getMimeType();
        $file_path = $file->store();
        $content = file_get_contents( WRITEPATH . 'uploads/' . $file_path);

        $meta_data = new DriveFile([
            'name'	=>	$file_path,
        ]) ;
        
        $client = new Client();
        $client->setAuthConfig(APPPATH . 'cred.json');
        $client->addScope(Drive::DRIVE);

        $service = new Drive($client);
        $uploaded = $service->files->create($meta_data, [
            'data'	=>	$content,
            'mimeType'  =>  $mime,
            'uploadType'    => 'multipart',
            'fields'	=>	'id',
        ]);
        unlink(WRITEPATH . 'uploads/' . $file_path);
        
        if (!$uploaded) {
            return null;
        }

        $id = $uploaded->getId();

        $permission = new Permission();
        $permission->setType('anyone');
        $permission->setRole('reader');
        $service->permissions->create($id, $permission);


        return $id;

    }

    public function changePassword()
    {
        $model = new User();
        $oldPass = $model->select('password')->find(session('id'))['password'];
        if (!password_verify($this->request->getPost('old_pass'), $oldPass)) {
            return redirect()->back()->with('msg', 'Password lama yang anda masukkan salah');
        }

        if (!$this->validate([
            'password'	=>	'min_length[8]',
            'confirm_pass'  =>  'matches[password]'
        ],[
            'password'	=>	[
                'min_length'    =>  'Password minimal 8 karakter'
            ],
            'confirm_pass'	=>	[
                'matches'	=>	'Password baru dan konfirmasi password tidak sama'
            ]
        ])) {
            return redirect()->back()->with('msg', $this->validator->listErrors());
        } else {
            $data = [
                'id'	=>	session('id'),
                'password'  =>  password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            $model->save($data);
            return redirect()->back()->with('success', 'Password berhasil diubah');
        }
    }

}
