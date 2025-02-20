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

    public function getRekapBulan($user)
    {
        $db = db_connect();
        $tahun = date('Y');
        $data = $db->query("SELECT 
SUM(IF(month(`created_at`) = 01 AND year(`created_at`) =$tahun, 1, 0 )) AS `jan`,
SUM(IF(month(`created_at`) = 02 AND year(`created_at`) =$tahun, 1, 0 )) AS `feb`,
SUM(IF(month(`created_at`) = 03 AND year(`created_at`) =$tahun, 1, 0 )) AS `mar`,
SUM(IF(month(`created_at`) = 04 AND year(`created_at`) =$tahun, 1, 0 )) AS `apr`,
SUM(IF(month(`created_at`) = 05 AND year(`created_at`) =$tahun, 1, 0 )) AS `mei`,
SUM(IF(month(`created_at`) = 06 AND year(`created_at`) =$tahun, 1, 0 )) AS `jun`,
SUM(IF(month(`created_at`) = 07 AND year(`created_at`) =$tahun, 1, 0 )) AS `jul`,
SUM(IF(month(`created_at`) = 08 AND year(`created_at`) =$tahun, 1, 0 )) AS `agu`,
SUM(IF(month(`created_at`) = 09 AND year(`created_at`) =$tahun, 1, 0 )) AS `sep`,
SUM(IF(month(`created_at`) = 10 AND year(`created_at`) =$tahun, 1, 0 )) AS `okt`,
SUM(IF(month(`created_at`) = 11 AND year(`created_at`) =$tahun, 1, 0 )) AS `nov`,
SUM(IF(month(`created_at`) = 12 AND year(`created_at`) =$tahun, 1, 0 )) AS `des`
FROM tb_perkara WHERE `id_user` = $user;");
        return $data->getResultArray();
    }
    public function getRekapBulanAll()
    {
        $db = db_connect();
        $tahun = date('Y');
        $data = $db->query("SELECT 
SUM(IF(month(`created_at`) = 01 AND year(`created_at`) =$tahun, 1, 0 )) AS `jan`,
SUM(IF(month(`created_at`) = 02 AND year(`created_at`) =$tahun, 1, 0 )) AS `feb`,
SUM(IF(month(`created_at`) = 03 AND year(`created_at`) =$tahun, 1, 0 )) AS `mar`,
SUM(IF(month(`created_at`) = 04 AND year(`created_at`) =$tahun, 1, 0 )) AS `apr`,
SUM(IF(month(`created_at`) = 05 AND year(`created_at`) =$tahun, 1, 0 )) AS `mei`,
SUM(IF(month(`created_at`) = 06 AND year(`created_at`) =$tahun, 1, 0 )) AS `jun`,
SUM(IF(month(`created_at`) = 07 AND year(`created_at`) =$tahun, 1, 0 )) AS `jul`,
SUM(IF(month(`created_at`) = 08 AND year(`created_at`) =$tahun, 1, 0 )) AS `agu`,
SUM(IF(month(`created_at`) = 09 AND year(`created_at`) =$tahun, 1, 0 )) AS `sep`,
SUM(IF(month(`created_at`) = 10 AND year(`created_at`) =$tahun, 1, 0 )) AS `okt`,
SUM(IF(month(`created_at`) = 11 AND year(`created_at`) =$tahun, 1, 0 )) AS `nov`,
SUM(IF(month(`created_at`) = 12 AND year(`created_at`) =$tahun, 1, 0 )) AS `des`
FROM tb_perkara;");
        return $data->getResultArray();
    }
}
