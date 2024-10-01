<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBundelA;
use App\Models\ModelBundelB;
use CodeIgniter\HTTP\ResponseInterface;

class Verifikator extends BaseController
{

    //inisiasi model
    private $model_bundel_a;
    private $model_bundel_b;

    public function __construct()
    {
        //inisiasi model 
        $this->model_bundel_a =  new ModelBundelA();
        $this->model_bundel_b =  new ModelBundelB();
    }

    ####Tampilkan file di Index
    public function index()
    {
        //
        $data['bundel_a_validation'] = $this->model_bundel_a->getDataNonVerified();
        $data['bundel_b_validation'] = $this->model_bundel_b->getDataNonVerified();

        //tampilkan data untuk Diverifikasi
        return view('verifikator/index', $data);
    }
    ####Tampilkan file yang telah diverifikasi
    public function hasverified()
    {
        $data['bundel_a_validation'] = $this->model_bundel_a->getDataVerified();
        $data['bundel_b_validation'] = $this->model_bundel_b->getDataVerified();
        return view('verifikator/hasverified', $data);
    }


    ####Function Check File


    ####Function untuk Validasi File


    ####Function untuk revalidasi

}
