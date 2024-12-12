<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPerkara;
use CodeIgniter\HTTP\ResponseInterface;

class Panitera extends BaseController
{

    //modelperkara
    private $modelPerkara;

    public function __construct()
    {
        $this->modelPerkara = new ModelPerkara();
    }

    public function index()
    {
        //ambil data perkara dimana pp sama dengan id pp yang login
        $data['perkara'] = $this->modelPerkara->where('id_pp', user()->id)->findAll();
        return view('panitera/getbanding', $data);
    }
}
