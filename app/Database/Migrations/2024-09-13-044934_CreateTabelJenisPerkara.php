<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelJenisPerkara extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([

            'id_jp'    => ['type' => 'int', 'unsigned' => true, 'auto_increment' => true],
            'nama_jp'     => ['type' => 'varchar', 'constraint' => 255],
            'status_jp'     => ['type' => 'int', 'constraint' => 2]
        ]);

        $this->forge->addKey('id_jp', true);
        $this->forge->createTable('tb_jenis_perkara', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('tb_jenis_perkara');
    }
}
