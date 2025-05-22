<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MajelisBaruModel;
use App\Models\ModelPerkara;
use App\Models\PramajelisModel;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Models\GroupModel;
use CodeIgniter\API\ResponseTrait;
use PhpParser\Node\Expr\Empty_;

class Pimpinan extends BaseController
{
    public function index()
    {

        $groupModel = new GroupModel();
        $modalPerkara = new ModelPerkara();
        $data['prapmh'] = $modalPerkara->where('status', 'Proses Penunjukan Pra Majelis')->findAll();
        $data['para_hakim'] = $groupModel->getUsersForGroup(6);

        // dd($data['para_hakim']);
        //ambil data perkara yang  status Proses Penunjukan Pra Majelis
        //Ambil Nomor Perkara yang ada
        //find berdasarkan statsu penunjukan pra majelis
        //        show di tampilan
        //kembali ke tampilan pimpinan
        return view('pimpinan/show', $data);
    }
    public function pramajelis()
    {

        $modelPerkara = new ModelPerkara();
        $id_perkara = $this->request->getPost('id_perkara');
        $id_user_hakim = $this->request->getPost('id_user_hakim');
        foreach ($id_user_hakim as $nm) {
            # code...
            $this->saveMajelis($nm, $id_perkara);
        }

        $edit_perkara = [
            'status' => 'Penunjukan Pra Majelis'
        ];
        $modelPerkara->update($id_perkara, $edit_perkara);
        session()->setFlashdata('success', 'Data Pra Majelis berhasil dipilih'); //set flash data
        return redirect()->back();
    }

    private function saveMajelis($id_user_hakim, $id_perkara)
    {
        $pramajelisModel = new PramajelisModel();
        $data = [
            'id_perkara' => $id_perkara,
            'id_user' => $id_user_hakim
        ];

        return $pramajelisModel->save($data);
    }
}
