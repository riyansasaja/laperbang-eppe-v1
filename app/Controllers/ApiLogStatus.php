<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use config\Auth;
use CodeIgniter\API\ResponseTrait;
use \Firebase\JWT\JWT;
use App\Models\LoginModel;
use App\Models\ModelLSP;
use App\Models\UserModel;
use Firebase\JWT\Key;
use CodeIgniter\HTTP\ResponseInterface;
use PhpParser\Node\Stmt\Echo_;

use function PHPSTORM_META\map;

class ApiLogStatus extends BaseController
{

    use ResponseTrait;
    protected $auth;

    public function find()
    {
        $no = $this->request->getVar('no');
        $tahun = $this->request->getVar('tahun');

        $noper = $no . '/' . 'Pdt.G/' . $tahun . '/PTA.Mdo';
        //
        // return ($noper);
        $modelsp = new ModelLSP();
        $data = $modelsp->where('nomor', $noper)->findAll();
        if (!$data) {
            # code...
            return $this->failNotFound('Data Tidak ditemukan');
        } else {
            # code...
            $response = [
                'status' => 200,
                'error' => false,
                'message' => 'Data Status Perkara ditemukan',
                'data' => $data
            ];
            return $this->respond($response);
        }
    }
}
