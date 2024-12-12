<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MajelisModel;
use App\Models\ModelBundelA;
use App\Models\ModelBundelB;
use App\Models\ModelPerkara;
use CodeIgniter\HTTP\ResponseInterface;

class Hakim extends BaseController
{

    //model perkara
    private $modelPerkara;
    //model majelis
    private $modelMajelis;
    //model bundel a
    private $modelbundelA;
    //model bundel b
    private $modelbundelB;


    public function __construct()
    {
        $this->modelPerkara = new ModelPerkara();
        $this->modelMajelis = new MajelisModel();
        $this->modelbundelA = new ModelBundelA();
        $this->modelbundelB = new ModelBundelB();
    }

    public function index()
    {
        //ambil data majelis
        $majelis = $this->modelMajelis->where('id_user', user()->id)->first();
        //ambil data perkara
        $data['perkara'] = $this->modelPerkara->where('majelis', $majelis['Majelis'])->findAll();
        return view('hakim/getbanding', $data);
    }

    public function detilPerkara($id_perkara)
    {
        //ambil data detil perkara
        $data['perkara'] = $this->modelPerkara->where('id_perkara', $id_perkara)->first();
        //ambil lampiran file
        $data['bundela'] = $this->modelbundelA->where('id_perkara', $id_perkara)->findAll();
        $data['bundelb'] = $this->modelbundelB->where('id_perkara', $id_perkara)->findAll();

        dd($data);
    }
}
