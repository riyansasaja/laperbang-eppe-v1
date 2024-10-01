<?php

namespace App\Models;

use CodeIgniter\Model;
use Tatter\Audits\Traits\AuditsTrait;

class ModelPerkara extends Model
{
    use AuditsTrait;

    protected $table            = 'tb_perkara';
    protected $primaryKey       = 'id_perkara';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'no_perkara', 'pihak_p', 'pihak_t', 'hp_pihak_p', 'hp_pihak_t', 'jenis_perkara', 'no_banding', 'tgl_reg_banding'];

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
    protected $afterInsert = ['auditInsert'];
    protected $beforeUpdate   = [];
    protected $afterUpdate = ['auditUpdate'];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete = ['auditDelete'];
}
