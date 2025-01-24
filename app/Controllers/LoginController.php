<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login');  
    }

    public function login()
    {
        // Ambil input dari form login
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi input
        if (!$username || !$password) {
            return redirect()->to('/login')->with('error', 'Username dan Password harus diisi.');
        }

        $model = new UserModel();

        // Cek apakah username ada di database
        $user = $model->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->to('/login')->with('error', 'Username atau Password salah.');
        }

        // Simpan informasi user di session
        session()->set([
            'user_id'   => $user['id'],
            'username'  => $user['username'],
            'user_level' => $user['user_level'],
            'logged_in' => true,
        ]);

        // Redirect berdasarkan level user
        if ($user['user_level'] == 'admin') {
            return redirect()->to('/dashboard');
        } elseif ($user['user_level'] == 'inventator') {
            return redirect()->to('/inventator-dashboard');
        } else {
            return redirect()->to('/user-dashboard');
        }
    }

    public function logout()
    {
        session()->destroy();  // Hapus session saat logout
        return redirect()->to('/login');
    }
}
