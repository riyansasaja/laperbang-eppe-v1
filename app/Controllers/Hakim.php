<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MajelisModel;
use App\Models\ModelBundelA;
use App\Models\ModelBundelB;
use App\Models\ModelPerkara;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Hakim extends BaseController
{

    //user Model
    private $modelUser;
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
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        //ambil data majelis
        $majelis = $this->modelMajelis->where('id_user', user()->id)->first();
        //cek null atau tidak
        if (is_null($majelis)) {
            $data['perkara'] =  [];
        } else {
            # code...
            //ambil data perkara
            $data['perkara'] = $this->modelPerkara->where('majelis', $majelis['Majelis'])->findAll();
        }

        return view('hakim/getbanding', $data);
    }

    public function detilPerkara($id_perkara)
    {
        //ambil data detil perkara
        $data['perkara'] = $this->modelPerkara->where('id_perkara', $id_perkara)->first();
        //ambil username
        $data['user'] = $this->modelUser->select('username')->where('id', $data['perkara']['id_user'])->first();
        //ambil lampiran file
        $data['bundela'] = $this->modelbundelA->where('id_perkara', $id_perkara)->where('verval_status', '3')->findAll();
        $data['bundelb'] = $this->modelbundelB->where('id_perkara', $id_perkara)->where('verval_status', 3)->findAll();
        return view('hakim/detilperkara', $data);
    }
}
