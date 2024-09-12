<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbPerkara extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_perkara'               => ['type' => 'BIGINT', 'constraint' => 255, 'unsigned' => true, 'auto_increment' => true],
            'id_user'            => ['type' => 'int', 'constraint' => 11],
            'no_perkara'         => ['type' => 'varchar', 'constraint' => 100],
            'pihak_p'         => ['type' => 'varchar', 'constraint' => 100],
            'pihak_t'         => ['type' => 'varchar', 'constraint' => 100],
            'hp_pihak_p'         => ['type' => 'varchar', 'constraint' => 20],
            'hp_pihak_t'         => ['type' => 'varchar', 'constraint' => 20],
            'hp_pihak_t'         => ['type' => 'varchar', 'constraint' => 20],
            'jenis_perkara'       => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
            'no_banding'       => ['type' => 'varchar', 'constraint' => 100, 'null' => true],
            'tgl_reg_banding'       => ['type' => 'datetime', 'null' => true],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_perkara', true);
        $this->forge->createTable('tb_perkara', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('tb_perkara');
    }
}
