<?php

namespace App\Models;

use CodeIgniter\Model;

class TimeControlModel extends Model
{
    protected $table            = 'tb_time_control';
    protected $primaryKey       = 'time_log_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'id_perkara', 'time_log'];

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



    public function cekTime($id_perkara)
    {
        $lasttime =  $this->db->table($this->table)->select('time_log')->where('id_perkara', $id_perkara)->orderBy('time_log_id', 'DESC')
            ->limit(1)->get()->getFirstRow();
        if ($lasttime == null) {
            return false;
        }

        $selisih = time() - $lasttime->time_log;
        $bataswaktu = 3600 * 72;
        if ($selisih > $bataswaktu) {
            # code...
            return true;
        } else {
            return false;
        }
    }
}
