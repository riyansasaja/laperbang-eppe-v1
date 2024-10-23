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
    protected $allowedFields    = ['id_user', 'no_perkara', 'pihak_p', 'pihak_t', 'hp_pihak_p', 'hp_pihak_t', 'jenis_perkara', 'no_banding', 'tgl_reg_banding', 'status', 'majelis', 'id_pp'];

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
    protected $afterInsert = ['auditInsert', 'lspInsert'];
    protected $beforeUpdate   = [];
    protected $afterUpdate = ['auditUpdate', 'lspUpdate'];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete = ['auditDelete', 'lspDelete'];

    // private $db = $this->db->table($this->table);
    public function getPerkarabanding()
    {
        $db = $this->db->table($this->table);
        $db->select('tb_perkara.no_perkara, tb_perkara.jenis_perkara, tb_perkara.no_banding, tb_perkara.status, users.fullname');
        $db->join('users', 'tb_perkara.id_user = users.id');
        $db->orderBy('tb_perkara.id_perkara', 'DESC');
        return $db->get()->getResultObject();
    }

    public function getdetilByNomor($nomor)
    {
        $db = $this->db->table($this->table);
        $db->select('tb_perkara.no_perkara, tb_perkara.pihak_p, tb_perkara.pihak_t, tb_perkara.jenis_perkara, tb_perkara.no_banding, tb_perkara.status, tb_perkara.created_at, users.fullname, users.username');
        $db->where('tb_perkara.no_perkara', $nomor);
        $db->join('users', 'tb_perkara.id_user = users.id');
        return $db->get()->getFirstRow();
    }

    public function getidByNomor($nomor_perkara)
    {
        $db = $this->db->table($this->table);
        $db->select('id_perkara');
        $db->where('no_perkara', $nomor_perkara);
        return $db->get()->getFirstRow();
    }

    //methode untuk callback after update
    public function lspUpdate(array $data)
    {

        //ambil data nomor perkara by id
        $tb_perkara = $this->db->table($this->table);
        $tb_perkara->select('no_perkara');
        $tb_perkara->where('id_perkara', $data['id'][0]);
        $no_perkara = $tb_perkara->get()->getResultArray();
        //insert table lsp
        $tblsp = $this->db->table('log_status_perkara');
        //data status perkara
        $status_perkara = [
            'tgl_status' => date('Y-m-d'),
            'nomor' => $no_perkara[0]['no_perkara'],
            'status' => $data['data']['status']
        ];
        //insert
        $tblsp->insert($status_perkara);
        //return
        return $data;
    }

    public function lspInsert(array $data)
    {
        $tblsp = $this->db->table('log_status_perkara');
        if (! $data['result']) {
            return false;
        }
        $status_perkara = [
            'tgl_status' => date('Y-m-d'),
            'nomor' => $data['data']['no_perkara'],
            'status' => $data['data']['status']
        ];
        $tblsp->insert($status_perkara);
        return $data;
    }
}
