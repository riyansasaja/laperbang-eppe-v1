<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Dashboard::index',  ['filter' => 'role:admin,user,verifikator,validator']);
$routes->get('getstatus', 'ApilogStatus::find');

$routes->group("verifikator", ['filter' => 'role:admin,verifikator'], function ($routes) {
    $routes->get('/', 'Verifikator::index');
});

$routes->group("validator", ['filter' => 'role:admin,validator'], function ($routes) {
    $routes->get('/', 'Validator::index');
    $routes->get('hasvalidate', 'Validator::hasvalidate');
    // $routes->get('checkfile/(:any)/(:any)', 'Validator::checkFile/$1/$2');
    $routes->post('checkfile', 'Validator::checkFile');
    $routes->post('validate', 'Validator::validateFile');
    $routes->post('cancel', 'Validator::revalid');
});

$routes->group("user", ['filter' => 'role:admin,user'], function ($routes) {
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
