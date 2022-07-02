<?php

namespace App\Controllers;

use App\Models\User;
use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;

class Home extends BaseController
{
    public function index()
    {
        // $model = new User;
        // dd($model->select('role_id')->find(1));

        // // dd(password_hash('1234', PASSWORD_BCRYPT));
        // // return view('layouts/main', ['title' => 'tes']);
        // $client = new Client();
        // $client->setAuthConfig(APPPATH . 'cred.json');
        // $client->addScope(Drive::DRIVE);

        // // $permission = new Permission();
        // // $permission->setRole('reader');
        // // $permission->setType('anyone');
        // $service = new Drive($client);
        // // $service->permissions->create('1lKUuzJzcB32dxBWq1DMJhyi1qkw5rQNT', $permission);
        // $files = $service->files->get('16AB54bSRrygEYWVO7hwfqcI81jINNIgS', ['fields'	=>	'webContentLink']);
        // // $listfiles = $service->files->listFiles();
        // // dd($listfiles);
        // dd($service->files->listFiles());
        // dd($files);



        return view('home');
    }

    public function upload()
    {
        $file = $this->request->getFile('tes');
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
        $permission = new Permission();
        $permission->setType('anyone');
        $permission->setRole('reader');
        $service->permissions->create($uploaded->getId(), $permission);

        $files = $service->files->get($uploaded->getId(), ['fields'	=>	'webContentLink']);

        return view('tes_upload', ['img' => $files->getWebContentLink()]);
        // dd($service->files->listFiles(), $uploaded);
        // return redirect()->to(base_url());

    }

    public function login()
    {
        $data = [
            'title' => 'login'
        ];
        echo view('auth/login', $data);
    }

    public function registration()
    {
        return view('auth/registration', ['title'	=>	'Registration']);
    }

    public function forgotPassword()
    {
        return view('auth/forgot_password', ['title'	=>	'Forgot Password']);
    }

    public function resetpassword()
    {
        $id = session()->get('reset_id');
        if (!$id) {
            return redirect('login');
        }
        return view('auth/reset_password', ['title'	=>	'Reset Password']);
    }


}
