<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBundelA;
use App\Models\ModelBundelB;
use CodeIgniter\HTTP\ResponseInterface;

class Verifikator extends BaseController
{

    //inisiasi
    private $model_bundel_a;
    private $model_bundel_b;

    public function __construct()
    {
        //inisiasi model 
        $this->model_bundel_a =  new ModelBundelA();
        $this->model_bundel_b =  new ModelBundelB();
    }


    public function index()
    {
        //
        $data['bundel_a_validation'] = $this->model_bundel_a->getDataNonVerified();
        $data['bundel_b_validation'] = $this->model_bundel_b->getDataNonVerified();

        dd($data);
        return view('validator/index', $data);
        // 
        return view('verifikator/index');
    }
}
