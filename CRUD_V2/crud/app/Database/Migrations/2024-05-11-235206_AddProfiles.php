<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AddProfiles extends Migration
{
    public function up()
    {      $this->forge->addField([
            'Profile_id'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>true,
                'auto_increment'=>true,
            ],
            'Profile_email'=>[
                'type'=>'VARCHAR',
                'unique'=>true,
                'constraint'=>255,
            ],
            'Profile_name'=>[
                'type'=>'VARCHAR',
                'constraint'=>30,
            ],
            'Profile_photo'=>[
                'type'=>'VARCHAR',
                'constraint'=>255,
                'null'=>true,
            ],
            'User_id_fk' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'create_at'=>[
                'type'=>'TIMESTAMP',
                'null'=>true,
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'update_at'=>[
                'type'=>'TIMESTAMP',
                'null'=>true,
            ],
        ]);
        $this->forge->addPrimaryKey('Profile_id');
        $this->forge->addForeignKey('User_id_fk','users','User_id','CASCADE','CASCADE','fk_user_profile');
        $this->forge->createTable('profiles');
    }
    public function down()
    {$this->forge->dropTable('profiles');
    }
}
