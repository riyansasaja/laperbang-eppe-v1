<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbTimeControl extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([

            'time_log_id'   => ['type' => 'BIGINT', 'constraint' => 255, 'unsigned' => true, 'auto_increment' => true],
            'user_id'       => ['type' => 'int'],
            'id_perkara'    => ['type' => 'BIGINT', 'constraint' => 255,],
            'time_log'      => ['type' => 'int']
        ]);

        $this->forge->addKey('time_log_id', true);
        $this->forge->createTable('tb_time_control', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('tb_time_control');
    }
}
