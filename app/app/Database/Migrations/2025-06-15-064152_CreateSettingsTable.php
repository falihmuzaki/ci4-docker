<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id' => [
            'type'           => 'SERIAL',
            'unsigned'       => true,
            'auto_increment' => true,
        ],
        'site_name' => [
            'type'       => 'VARCHAR',
            'constraint' => 255,
        ]
        ,
        'created_at' => [
            'type'    => 'TIMESTAMP'        
        ],
        'context' => [
            'type'       => 'TEXT',
            'null'       => true,
        ]
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('settings');
}

public function down()
{
    $this->forge->dropTable('settings');
}

}
