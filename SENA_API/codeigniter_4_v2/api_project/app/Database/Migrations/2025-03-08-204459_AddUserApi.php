<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserApi extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'User_id' => [
                    'type' => 'BIGINT',
                    'constraint' => 255,
                    'unsigned' => true,
                    'auto_increment' => true
                ],
                'User_email' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'unique' => true
                ],
                'User_password' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255
                 
                ],
                'created_at' => [
                    'type' => 'TIMESTAMP',
                    'null' => true
                ],
                'updated_at' => [
                    'type' => 'TIMESTAMP',
                    'null' => true
                ]
            ]);
            $this->forge->addPrimaryKey('User_id');
            $this->forge->createTable('User_Api');
    }

    public function down() {
        $this->forge->dropTable('User_Api');
    }
}
