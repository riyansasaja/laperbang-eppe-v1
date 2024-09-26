<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBundelA;
use App\Models\ModelBundelB;
use App\Models\ModelLSP;
use CodeIgniter\HTTP\ResponseInterface;

class Validator extends BaseController
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
        $data['bundel_a_validation'] = $this->model_bundel_a->getDataNonValidate();
        $data['bundel_a_validated'] = $this->model_bundel_a->getDataValidate();
        $data['bundel_b_validation'] = $this->model_bundel_b->getDataNonValidate();
        $data['bundel_b_validated'] = $this->model_bundel_b->getDataValidate();

        // dd($data);

        return view('validator/index', $data);
    }

    public function checkFile()
    {
        //ambil data file
        $data['file'] = [
            'bundel' => $this->request->getPost('bundel'),
            'username' => $this->request->getPost('username'),
            'no_perkara' => $this->request->getPost('no_perkara'),
            'nama_file' => $this->request->getPost('nama_file')
        ];

        return view('validator/checkfile', $data);
    }

    public function validateFile()
    {
        //ambil data
        $nama_file = $this->request->getPost('nama_file');
        $bundel = $this->request->getPost('bundel');
        $komentar = $this->request->getPost('komentar');
        //cek bundel dulu 
        if ($bundel == 'bundelb') {
            //ambil data dari bundelb
            $getdata = $this->model_bundel_b->where('nama_file_b', $nama_file)->first();
            $id = $getdata['id_upload_b']; //ambil data id;
            # cek tombol yg ditekan
            if ($this->request->getPost('sesuai') !== null) {
                # code...
                $data = [
                    'verval_status' => 2, //2 untuk divalidasi
                    'komentar'      => $komentar
                ];
                $update = $this->model_bundel_b->update($id, $data);
                if ($update) { //cek update database atau tidak
                    session()->setFlashdata('success', 'Data Berhasil Di Validasi');
                    return redirect()->to('validator');
                } else {
                    # Sampaikan Error
                    session()->setFlashdata('error', 'Data validasi tidak tersimpan di Database');
                    return redirect()->to('validator');
                }
            }
            if ($this->request->getPost('tidak') !== null) {
                # tentukan data
                $data = [
                    'verval_status' => 4, //4 untuk ditolak
                    'komentar'      => $komentar
                ];
                $update = $this->model_bundel_b->update($id, $data); //update data
                if ($update) { //cek update database atau tidak
                    session()->setFlashdata('success', 'Data Dinyatakan tidak sesuai');
                    return redirect()->to('validator');
                } else {
                    # sampaikan error
                    session()->setFlashdata('error', 'Data validasi tidak tersimpan di Database');
                    return redirect()->to('validator');
                }
            }
        }
    }
}
