<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

/*
 | --------------------------------------------------------------------------
 | Shubh Routes
 | --------------------------------------------------------------------------
 |
 | Frontend routes. Loaded from app/Config/Routes.php.
 | Module routes live in app/Modules/<Module>/Config/Routes.php and are
 | auto-discovered — do not repeat them here.
 */
$routes->get('/', 'Home::index');
