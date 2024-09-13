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
use App\Models\ModelJenisPerkara;
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
        $data = $modelPerkara->where('id_user', user()->id)->orderBy('id_perkara', 'desc')->findAll();
        if ($data == null) {
            # code...
            return $this->failNotFound('Data Tidak ditemukan');
        }
        //response
        $response = [
            'status' => 200,
            'error' => false,
            'message' => 'Data Status Perkara ditemukan',
            'data' => $data
        ];
        return $this->respond($response); //kirim response json
    }

    public function addPerkarabanding()
    {
        // inisiasi modul
        $modeljp = new ModelJenisPerkara();
        $modelPerkara = new ModelPerkara();

        $data['perkaras'] = $modeljp->where('status_jp', 1)->findAll();
        if (!$this->request->is('post')) {
            # code...
            return view('banding/addbanding', $data);
        }
        $rules = [
            'id_user'           =>  'required',
            'no_perkara'        =>  'required|is_unique[tb_perkara.no_perkara]',
            'pihak_p'           =>  'required',
            'pihak_t'           =>  'required',
            'hp_pihak_p'        =>  'required|numeric',
            'hp_pihak_t'        =>  'required|numeric',
            'jenis_perkara'     =>  'required',

        ];

        $data['post'] = $this->request->getPost(array_keys($rules));
        if (! $this->validateData($data['post'], $rules)) {
            //flash data for swal2
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->back()->withInput(); //kembalikan ke addbanding
        }
        // If you want to get the validated data.
        $validData = $this->validator->getValidated();
        //function for success
        $insert = $modelPerkara->insert($validData);
        if ($insert) {
            # code...
            session()->setFlashdata('success', 'Data Perkara Baru Berhasil Ditambahkan');
            return redirect()->to('user/banding');
        } else {
            # code...
            session()->setFlashdata('error', 'Data tidak berhasil ditambahkan, coba lagi!');
            return redirect()->to('user/banding');
        }
    }
}
