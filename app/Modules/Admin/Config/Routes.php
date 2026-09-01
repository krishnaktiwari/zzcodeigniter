<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

/*
 | --------------------------------------------------------------------------
 | Admin Module Routes
 | --------------------------------------------------------------------------
 |
 | Auto-discovered by CodeIgniter because App\Modules\Admin is registered in
 | app/Config/Autoload.php and 'routes' is an alias in app/Config/Modules.php.
 |
 | Add the auth filter to the group once login exists: ['filter' => 'auth'].
 */
$routes->group('admin', ['namespace' => 'App\Modules\Admin\Controllers'], static function (RouteCollection $routes): void {
    $routes->get('/', 'Dashboard::index');
});
