<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
        //cek apakah dia roles user atau tidak
        if (array_search('user', user()->getRoles())) {
            # code...
            return view('dashboard/dashboard');
        } else {
            return view('dashboard/admindash');
        }

        //
    }
}
