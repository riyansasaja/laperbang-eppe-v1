<?php

function get_username_by_id($prapmh) {
    $userModel = new \App\Models\UserModel();
    $cek =  $userModel->select('fullname')->where('id', $prapmh)->first();
    return $cek->fullname;
}
