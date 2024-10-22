<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Dashboard::index',  ['filter' => 'role:admin,user,verifikator,validator']);
$routes->get('getstatus', 'ApilogStatus::find');

$routes->group("verifikator", ['filter' => 'role:verifikator'], function ($routes) {
    $routes->get('/', 'Verifikator::index');
    $routes->get('hasverified', 'Verifikator::hasverified');
    $routes->post('checkfile', 'Verifikator::checkFile');
    $routes->post('verified', 'Verifikator::verifiedFile');
    $routes->post('cancel', 'Verifikator::reverif');
});

$routes->group("validator", ['filter' => 'role:validator'], function ($routes) {
    $routes->get('/', 'Validator::index');
    $routes->get('hasvalidate', 'Validator::hasvalidate');
    // $routes->get('checkfile/(:any)/(:any)', 'Validator::checkFile/$1/$2');
    $routes->post('checkfile', 'Validator::checkFile');
    $routes->post('validate', 'Validator::validateFile');
    $routes->post('cancel', 'Validator::revalid');
});

$routes->group("user", ['filter' => 'role:user'], function ($routes) {
    $routes->get('banding', 'Banding::index');
    $routes->get('getbanding', 'Banding::getPerkarabanding');
    $routes->get('addbanding', 'Banding::addPerkarabanding');
    $routes->post('addbanding', 'Banding::addPerkarabanding');
    $routes->get('upload/(:num)', 'Banding::uploadBundel/$1');
    $routes->post('uploadb', 'Banding::uploadBundelB');
    $routes->get('delbundelb/(:any)/(:any)', 'Banding::delBundelB/$1/$2');
    $routes->post('uploada', 'Banding::uploadBundelA');
    $routes->get('delbundela/(:any)/(:any)', 'Banding::delBundelA/$1/$2');
});

$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('getAllDataBanding', 'Admin::getAllDataBanding');
    $routes->get('users', 'Admin::users');
    $routes->get('detiluser/(:num)', 'Admin::detilUser/$1');
    $routes->post('adduser', 'Admin::addUser');
    $routes->get('bandingdetil/(:any)', 'Admin::detilBanding/$1');
    $routes->get('majelis', 'Admin::majelisBanding');
    $routes->post('setmajelis', 'Admin::setMajelis');
    $routes->get('delmajelis/(:num)', 'Admin::delMajelis/$1');
    $routes->post('addroles', 'Admin::addRoles');
    $routes->get('delrole/(:num)/(:num)', 'Admin::delRole/$1/$2');
    $routes->post('edituser', 'Admin::editUser');
    $routes->post('setpramajelis', 'Admin::setPramajelis');
});
