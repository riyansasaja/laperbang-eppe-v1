<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use App\Models\ModelPerkara;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;

class Dashboard extends BaseController
{

    use ResponseTrait;
    private $userModel;
    private $perkaraModel;
    private $loginModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->perkaraModel = new ModelPerkara();
        $this->loginModel = new LoginModel();
    }


    public function index()
    {
        //cek apakah dia roles user atau tidak
        if (array_search('user', user()->getRoles())) {
            # code...
            //ambildata total perkara
            $data['perkaraMasuk'] = $this->perkaraModel->where('id_user', user()->id)->countAllResults();
            $data['perkaraPutus'] = $this->perkaraModel->where('id_user', user()->id)->where('status', 'Pengiriman Salinan Putusan')->countAllResults();
            $data['totalLogin'] = $this->loginModel->where('user_id', user()->id)->where('success', 1)->countAllResults();

            return view('dashboard/dashboard', $data);
        } else {
            //ambil data total semua perkara
            $data['perkaraMasuk'] = $this->perkaraModel->where("DATE_FORMAT(created_at,'%Y')", 2025)->countAllResults();
            //ambil data perkara masuk yang statusnya sudah pengiriman salinan putusan
            $data['perkaraPutus'] = $this->perkaraModel->where("DATE_FORMAT(created_at,'%Y')", 2025)->where('status', 'Pengiriman Salinan Putusan')->countAllResults();
            //mengambil data total login per user
            $data['totalLogin'] = $this->loginModel->where('user_id', user()->id)->where('success', 1)->countAllResults();
            //kirim data ke view
            return view('dashboard/admindash', $data);
        }

        //
    }

    public function getRekapBulan()
    {
        $data = $this->perkaraModel->getRekapBulan(user()->id);
        return $this->respond($data);
    }

    public function getRekapBulanAll()
    {
        $data = $this->perkaraModel->getRekapBulanAll();
        return $this->respond($data);
    }
}
