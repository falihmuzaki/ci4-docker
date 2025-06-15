<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table           = 'users';
    protected $primaryKey      = 'id';
    protected $allowedFields   = ['email', 'name', 'username', 'password', 'role_id', 'status', 'last_login', 'deleted_at'];
    protected $useTimestamps   = true;
    protected $returnType      = 'array';
    // protected $validationRules = [
    //     'name'     => 'required|min_length[3]',
    //     'username' => 'required|is_unique[users.username,id]',
    //     'email'    => 'required|valid_email|is_unique[users.email,id]',
    //     'password' => 'required|min_length[8]',
    // ];

}
