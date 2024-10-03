<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBundelA;
use App\Models\ModelBundelB;
use App\Models\ModelPerkara;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Admin extends BaseController
{
    use ResponseTrait;
    //inisiasi model perkara, model bundel A, model bundelb
    private $modelPerkara;
    private $modelBundelA;
    private $modelBundelB;

    //buat constructor
    public function __construct()
    {
        $this->modelPerkara = new ModelPerkara();
        $this->modelBundelA = new ModelBundelA();
        $this->modelBundelB = new ModelBundelB();
    }



    public function index()
    {
        $data['allPerkara'] = $this->modelPerkara->getPerkarabanding();
        //return view admin, kirim data perkara
        return view('admin/banding', $data);
    }

    public function users()
    {
        return view('admin/users');
    }


    public function getAllDataBanding()
    {
        $data = $this->modelPerkara->getPerkarabanding();
        return $this->respond($data);
    }


    //detilBanding
    public function detilBanding($no)
    {
        //get post nomor perkara
        $nomorperkara = decodelink($no);
        //getdetilbynomor
        $data['perkara'] = $this->modelPerkara->getdetilByNomor($nomorperkara);
        //ambil id perkara
        $detilperkara = $this->modelPerkara->where('no_perkara', $nomorperkara)->first();
        $id_perkara = $detilperkara['id_perkara'];
        //getbundelA by id perkara
        $data['bundela'] = $this->modelBundelA->where('id_perkara', $id_perkara)->findAll();
        //getbundelB by id perkara
        $data['bundelb'] = $this->modelBundelB->where('id_perkara', $id_perkara)->findAll();
        //kembalikan ke view admin detilbanding
        return view('admin/detilbanding', $data);
    }
}
