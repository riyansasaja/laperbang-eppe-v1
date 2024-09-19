<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use config\Auth;
use CodeIgniter\API\ResponseTrait;
use \Firebase\JWT\JWT;
use App\Models\LoginModel;
use App\Models\ModelBundelB;
use App\Models\ModelJenisPerkara;
use App\Models\ModelLSP;
use App\Models\ModelPerkara;
use App\Models\ModelrefBundelB;
use App\Models\UserModel;
use Firebase\JWT\Key;
use PhpParser\Node\Stmt\Echo_;

class Banding extends BaseController
{

    use ResponseTrait;

    public function index()
    {
        //
        return view('banding/index');
    }

    public function getPerkarabanding()
    {
        $modelPerkara = new ModelPerkara();
        $data = $modelPerkara->where('id_user', user()->id)->orderBy('id_perkara', 'desc')->findAll();
        if ($data == null) {
            # code...
            return $this->failNotFound('Data Tidak ditemukan');
        }
        //response
        $response = [
            'status' => 200,
            'error' => false,
            'message' => 'Data Status Perkara ditemukan',
            'data' => $data
        ];
        return $this->respond($response); //kirim response json
    }

    public function addPerkarabanding()
    {
        // inisiasi modul
        $modeljp = new ModelJenisPerkara();
        $modelPerkara = new ModelPerkara();

        $data['perkaras'] = $modeljp->where('status_jp', 1)->findAll();
        if (!$this->request->is('post')) {
            # code...
            return view('banding/addbanding', $data);
        }
        $rules = [
            'id_user'           =>  'required',
            'no_perkara'        =>  'required|is_unique[tb_perkara.no_perkara]',
            'pihak_p'           =>  'required',
            'pihak_t'           =>  'required',
            'hp_pihak_p'        =>  'required|numeric',
            'hp_pihak_t'        =>  'required|numeric',
            'jenis_perkara'     =>  'required',

        ];

        $data['post'] = $this->request->getPost(array_keys($rules));
        if (! $this->validateData($data['post'], $rules)) {
            //flash data for swal2
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->back()->withInput(); //kembalikan ke addbanding
        }
        // If you want to get the validated data.
        $validData = $this->validator->getValidated();
        //function for success
        $insert = $modelPerkara->insert($validData);
        if ($insert) {
            # code...
            session()->setFlashdata('success', 'Data Perkara Baru Berhasil Ditambahkan');
            return redirect()->to('user/banding');
        } else {
            # code...
            session()->setFlashdata('error', 'Data tidak berhasil ditambahkan, coba lagi!');
            return redirect()->to('user/banding');
        }
    }

    public function uploadBundel($id)
    {
        //inisiasi model
        $modelPerkara = new ModelPerkara();
        $modelbundelb = new ModelBundelB();
        $modelrefbundelb = new ModelrefBundelB();
        //ambil data perkara 
        $data['perkara'] = (object)$modelPerkara->where('id_perkara', $id)->first();
        //ambil data bundel b
        $data['bundelb'] = $modelbundelb->select('label_b, nama_file_b, verval_status')->where('id_perkara', $id)->findAll();
        $data['label'] = (object)$modelrefbundelb->findAll();
        return view('banding/uploadfiles', $data);
    }

    public function uploadBundelB()
    {
        $modelPerkara = new ModelPerkara(); //inisaiasi model perkara
        $modelbundelb = new ModelBundelB(); //inisiasi model bundel b
        //ambil hasil kiriman file
        $label = $this->request->getPost('label');
        $id_perkara = $this->request->getPost('id_perkara');
        $files = $this->request->getFile('bundelb');
        //ambil data perkara dari tabel perkara, join ke tb users
        $perkara = (object)$modelPerkara->select('tb_perkara.*, users.username')->join('users', 'tb_perkara.id_user=users.id')->where('tb_perkara.id_perkara', $id_perkara)->first();
        $labelb = []; //buat array kosong untuk menampung data labelb
        $hasupload =  $modelbundelb->where('id_perkara', $id_perkara)->findAll();
        foreach ($hasupload as $key => $upload) {
            # code...
            $labelb[] = $upload['label_b']; //masukkan data ke array labelb
        }
        $cekfile = array_search($label, $labelb); //cek sudah ada jenis file serupa atau belum

        if ($cekfile !== false) {
            # Jika sudah ada file serupa langsung kasih pesan error
            session()->setFlashdata('error', 'File Sudah Diupload, silahkan Hapus Terlebih dahulu');
            return redirect()->to('/user/upload' . '/' . $id_perkara);
        }

        //Jika Belum ada file tersebut 
        //jalankan upload

        //validate rule upload
        $validationRule = [
            'bundelb' => [
                'label' => 'File',
                'rules' => [
                    'uploaded[bundelb]',
                    'ext_in[bundelb,pdf]',
                    // 'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    // 'max_size[inmailAttachmet, 2048]',
                    // 'max_dims[userfile,1024,768]',
                ],
            ],
        ];

        if (!$this->validateData([], $validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];
            session()->setFlashdata('error', $data);
            return redirect()->to('/user/upload' . '/' . $id_perkara);
        }

        //ganti nomor perkara "/" ke "-"
        $new_no_perkara = str_replace('/', '-', $perkara->no_perkara);
        // hapus string "."
        $new_name = str_replace('.', '', $new_no_perkara);
        $newName = date('Ymdhis') . '_' . $label .   '.' . $files->getClientExtension();
        //pindahkan ke folder
        $files->move('uploads/' . $perkara->username . '/' . $new_name . '/' . 'bundelb/', $newName);

        //cek file berhasil dipindahkan atau tidak
        if ($files->hasMoved()) {
            # ambil data 
            $datadb = [
                'id_perkara' => $id_perkara,
                'nama_file_b' => $newName,
                'label_b' => $label,
                'verval_status' => '1'
            ];
            //masukkan ke dbd
            $modelbundelb = new ModelBundelB();
            $insertdb = $modelbundelb->insert($datadb);
            if (!$insertdb) {
                # kembalikan info gagal
                $data = ['uploaded_fileinfo' => 'Gagal Input Database'];
                session()->setFlashdata('error', $data);
                return redirect()->to('/user/upload' . '/' . $id_perkara);
            }
            $data = ['uploaded_fileinfo' => 'Lampiran Berhasil di Upload'];
            session()->setFlashdata('success', $data);
            return redirect()->to('/user/upload' . '/' . $id_perkara);
        }

        //jika file gagal dipindahkan
        $data = ['errors' => 'The file has already been moved.'];
        session()->setFlashdata('error', $data);
        return redirect()->to('/user/upload' . '/' . $id_perkara);
    }
}
