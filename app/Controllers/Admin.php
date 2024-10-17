<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MajelisModel;
use App\Models\ModelBundelA;
use App\Models\ModelBundelB;
use App\Models\ModelPerkara;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Myth\Auth\Models\UserModel as ModelsUserModel;
use Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\GroupModel;

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
        $this->modelPerkara = new ModelPerkara();
        $this->modelBundelA = new ModelBundelA();
        $this->modelBundelB = new ModelBundelB();
        $this->authorize = service('authorization');
        $this->groupModel = new \Myth\Auth\Models\GroupModel();

        $this->session = service('session');

        $this->config = config('Auth');
        $this->auth   = service('authentication');
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
}
