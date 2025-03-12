<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPerkara;
use CodeIgniter\HTTP\ResponseInterface;

class Pimpinan extends BaseController
{
    public function index()
    {
        $modalPerkara = new ModelPerkara();
        $data['prapmh'] = $modalPerkara->where('status', 'Proses Penunjukan Pra Majelis')->findAll();
        //ambil data perkara yang  status Proses Penunjukan Pra Majelis
        //Ambil Nomor Perkara yang ada
        //find berdasarkan statsu penunjukan pra majelis
//        show di tampilan
        //kembali ke tampilan pimpinan
        return view('pimpinan/show', $data);
    }
}
