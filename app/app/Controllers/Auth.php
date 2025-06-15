<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            $validation = \Config\Services::validation();
            $rules      = [
                'username' => 'required',
                'password' => 'required',
            ];
            if (! $this->validate($rules)) {
                return redirect()->back()->with('error', $validation->listErrors());
            }

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $user     = $this->UserModel
                ->groupStart()
                ->where('username', $username)
                ->orWhere('email', $username)
                ->groupEnd()
                ->first();
            if ($user && password_verify($password, $user['password'])) {
                $user['logged_in'] = true;
                session()->set($user);
                return redirect()->to('/users')->with('success', 'Login berhasil!');
            }

            return redirect()->back()->with('error', 'Invalid email / username or password');
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda berhasil logout.');
    }

}
