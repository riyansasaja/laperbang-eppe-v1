<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Verifikator extends BaseController
{
    public function index()
    {
        // 
        return view('verifikator/index');
    }
}
