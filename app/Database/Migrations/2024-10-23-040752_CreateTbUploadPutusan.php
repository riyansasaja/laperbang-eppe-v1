<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbUploadPutusan extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([

            'id_upload_putusan'    => ['type' => 'BIGINT', 'constraint' => 255, 'unsigned' => true, 'auto_increment' => true],
            'id_perkara'    => ['type' => 'BIGINT', 'constraint' => 255,],
            'nama_file_putusan'     => ['type' => 'varchar', 'constraint' => 255],
            'label_putusan'     => ['type' => 'varchar', 'constraint' => 255],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_upload_putusan', true);
        $this->forge->createTable('tb_upload_putusan', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('tb_upload_putusan');
    }
}
