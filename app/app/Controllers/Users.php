<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Users extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $this->userModel->where('status', 1);
        $data['users'] = $this->userModel->findAll();

        return view('users/index', $data);
    }

    public function set_data()
    {
        return [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role_id'  => 2,
            'status'   => 1,
        ];
    }

    public function create()
    {
        $data['action'] = 'store';

        return view('users/form', $data);
    }

    public function store()
    {
        $rules = [
            'name'     => 'required|min_length[3]',
            'username' => "required|is_unique[users.username,id]",
            'email'    => "required|valid_email|is_unique[users.email,id]",
            'password' => 'min_length[8]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $data               = $this->set_data();
        $data['created_at'] = date('Y-m-d H:i:s');
        if ($this->userModel->insert($data)) {
            return redirect()->to('/users')->with('success', 'User created successfully.');
        } else {
            return redirect()->back()->withInput()->with('error', $this->userModel->errors());
        }
    }

    public function edit($id)
    {
        $data['user']   = $this->userModel->find($id);
        $data['action'] = 'update/' . $id;

        return view('users/form', $data);
    }

    public function update($id)
    {
        $rules = [
            'name'     => 'required|min_length[3]',
            'username' => "required|is_unique[users.username,id,{$id}]",
            'email'    => "required|valid_email|is_unique[users.email,id,{$id}]",
            'password' => 'min_length[8]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $data               = $this->set_data();
        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($this->userModel->update($id, $data)) {
            return redirect()->to('/users')->with('success', 'User updated successfully.');
        } else {
            return redirect()->back()->withInput()->with('error', $this->userModel->errors());
        }
    }

    public function delete($id)
    {
        $data = [
            'deleted_at' => date('Y-m-d H:i:s'),
            'status'     => 0,
        ];
        if ($this->userModel->update($id, $data)) {
            return redirect()->to('/users')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->back()->withInput()->with('error', $this->userModel->errors());
        }
    }
}
