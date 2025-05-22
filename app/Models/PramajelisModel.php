<?php

namespace App\Models;

use CodeIgniter\Model;

class PramajelisModel extends Model
{
    protected $table            = 'tb_pra_majelis';
    protected $primaryKey       = 'id_pra_majelis';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_perkara', 'id_user'];

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

    public function getMajelisbyPerkara($id_perkara)
    {
        $db = $this->db->table($this->table);
        $db->select('tb_pramajelis.nama_majelis, tb_perkara.*');
        $db->join('tb_perkara', 'tb_pramajelis.id_perkara = tb_perkara.id_perkara');
        $db->where('id_perkara', $id_perkara);
        return $db->get()->getResultObject();
    }
}
