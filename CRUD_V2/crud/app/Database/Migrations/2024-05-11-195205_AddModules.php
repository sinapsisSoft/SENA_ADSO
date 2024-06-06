<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AddModules extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Modules_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'Modules_name' => [
                'type' => 'VARCHAR',
                'unique' => true,
                'constraint' => 30,
            ],
            'Modules_description' => [
                'type' => 'VARCHAR',
                'constraint' => 300,
                'null' => true,
            ],
            'Modules_route' => [
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => true,
            ], 
            'Modules_icon' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
            ],
            'Modules_submodule' => [
                'type' => 'tinyint',
                'constraint' => 3,
                'null' => 0,
                'default' => 0,
            ],
            'Modules_parent_module' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
                'null' => true,
                'default' => null,
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
        $this->forge->addPrimaryKey('Modules_id');
        $this->forge->createTable('modules');
    }

    public function down()
    {
        $this->forge->dropTable('modules');
    }
}
