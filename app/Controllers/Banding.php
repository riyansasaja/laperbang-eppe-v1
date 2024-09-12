<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Banding extends BaseController
{
    public function index()
    {
        //
        return view('banding/index');
    }
}
