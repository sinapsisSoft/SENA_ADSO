<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AddPermissions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Permissions_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'Permissions_name' => [
                'type' => 'VARCHAR',
                'unique' => true,
                'constraint' => 30,
            ],
            'Permissions_description' => [
                'type' => 'VARCHAR',
                'constraint' => 300,
                'null' => true,
            ],
            'Permissions_icon' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
            ],
            'create_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'update_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('Permissions_id');
        $this->forge->createTable('permissions');
    }

    public function down()
    {
        $this->forge->dropTable('permissions');
    }
}
