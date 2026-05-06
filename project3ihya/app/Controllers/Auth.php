<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    // tampil login page
    public function login()
    {
        return view('auth/login');
    }

    // proses login
    public function attemptLogin()
    {
        $session = session();
        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password_hash'])) {

            session()->set([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'logged_in' => true
            ]);

            // 🔥 INI REDIRECT KE ADMIN
            return redirect()->to('admin/post');
        }

        return redirect()->back()->with('error', 'Email atau password salah');
    }

    // logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}