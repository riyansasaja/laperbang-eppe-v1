<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Dashboard::index',  ['filter' => 'role:admin,superadmin']);
$routes->get('getstatus', 'ApilogStatus::find');
