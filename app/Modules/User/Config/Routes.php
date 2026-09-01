<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

/*
 | --------------------------------------------------------------------------
 | User Module Routes
 | --------------------------------------------------------------------------
 |
 | Admin-side user management. Auto-discovered — see the Admin module's
 | Routes.php for how that works.
 */
$routes->group('admin/users', ['namespace' => 'App\Modules\User\Controllers'], static function (RouteCollection $routes): void {
    $routes->get('/', 'Users::index');
    $routes->get('new', 'Users::new');
    $routes->post('/', 'Users::create');
    $routes->get('(:num)/edit', 'Users::edit/$1');
    $routes->post('(:num)', 'Users::update/$1');
    $routes->post('(:num)/delete', 'Users::delete/$1');
});
