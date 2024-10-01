<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBundelA;
use App\Models\ModelBundelB;
use App\Models\ModelPerkara;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
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
        //ambil data perkara
        $data['bandings'] = $this->modelPerkara->getPerkarabanding();
        //return view admin, kirim data perkara
        return view('admin/banding', $data);
    }

    public function users()
    {
        return view('admin/users');
    }

    //detilBanding
    public function detilBanding($no)
    {
        //get post nomor perkara
        $nomorperkara = decodelink($no);
        //getdetilbynomor
        $data['detilPerkara'] = $this->modelPerkara->getdetilByNomor($nomorperkara);
        dd($data);
    }
}
