<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */



$routes->get('/', 'AdminController/Home::principal');
$routes->get('/admin/index', 'AdminController/Home::index');

//clientes
$routes->get('/admin/clientes', 'AdminController/ClienteController::clientes');

//marcas
$routes->get('/admin/marcas', 'AdminController/Home::marcas');
$routes->post('/admin/accion_marcas', 'AdminController/Home::accion_marcas');

//motivos
$routes->get('/admin/motivos', 'AdminController/MotivoController::motivos');
$routes->post('/admin/accion_motivos', 'AdminController/MotivoController::accion_motivos');

//sucursal
$routes->get('/admin/sucursales', 'AdminController/SucursalController::sucursales');
$routes->post('/admin/accion_sucursales', 'AdminController/SucursalController::accion_sucursales');
$routes->get('/admin/entidades', 'AdminController/SucursalController::entidades');


//usuarios
$routes->get('/admin/usuarios', 'AdminController/Home::usuarios');




/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
