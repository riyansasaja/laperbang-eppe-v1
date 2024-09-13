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
    $routes->get('addperkara', 'Banding::addperkara');
});
