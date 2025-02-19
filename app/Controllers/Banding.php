<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelBundelA;
use App\Models\ModelBundelB;
use App\Models\ModelJenisPerkara;
use App\Models\ModelPerkara;
use App\Models\ModelrefBundelA;
use App\Models\ModelrefBundelB;
use App\Models\TimeControlModel;
use App\Models\UserModel;
use PhpParser\ErrorHandler\Throwing;

class Banding extends BaseController
{

    use ResponseTrait;
    protected $validatorphone;

    public function __construct()
    {
        $userModel = new UserModel();
        $this->validatorphone = $userModel->select('phone')->where('username', 'validator')->first()->phone;
    }

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
            return $this->failNotFound('Data tidak ditemukan atau kosong');
        }
        //response
        $response = [
            'status' => 200,
            'error' => false,
            'message' => 'Success',
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
            'status'            =>  'required'

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
            # if success insert to database
            session()->setFlashdata('success', 'Data Perkara Baru Berhasil Ditambahkan'); //set flash data
            return redirect()->to('user/banding'); //kembalikan ke daftar perkara dengan flash message
        } else {
            # code...
            session()->setFlashdata('error', 'Data Perkara tidak berhasil diinput di database, coba lagi, atau hubungi admin!'); //set flash data
            return redirect()->to('user/banding'); //kembalikan ke daftar perkara dengan flash message
        }
    }

    public function editPerkaraBanding($id)
    {
        // inisiasi modul
        $modeljp = new ModelJenisPerkara();
        $modelPerkara = new ModelPerkara();

        //ambil seluruh data jenis perkara di simpan dalam array perkaras
        $data['perkaras'] = $modeljp->where('status_jp', 1)->findAll();
        //ambil detil perkara berdasarkan id di simpan dalam array detilperkara
        $data['detilperkara'] = $modelPerkara->where('id_perkara', $id)->first();
        if (!$this->request->is('post')) {
            # code...
            return view('banding/editbanding', $data);
        }
        $rules = [
            'no_perkara'        =>  'required',
            'pihak_p'           =>  'required',
            'pihak_t'           =>  'required',
            'hp_pihak_p'        =>  'required|numeric',
            'hp_pihak_t'        =>  'required|numeric',
            'jenis_perkara'     =>  'required',
            'status'            =>  'required'

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
        $update = $modelPerkara->update($id, $validData);
        if ($update) {
            # if success insert to database
            session()->setFlashdata('success', 'Data Perkara Berhasil Diedit'); //set flash data
            return redirect()->to('user/banding'); //kembalikan ke daftar perkara dengan flash message
        } else {
            # code...
            session()->setFlashdata('error', 'Data Perkara tidak berhasil diedit di database, coba lagi, atau hubungi admin!'); //set flash data
            return redirect()->to('user/banding'); //kembalikan ke daftar perkara dengan flash message
        }
    }

    public function uploadBundel($id)
    {
        //inisiasi model
        $modelPerkara = new ModelPerkara();
        $modelbundelb = new ModelBundelB();
        $modelbundela = new ModelBundelA();
        $modelrefbundelb = new ModelrefBundelB();
        $modelrefbundela = new ModelrefBundelA();
        //ambil data perkara 
        $data['perkara'] = (object)$modelPerkara->where('id_perkara', $id)->first();
        //ambil data bundel b
        $data['bundelb'] = $modelbundelb->where('id_perkara', $id)->findAll();
        $data['bundela'] = $modelbundela->where('id_perkara', $id)->findAll();
        $data['label'] = (object)$modelrefbundelb->findAll();
        $data['label_a'] = (object)$modelrefbundela->select('nama_label')->findAll();
        return view('banding/uploadfiles', $data);
    }

    public function uploadBundelB()
    {
        $modelPerkara = new ModelPerkara(); //inisaiasi model perkara
        $modelbundelb = new ModelBundelB(); //inisiasi model bundel b
        $timeControlModel = new TimeControlModel(); //inisiasi model TimeControl
        //ambil hasil kiriman file
        $label = $this->request->getPost('label');
        $id_perkara = $this->request->getPost('id_perkara');
        $files = $this->request->getFile('bundelb');

        //cek time control true or false
        $endTime = $timeControlModel->cekTime($id_perkara);
        if ($endTime) {
            # code...
            session()->setFlashdata('error', 'Udah dibilangin minta lepas kunci masih ngeyel!!!');
            return redirect()->to('/user/upload' . '/' . $id_perkara);
        }


        //cek mereka kirim label atau tidak??
        if ($label === "") {
            session()->setFlashdata('error', 'Silahkan Pilih Jenis File yang Mau di Upload');
            return redirect()->to('/user/upload' . '/' . $id_perkara);
        }
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
                    'ext_in[bundelb,pdf,rtf]',
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

        // clear string
        $new_name = clear($perkara->no_perkara);

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

            //jika sudah insert di database baru masuk ke tb time kontrol
            //cek dulu kalau labelnya Akta Banding
            if ($label == 'Akta Banding') {
                # input ke database tb_time_kontrol
                //inisiasi
                $modelTimeControl = new TimeControlModel();
                $dataTimeControl = [
                    'user_id'   => user()->id,
                    'id_perkara' => $id_perkara,
                    'time_log'  => time()
                ];
                $modelTimeControl->insert($dataTimeControl);
            }



            //notification whatsapp
            notification($this->validatorphone, $label . ' untuk Perkara ' . $perkara->no_perkara . ' selesai diupload, siap *DIVALIDASI*');

            $data = ['uploaded_fileinfo' => 'Lampiran Berhasil di Upload'];
            session()->setFlashdata('success', $data);
            return redirect()->to('/user/upload' . '/' . $id_perkara);
        }

        //jika file gagal dipindahkan
        $data = ['errors' => 'The file has already been moved.'];
        session()->setFlashdata('error', $data);
        return redirect()->to('/user/upload' . '/' . $id_perkara);
    }



    function uploadBundelA()
    {

        $modelPerkara = new ModelPerkara(); //inisaiasi model perkara
        $modelbundel = new ModelBundelA(); //inisiasi model bundel b
        $timeControlModel = new TimeControlModel(); //inisiasi model timeControl

        //ambil hasil kiriman file
        $label = $this->request->getPost('label');
        $id_perkara = $this->request->getPost('id_perkara');
        $files = $this->request->getFile('bundela');



        //cek time control true or false
        $endTime = $timeControlModel->cekTime($id_perkara);
        if ($endTime) {
            # code...
            session()->setFlashdata('error', 'Udah dibilangin minta lepas kunci masih ngeyel!!!');
            return redirect()->to('/user/upload' . '/' . $id_perkara);
        }



        //cek mereka kirim label atau tidak??
        if ($label === "") {
            session()->setFlashdata('error', 'Silahkan Pilih Jenis File yang Mau di Upload');
            return redirect()->to('/user/upload' . '/' . $id_perkara);
        }

        //ambil data perkara dari tabel perkara, join ke tb users
        $perkara = (object)$modelPerkara->select('tb_perkara.*, users.username')->join('users', 'tb_perkara.id_user=users.id')->where('tb_perkara.id_perkara', $id_perkara)->first();
        $labelb = []; //buat array kosong untuk menampung data labelb
        $hasupload =  $modelbundel->where('id_perkara', $id_perkara)->findAll();
        foreach ($hasupload as $key => $upload) {
            # code...
            $labelb[] = $upload['label_a']; //masukkan data ke array labelb
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
            'bundela' => [
                'label' => 'Bundel B',
                'rules' => [
                    'uploaded[bundela]',
                    'ext_in[bundela,pdf]',
                    // 'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    // 'max_size[inmailAttachmet, 2048]',
                    // 'max_dims[userfile,1024,768]',
                ],
            ]
        ];

        if (!$this->validateData([], $validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];
            session()->setFlashdata('error', $data);
            return redirect()->to('/user/upload' . '/' . $id_perkara);
        }

        // clear string
        $new_name = clear($perkara->no_perkara);

        $newName = date('Ymdhis') . '_' . clear($label) .   '.' . $files->getClientExtension();
        //pindahkan ke folder
        $files->move('uploads/' . $perkara->username . '/' . $new_name . '/' . 'bundela/', $newName);

        //cek file berhasil dipindahkan atau tidak
        if ($files->hasMoved()) {
            # ambil data 
            $datadb = [
                'id_perkara' => $id_perkara,
                'nama_file_a' => $newName,
                'label_a' => $label,
                'verval_status' => '1'
            ];
            //masukkan ke dbd
            $insertdb = $modelbundel->insert($datadb);
            if (!$insertdb) {
                # kembalikan info gagal
                $data = ['uploaded_fileinfo' => 'Gagal Input Database'];
                session()->setFlashdata('error', $data);
                return redirect()->to('/user/upload' . '/' . $id_perkara);
            }

            //notification whatsapp
            notification($this->validatorphone, $label . ' untuk Perkara ' . $perkara->no_perkara . ' selesai diupload, siap *DIVALIDASI*');

            $data = ['uploaded_fileinfo' => 'Lampiran Berhasil di Upload'];
            session()->setFlashdata('success', $data);
            return redirect()->to('/user/upload' . '/' . $id_perkara);
        }

        //jika file gagal dipindahkan
        $data = ['errors' => 'The file has already been moved.'];
        session()->setFlashdata('error', $data);
        return redirect()->to('/user/upload' . '/' . $id_perkara);
    }

    public function delBundelA($nama_file, $nomorperkara)
    {
        $bundelmodel = new ModelBundelA();
        $username = user()->username;
        $bundela = $bundelmodel->where('nama_file_a', $nama_file)->first();
        $file = new \CodeIgniter\Files\File('uploads/' . $username . '/' . $nomorperkara . '/' . 'bundela/' . $nama_file);
        $delete = $bundelmodel->where('nama_file_a', $nama_file)->delete();
        if ($delete) {
            # code...
            $file->move('uploads/delete/');
        }
        session()->setFlashdata('success', 'Data Berhasil dihapus');
        return redirect()->to('/user/upload' . '/' . $bundela['id_perkara']);
    }


    public function delBundelB($nama_file, $nomorperkara)
    {
        $bundelbmodel = new ModelBundelB();
        $username = user()->username;
        $bundelb = $bundelbmodel->where('nama_file_b', $nama_file)->first();
        $file = new \CodeIgniter\Files\File('uploads/' . $username . '/' . $nomorperkara . '/' . 'bundelb/' . $nama_file);
        $delete = $bundelbmodel->where('nama_file_b', $nama_file)->delete();
        if ($delete) {
            # code...
            $file->move('uploads/delete/');
        }
        session()->setFlashdata('success', 'Data Berhasil dihapus');
        return redirect()->to('/user/upload' . '/' . $bundelb['id_perkara']);
    }


    public function getTimeControlbyId($idperkara)
    {
        //inisasi model time contorl
        $timeControlModel = new TimeControlModel();
        //search by id
        $timeControl = $timeControlModel->where('id_perkara', $idperkara)
            ->orderBy('time_log_id', 'DESC')
            ->limit(1)
            ->first();

        return $this->respondCreated($timeControl);
    }

    public function requestUnlock()
    {
        $data['csrf'] = csrf_hash();
        $idperkara = $this->request->getPost('idperkara');
        $pesan = $this->request->getPost('pesan');

        //inisasi user model
        $usermodel = new UserModel();
        //ambil data phone admin
        $adminphone = $usermodel->select('phone')->where('username', 'admin')->first();

        //inisasi model perkara
        $perkaraModel = new ModelPerkara();
        //ambil nomo perkara
        $noPerkara = $perkaraModel->select('no_perkara')->where('id_perkara', $idperkara)->first();
        //kirim notification dengan helper
        notification($adminphone->phone, 'perkara Nomor' . $noPerkara['no_perkara'] . ' Mengajukan Unlock Upload Berkas, dengan Alasan ' . $pesan);
        //kembalikan response
        return $this->respondCreated('Permohonan Unlock sudah dikirim ke Admin PTA, terimakasih.');
    }
}
