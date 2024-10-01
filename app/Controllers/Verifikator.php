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
    public function checkFile()
    {
        //ambil data file
        $data['file'] = [
            'bundel' => $this->request->getPost('bundel'),
            'username' => $this->request->getPost('username'),
            'no_perkara' => $this->request->getPost('no_perkara'),
            'nama_file' => $this->request->getPost('nama_file')
        ];

        return view('verifikator/checkfile', $data);
    }


    ####Function untuk Validasi File
    public function verifiedFile()
    {
        $nama_file = $this->request->getPost('nama_file');
        $bundel = $this->request->getPost('bundel');
        $komentar = $this->request->getPost('komentar');
        //cek apakah berkas bundel b
        if ($bundel == 'bundelb') {
            //ambil data dari bundelb
            $getdata = $this->model_bundel_b->where('nama_file_b', $nama_file)->first();
            $id = $getdata['id_upload_b']; //ambil data id;
            # cek tombol yg ditekan
            if ($this->request->getPost('sesuai') !== null) {
                # code...
                $data = [
                    'verval_status' => 3, //2 untuk diverifikasi
                    'komentar'      => $komentar
                ];
                $update = $this->model_bundel_b->update($id, $data);
                if ($update) { //cek update database atau tidak
                    session()->setFlashdata('success', 'Data berhasil diverifikasi');
                    return redirect()->to('verifikator');
                } else {
                    # Sampaikan Error
                    session()->setFlashdata('error', 'Data verifikasi tidak tersimpan di Database');
                    return redirect()->to('verifikator');
                }
            }
            if ($this->request->getPost('tidak') !== null) {
                # tentukan data
                $data = [
                    'verval_status' => 5, //5 untuk ditolak verifikasi
                    'komentar'      => $komentar
                ];
                $update = $this->model_bundel_b->update($id, $data); //update data
                if ($update) { //cek update database atau tidak
                    session()->setFlashdata('success', 'Data dinyatakan tidak sesuai');
                    return redirect()->to('verifikator');
                } else {
                    # sampaikan error
                    session()->setFlashdata('error', 'Data validasi tidak tersimpan di Database');
                    return redirect()->to('verifikator');
                }
            }
        }
        //cek apakah berkas bundel a
        if ($bundel == 'bundela') {
            //ambil data dari bundela
            $getdata = $this->model_bundel_a->where('nama_file_a', $nama_file)->first();
            $id = $getdata['id_upload_a']; //ambil data id;
            # cek tombol yg ditekan
            if ($this->request->getPost('sesuai') !== null) {
                # code...
                $data = [
                    'verval_status' => 3, //2 untuk diverifikasi
                    'komentar'      => $komentar
                ];
                $update = $this->model_bundel_a->update($id, $data);
                if ($update) { //cek update database atau tidak
                    session()->setFlashdata('success', 'Data berhasil diverifikasi');
                    return redirect()->to('verifikator');
                } else {
                    # Sampaikan Error
                    session()->setFlashdata('error', 'Data verifikasi tidak tersimpan di Database');
                    return redirect()->to('verifikator');
                }
            }
            if ($this->request->getPost('tidak') !== null) {
                # tentukan data
                $data = [
                    'verval_status' => 5, //4 untuk ditolak Verifikasi
                    'komentar'      => $komentar
                ];
                $update = $this->model_bundel_a->update($id, $data); //update data
                if ($update) { //cek update database atau tidak
                    session()->setFlashdata('success', 'Data Dinyatakan tidak sesuai');
                    return redirect()->to('verificator');
                } else {
                    # sampaikan error
                    session()->setFlashdata('error', 'Data validasi tidak tersimpan di Database');
                    return redirect()->to('verifikator');
                }
            }
        }
    }


    ####Function untuk revalidasi
    public function reverif()
    {
        $nama_file = $this->request->getPost('nama_file');
        $bundel = $this->request->getPost('bundel');

        // dd($nama_file);

        if ($bundel == 'bundelb') {
            //ambil data dari bundelb
            $getdata = $this->model_bundel_b->where('nama_file_b', $nama_file)->first();
            $id = $getdata['id_upload_b']; //ambil data id;

            $data = [
                'verval_status' => 2, //2 kembalikan ke awal sebelum di verifikasi
                'komentar'      => null
            ];
            $update = $this->model_bundel_b->update($id, $data);
            if ($update) { //cek update database atau tidak
                session()->setFlashdata('success', 'Data verifikasi dokumen berhasil dibatalkan');
                return redirect()->to('verifikator/hasverified');
            } else {
                # Sampaikan Error
                session()->setFlashdata('error', 'Data validasi tidak tersimpan di Database');
                return redirect()->to('verifikator/hasverified');
            }
        }
        //cek apakah berkas bundel a
        if ($bundel == 'bundela') {
            //ambil data dari bundela
            $getdata = $this->model_bundel_a->where('nama_file_a', $nama_file)->first();
            $id = $getdata['id_upload_a']; //ambil data id;

            $data = [
                'verval_status' => 2, //2 untuk divalidasi
                'komentar'      => null
            ];
            $update = $this->model_bundel_a->update($id, $data);
            if ($update) { //cek update database atau tidak
                session()->setFlashdata('success', 'Data verifikasi dokumen berhasil dibatalkan');
                return redirect()->to('verifikator/hasverified');
            } else {
                # Sampaikan Error
                session()->setFlashdata('error', 'Data validasi tidak tersimpan di Database');
                return redirect()->to('verifikator/hasverified');
            }
        }
    }
}
