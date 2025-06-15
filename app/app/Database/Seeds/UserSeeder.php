<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'     => 'Admin User',
                'email'    => 'admin@example.com',
                'username' => 'admin',
                'role_id'  => 1, // Assuming 1 is the role ID for admin
                'created_at' => date('Y-m-d H:i:s'),
                'password_hash' => password_hash('admin123', PASSWORD_BCRYPT),
            ],
        ];  
        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
        // Alternatively, you can use the Model
        // $this->userModel->insertBatch($data);
        // If you want to use the Model, make sure to load it first
        // $this->userModel = new \App\Models\UserModel();
        // $this->userModel->insertBatch($data);
        // You can also use the Model to insert a single user
        // $this->userModel->insert([
        //     'name'     => 'Admin User',
        //     'email'    => 'admin@example.com',
        //     'password' => password_hash('admin123', PASSWORD_BCRYPT),
        // ]);
    }
}
