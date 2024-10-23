<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MajelisModel;
use App\Models\ModelBundelA;
use App\Models\ModelBundelB;
use App\Models\ModelLSP;
use App\Models\ModelPerkara;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Password;
use PHPUnit\Util\ThrowableToStringMapper;

class Admin extends BaseController
{
    use ResponseTrait;
    //inisiasi model perkara, model bundel A, model bundelb
    private $modelPerkara;
    private $modelBundelA;
    private $modelBundelB;
    private $userModel;
    public $authorize;
    private $groupModel;
    private $validation;
    private $lspModel;

    protected $auth;

    /**
     * @var AuthConfig
     */
    protected $config;

    /**
     * @var Session
     */
    protected $session;



    //buat constructor
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->lspModel = new ModelLSP();
        $this->modelPerkara = new ModelPerkara();
        $this->modelBundelA = new ModelBundelA();
        $this->modelBundelB = new ModelBundelB();
        $this->authorize = service('authorization');
        $this->groupModel = new \Myth\Auth\Models\GroupModel();
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth   = service('authentication');
        $this->validation = service('validation');

        date_default_timezone_set('Asia/Singapore');
    }


    //===============
    public function index()
    {
        $data['allPerkara'] = $this->modelPerkara->getPerkarabanding();
        //return view admin, kirim data perkara
        return view('admin/banding', $data);
    }

    //===============
    public function users()
    {

        // //mengambil seluruh data users lengkap dengan role
        $data['users'] = $this->userModel->findAll();
        // dd($data);
        //kemudian dikirim ke view

        return view('admin/users', $data);
    }

    //===============
    public function addUser()
    {
        $users = model(UserModel::class);

        $rules = [
            'email'    => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
            'fullname'     => 'required',
            'nip'          => 'required|numeric',
            'jabatan'      => 'required',
            'phone'         => 'required'
        ];



        if (! $this->validate($rules)) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->back();
        }

        $rules = [
            'password'     => 'required',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->to('admin/users');
        }

        // Save the user
        $allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
        $user              = new User($this->request->getPost($allowedPostFields));

        $this->config->requireActivation === null ? $user->activate() : $user->generateActivateHash();

        // Ensure default group gets assigned if set
        if (! empty($this->config->defaultUserGroup)) {
            $users = $users->withGroup($this->config->defaultUserGroup);
        }

        if (! $users->save($user)) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->to('admin/users');
        }

        if ($this->config->requireActivation !== null) {
            $activator = service('activator');
            $sent      = $activator->send($user);

            if (! $sent) {
                session()->setFlashdata('error', $activator->error() ?? lang('Auth.unknownError'));
                return redirect()->to('admin/users');
            }
        }

        // Success!
        session()->setFlashdata('success', 'User Berhasil ditambahkan');
        return redirect()->to('admin/users');
    }

    //===============
    public function detilUser($id)
    {
        $authorize = $auth = service('authorization');
        //panggil model group
        $modelGroup = new GroupModel();
        //panggil data user by id
        $data['user'] = $this->userModel->where('id', $id)->first();
        //return ke view
        $data['getRoles'] = $modelGroup->getGroupsForUser($id);
        $data['allRoles'] = $authorize->groups();
        return view('admin/detiluser', $data);
    }

    //===============
    public function getAllDataBanding()
    {
        $data = $this->modelPerkara->getPerkarabanding();
        return $this->respond($data);
    }


    //detilBanding
    public function detilBanding($no)
    {

        //get post nomor perkara
        $nomorperkara = decodelink($no);
        //getdetilbynomor
        $data['perkara'] = $this->modelPerkara->getdetilByNomor($nomorperkara);
        //ambil id perkara
        $detilperkara = $this->modelPerkara->where('no_perkara', $nomorperkara)->first();
        $id_perkara = $detilperkara['id_perkara'];
        //getbundelA by id perkara
        $data['bundela'] = $this->modelBundelA->where('id_perkara', $id_perkara)->findAll();
        //getbundelB by id perkara
        $data['bundelb'] = $this->modelBundelB->where('id_perkara', $id_perkara)->findAll();
        //getstatus perkara
        $data['status_perkara'] = $this->lspModel->where('nomor', $nomorperkara)->findAll();
        //getpanitera_pengganti
        $data['paniteras'] = $this->userModel->where('jabatan', 'Panitera Pengganti')->findAll();
        //kembalikan ke view admin detilbanding
        return view('admin/detilbanding', $data);
    }

    public function majelisBanding()
    {
        $modelMajelis = new MajelisModel();
        $data['allmajelis'] = $modelMajelis->select('tb_majelis.*, users.fullname')
            ->join('users', 'tb_majelis.id_user = users.id')
            ->findAll();
        $data['userHakim'] = $this->userModel->select('id, fullname')->where('jabatan', 'Hakim')->findAll();
        return view('admin/majelisbanding', $data);
    }

    public function setMajelis()
    {

        //Panggil Modal Majelis
        $modalMajelis = new MajelisModel();
        //validation
        if (!$this->validate(
            [
                'id_user' => 'required',
                'majelis' => 'required'
            ]
        )) {
            # ambil validation
            $validation = \Config\Services::validation();
            #kembalikan validation
            return redirect()->back()->withInput('validation', $validation);
        }
        #jika lolos validation
        $data = [
            'id_user' => $this->request->getVar('id_user'),
            'majelis' => $this->request->getVar('majelis')
        ];
        $modalMajelis->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->back();
    }

    public function delMajelis($id)
    {
        //Panggil Modal Majelis
        $modalMajelis = new MajelisModel();
        //jalankan perintah delete
        $modalMajelis->delete($id);
        //return back
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->back();
    }

    public function addRoles()
    {
        $rules = [
            'user_id' => 'required',
            'group_id' => 'required'
        ];

        // cek validasi
        if (! $this->validate($rules)) {
            # Kembalikan swal
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        //jika lolos ambil data inputan
        $data = $this->validator->getValidated();
        //set group di myth auth
        $this->groupModel->addUserToGroup($data['user_id'], $data['group_id']);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->back();
    }

    public function delRole($user_id, $group_id)
    {
        $this->groupModel->removeUserFromGroup($user_id, $group_id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->back();
    }

    public function editUser()
    {
        $id = $this->request->getPost('id');
        $user = $this->userModel->find($id);

        if (isset($_POST['update'])) {
            #update user
            $userdata = [
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('username'),
                'fullname' => $this->request->getPost('fullname'),
                'nip' => $this->request->getPost('nip'),
                'jabatan' => $this->request->getPost('jabatan'),
                'phone' => $this->request->getPost('phone'),
            ];

            $rules  = [
                'email'    => 'required|valid_email',
                'username' => 'required|min_length[3]|max_length[30]',
                'fullname'     => 'required',
                'nip'          => 'required|numeric',
                'jabatan'      => 'required',
                'phone'         => 'required'
            ];
            if (! $this->validateData($userdata, $rules)) {
                session()->setFlashdata('error', $this->validator->getErrors());
                return redirect()->back()->withInput();
                die;
            }
            //update user data

            $user->email = $userdata['email'];
            $user->username = $userdata['username'];
            $user->fullname = $userdata['fullname'];
            $user->nip = $userdata['nip'];
            $user->jabatan = $userdata['jabatan'];
            $user->phone = $userdata['phone'];


            if ($this->userModel->save($user)) {
                session()->setFlashdata('success', 'Data Berhasil di Update');
                return redirect()->back();
            } else {
                session()->setFlashdata('error', 'Data gagal di Update');
                return redirect()->back();
            }

            die;
        }

        if (isset($_POST['active'])) {
            # code...
            $user->active = 1;
            if ($this->userModel->save($user)) {
                session()->setFlashdata('success', 'User berhasil diaktivkan');
                return redirect()->back();
            } else {
                session()->setFlashdata('error', 'User gagal diaktivkan');
                return redirect()->back();
            }
        }
        if (isset($_POST['inactive'])) {
            # code...
            $user->active = 0;
            if ($this->userModel->save($user)) {
                session()->setFlashdata('success', 'User berhasil di non aktivkan');
                return redirect()->back();
            } else {
                session()->setFlashdata('success', 'User gagal di non aktivkan');
                return redirect()->back();
            }
        }

        if (isset($_POST['delete'])) {
            # code...
            if ($this->userModel->delete($id)) {
                session()->setFlashdata('success', 'User Berhasil di Delete');
                return redirect()->route('admin/users');
            } else {
                session()->setFlashdata('error', 'User gagal di Delete');
                return redirect()->back();
            }
        }

        if (isset($_POST['reset_password'])) {
            # tentukan password default
            $password = 'Laperbang@12345';
            //ambil data
            $data = [
                'password_hash' => Password::hash($password), //dari controller password mythauth
                'reset_hash' => null,
                'reset_at' => null,
                'reset_expires' => null,
            ];

            $this->userModel->update($id, $data); //update data
            session()->setFlashdata('success', "Password berhasil di reset ke - Laperbang@12345 -"); //swal
            return redirect()->back();
        }
    }

    ###### Data SetPramajelis lama ###########
    // public function setPramajelis()
    // {
    //     $pramajelisModel = new PramajelisModel();
    //     //buat rules
    //     $rules = [
    //         'no_perkara' => 'required',
    //         'nama_majelis' => 'required'
    //     ];
    //     //cek error
    //     if (! $this->validate($rules)) {
    //         session()->setFlashdata('error', $this->validator->getErrors());
    //         return redirect()->back()->withInput();
    //     }

    //     //ambil data
    //     $validation = service('validation');
    //     $validData = $validation->getValidated();
    //     //ambil data id_perkara
    //     $perkara = $this->modelPerkara->select('id_perkara')->where('no_perkara', $validData['no_perkara'])->first();
    //     $datapramajelis = [
    //         'id_perkara' => $perkara['id_perkara'],
    //         'nama_majelis' => $validData['nama_majelis']
    //     ];
    //     $datalsp = [
    //         'tgl_status' => date('Y-m-d'),
    //         'nomor' => $validData['no_perkara'],
    //         'status' => 'Penetapan Pramajelis'
    //     ];

    //     //insert ke table pramajelis
    //     $pramajelisModel->insert($datapramajelis);
    //     //insert ke table log status perkara
    //     $this->lspModel->insert($datalsp);
    //     //Pemberitahuan Whatsapp ke pihak

    //     //session alert
    //     session()->setFlashdata('success', 'Data Pramejelis Berhasil di pilih');
    //     //kembali tampilan
    //     return redirect()->back();
    // }
    ########### end Pramajelis Lama


    public function setPramajelis()
    {
        //form Validation Rules
        $rules = [
            'no_perkara' => 'required',
            'nama_majelis' => 'required'
        ];

        //cek error
        if (! $this->validate($rules)) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        //ambil data
        $validData = $this->validation->getValidated();
        //ambil data perkara di tb_perkara
        $perkara = $this->modelPerkara->select('id_perkara')->where('no_perkara', $validData['no_perkara'])->first();
        //ambil id Perkara
        $id_perkara = $perkara['id_perkara'];
        //data update
        $update_perkara = [
            'status' => 'Penetapan Pra Majelis',
            'majelis' => $validData['nama_majelis']
        ];
        //Update Data di Table Perkara
        $this->modelPerkara->update($id_perkara, $update_perkara);
        //Pemberitahuan Whatsapp
        //Pemberitahuan Swal
        session()->setFlashdata('success', 'Data Pramejelis Berhasil di pilih');
        //Return Back
        return redirect()->back();
    }

    public function setMajelisSidang()
    {
        //form Validation Rules
        $rules = [
            'no_perkara' => 'required',
            'nama_majelis' => 'required'
        ];

        //cek error
        if (! $this->validate($rules)) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        //ambil data
        $validData = $this->validation->getValidated();
        //ambil data perkara di tb_perkara
        $perkara = $this->modelPerkara->select('id_perkara')->where('no_perkara', $validData['no_perkara'])->first();
        //ambil id Perkara
        $id_perkara = $perkara['id_perkara'];
        //data update
        $update_perkara = [
            'status' => 'Penetapan Majelis',
            'majelis' => $validData['nama_majelis']
        ];
        //Update Data di Table Perkara
        $this->modelPerkara->update($id_perkara, $update_perkara);
        //Pemberitahuan Whatsapp
        //Pemberitahuan Swal
        session()->setFlashdata('success', 'Data Pramejelis Berhasil di pilih');
        //Return Back
        return redirect()->back();
    }

    public function setNoper()
    {
        $rules = [
            'no_perkara' => 'required',
            'nomor' => 'required|numeric',
            'tahun' => 'required|numeric'
        ];

        //cek error
        if (! $this->validate($rules)) {
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }
        //ambil data
        $validData = $this->validation->getValidated();
        //ambil data perkara di tb_perkara
        $perkara = $this->modelPerkara->getidByNomor($validData['no_perkara']);
        //ambil id Perkara
        $id_perkara = $perkara->id_perkara;
        $no_banding = $validData['nomor'] . '/Pdt.G/' . $validData['tahun'] . '/PTA.Mdo';
        //data update
        $update_perkara = [
            'no_banding' => $no_banding,
            'tgl_reg_banding' => date('Y-m-d H:i:s'),
            'status' => 'Pendaftaran Perkara Banding'
        ];
        //Update Data di Table Perkara
        $this->modelPerkara->update($id_perkara, $update_perkara);
        //Pemberitahuan Whatsapp
        //Pemberitahuan Swal
        session()->setFlashdata('success', 'Data Status Berhasil di Rubah');
        //Return Back
        return redirect()->back();
    }

    public function setPaniteraPengganti()
    {
        $rules = [
            'no_perkara' => 'required',
            'id_pp' => 'required|numeric'
        ];
        $validData = $this->validation->getValidated();
        //ambil data perkara di tb_perkara
        $perkara = $this->modelPerkara->getidByNomor($validData['no_perkara']);
        //ambil id Perkara
        $id_perkara = $perkara->id_perkara;
        //$data update
        $data_update = [
            'status' => 'Penunjukan Panitera Pengganti',
            'id_pp' => $validData['id_pp'],
        ];
        //Pemberitahuan Swal
        session()->setFlashdata('success', 'Data Status Berhasil di Rubah');
        //Return Back
        return redirect()->back();
    }
}
