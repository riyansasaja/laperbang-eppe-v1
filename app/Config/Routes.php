<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Dashboard::index',  ['filter' => 'role:admin,user,verifikator,validator,hakim,pp']);
$routes->get('/getrekapbulan', 'Dashboard::getRekapBulan',  ['filter' => 'role:admin,user,verifikator,validator,hakim,pp']);
$routes->get('/getrekapbulanall', 'Dashboard::getRekapBulanAll',  ['filter' => 'role:admin,user,verifikator,validator,hakim,pp']);
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


$routes->group('panitera',  ['filter' => 'role:pp'], function ($routes) {
    $routes->get('getbanding', 'Panitera::index');
});

$routes->group('hakim',  ['filter' => 'role:hakim'], function ($routes) {
    $routes->get('getbanding', 'Hakim::index');
    $routes->get('detilperkara/(:num)', 'Hakim::detilPerkara/$1');
});

$routes->group('pimpinan',  ['filter' => 'role:ketua,wakil ketua'], function ($routes) {
    $routes->get('/', 'Pimpinan::index');
    $routes->get('detilperkara/(:num)', 'Hakim::detilPerkara/$1');
});


$routes->group("user", ['filter' => 'role:user'], function ($routes) {
    $routes->get('banding', 'Banding::index');
    $routes->get('getbanding', 'Banding::getPerkarabanding');
    $routes->get('addbanding', 'Banding::addPerkarabanding');
    $routes->get('editbanding/(:num)', 'Banding::editPerkaraBanding/$1');
    $routes->post('editbanding/(:num)', 'Banding::editPerkaraBanding/$1');
    $routes->post('addbanding', 'Banding::addPerkarabanding');
    $routes->get('upload/(:num)', 'Banding::uploadBundel/$1');
    $routes->post('uploadb', 'Banding::uploadBundelB');
    $routes->get('delbundelb/(:any)/(:any)', 'Banding::delBundelB/$1/$2');
    $routes->post('uploada', 'Banding::uploadBundelA');
    $routes->get('delbundela/(:any)/(:any)', 'Banding::delBundelA/$1/$2');
    $routes->get('gettimecontrol/(:any)', 'Banding::getTimeControlbyId/$1');
    $routes->post('requnlock', 'Banding::requestUnlock');
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
    $routes->post('setnoper', 'Admin::setNoper');
    $routes->post('setmajelissidang', 'Admin::setMajelisSidang');
    $routes->post('setpp', 'Admin::setPaniteraPengganti');
    $routes->post('set_status', 'Admin::setStatusEtc');
    $routes->post('upload_putusan', 'Admin::uploadPutusan');
    $routes->post('unlockupload', 'Admin::unlockUpload');
});
