<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBundelA;
use App\Models\ModelBundelB;
use CodeIgniter\HTTP\ResponseInterface;

class Validator extends BaseController
{
    public function index()
    {
        $model_bundel_a = new ModelBundelA();
        $model_bundel_b = new ModelBundelB();
        //
        $data['bundel_a_validation'] = $model_bundel_a->getDataNonValidate();
        $data['bundel_a_validated'] = $model_bundel_a->getDataValidate();
        $data['bundel_b_validation'] = $model_bundel_b->getDataNonValidate();
        $data['bundel_b_validated'] = $model_bundel_b->getDataValidate();

        // dd($data);

        return view('validator/index', $data);
    }
}
