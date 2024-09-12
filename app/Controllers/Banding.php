<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use config\Auth;
use CodeIgniter\API\ResponseTrait;
use \Firebase\JWT\JWT;
use App\Models\LoginModel;
use App\Models\ModelLSP;
use App\Models\ModelPerkara;
use App\Models\UserModel;
use Firebase\JWT\Key;
use PhpParser\Node\Stmt\Echo_;

class Banding extends BaseController
{

    use ResponseTrait;

    public function index()
    {
        //
        return view('banding/index');
    }

    public function getPerkarabanding()
    {
        $modelPerkara = new ModelPerkara();
        $data = $modelPerkara->where('id_user', user()->id)->findAll();
        if ($data == null) {
            # code...
            return $this->failNotFound('Data Tidak ditemukan');
        }
        $response = [
            'status' => 200,
            'error' => false,
            'message' => 'Data Status Perkara ditemukan',
            'data' => $data
        ];
        return $this->respond($response);
    }
}
