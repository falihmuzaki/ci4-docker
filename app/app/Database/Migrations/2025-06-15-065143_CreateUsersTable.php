<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'           => 'SERIAL',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'          => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'username'      => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
            'email'         => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at'    => [
                'type' => 'TIMESTAMP',
            ],
            'deleted_at'    => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at'    => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'role_id'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 2, // Default role ID for regular users
            ],
            'status'        => [
                'type'       => 'INT',
                'default'    => 1,
                'constraint' => 1, // 1 for active, 0 for inactive
            ],
            'last_login'    => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
