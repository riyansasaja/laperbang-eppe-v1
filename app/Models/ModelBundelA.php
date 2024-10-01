<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBundelA extends Model
{
    protected $table            = 'tb_bundel_a';
    protected $primaryKey       = 'id_upload_a';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_perkara', 'nama_file_a', 'label_a', 'verval_status', 'komentar'];

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

    //protected db


    function getDataNonValidate()
    {
        $db = $this->db->table($this->table);
        $db->select('tb_bundel_a.label_a, tb_bundel_a.nama_file_a, tb_perkara.no_perkara, users.fullname, users.username');
        $db->where('verval_status', '1');
        $db->join('tb_perkara', 'tb_bundel_a.id_perkara = tb_perkara.id_perkara');
        $db->join('users', 'tb_perkara.id_user = users.id');
        return $db->get()->getResultArray();
    }

    function getDataValidate()
    {
        $db = $this->db->table($this->table);
        $db->select('tb_bundel_a.label_a, tb_bundel_a.nama_file_a, tb_perkara.no_perkara, tb_bundel_a.verval_status ,users.fullname, users.username');
        // $db->where('verval_status !=', '1');
        $db->whereIn('verval_status', [2, 4]);
        $db->join('tb_perkara', 'tb_bundel_a.id_perkara = tb_perkara.id_perkara');
        $db->join('users', 'tb_perkara.id_user = users.id');
        return $db->get()->getResultArray();
    }

    function getDataNonVerified()
    {
        $db = $this->db->table($this->table);
        $db->select('tb_bundel_a.label_a, tb_bundel_a.nama_file_a, tb_perkara.no_perkara, users.fullname, users.username');
        $db->where('verval_status', '2');
        $db->join('tb_perkara', 'tb_bundel_a.id_perkara = tb_perkara.id_perkara');
        $db->join('users', 'tb_perkara.id_user = users.id');
        return $db->get()->getResultArray();
    }

    function getDataVerified()
    {
        $db = $this->db->table($this->table);
        $db->select('tb_bundel_a.label_a, tb_bundel_a.nama_file_a, tb_perkara.no_perkara, users.fullname, users.username');
        $db->whereIn('verval_status', [3, 5]);
        // $db->where('verval_status', '5');
        $db->join('tb_perkara', 'tb_bundel_a.id_perkara = tb_perkara.id_perkara');
        $db->join('users', 'tb_perkara.id_user = users.id');
        return $db->get()->getResultArray();
    }
}
