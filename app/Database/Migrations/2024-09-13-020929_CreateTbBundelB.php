<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbBundelB extends Migration
{
    public function up()
    {
        //

        $this->forge->addField([

            'id_upload_b'    => ['type' => 'BIGINT', 'constraint' => 255, 'unsigned' => true, 'auto_increment' => true],
            'id_perkara'    => ['type' => 'BIGINT', 'constraint' => 255,],
            'nama_file_b'     => ['type' => 'varchar', 'constraint' => 255],
            'verval_status'     => ['type' => 'int', 'constraint' => 2],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_upload_b', true);
        $this->forge->createTable('tb_bundel_b', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('tb_bundel_b');
    }
}
