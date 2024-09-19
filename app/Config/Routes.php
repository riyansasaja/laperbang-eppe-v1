<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Dashboard::index',  ['filter' => 'role:admin,user']);
$routes->get('getstatus', 'ApilogStatus::find');



$routes->group("user", ['filter' => 'role:admin,user'], function ($routes) {
    $routes->get('banding', 'Banding::index');
    $routes->get('getbanding', 'Banding::getPerkarabanding');
    $routes->get('addbanding', 'Banding::addPerkarabanding');
    $routes->post('addbanding', 'Banding::addPerkarabanding');
    $routes->get('upload/(:num)', 'Banding::uploadBundel/$1');
    $routes->post('uploadb', 'Banding::uploadBundelB');
    $routes->get('delbundelb/(:any)/(:any)', 'Banding::delBundelB/$1/$2');
});
