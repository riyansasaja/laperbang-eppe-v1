<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBundelB extends Model
{
    protected $table            = 'tb_bundel_b';
    protected $primaryKey       = 'id_upload_b';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_perkara', 'nama_file_b', 'label_b', 'verval_status', 'komentar'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    function getDataNonValidate()
    {
        $db = $this->db->table($this->table);
        $db->select('tb_bundel_b.label_b, tb_bundel_b.nama_file_b, tb_perkara.no_perkara, users.fullname, users.username');
        $db->where('verval_status', '1');
        $db->join('tb_perkara', 'tb_bundel_b.id_perkara = tb_perkara.id_perkara');
        $db->join('users', 'tb_perkara.id_user = users.id');
        return $db->get()->getResultArray();
    }

    function getDataValidate()
    {
        $db = $this->db->table($this->table);
        $db->select('tb_bundel_b.label_b, tb_bundel_b.nama_file_b, tb_perkara.no_perkara, tb_bundel_b.verval_status , users.fullname, users.username');
        $db->where('verval_status !=', '1');
        $db->join('tb_perkara', 'tb_bundel_b.id_perkara = tb_perkara.id_perkara');
        $db->join('users', 'tb_perkara.id_user = users.id');
        return $db->get()->getResultArray();
    }
}
