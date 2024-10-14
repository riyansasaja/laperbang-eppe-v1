<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMajelisHakim extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'BIGINT', 'constraint' => 255, 'unsigned' => true, 'auto_increment' => true],
            'id_user'            => ['type' => 'int', 'constraint' => 11],
            'Majelis'         => ['type' => 'varchar', 'constraint' => 10],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_majelis', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('tb_majelis');
    }
}
