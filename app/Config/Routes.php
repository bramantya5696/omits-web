<?php

namespace Config;

use App\Controllers\Peserta;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Home::index');

// Admin
$routes->get('dashboard/admin', 'Dashboard::admin');
$routes->get('dashboard/listUser', 'Dashboard::listUser');
$routes->get('admin/editProfil/(:num)', 'Admin::editProfil/$1');
$routes->get('admin/delete/(:num)', 'Admin::deleteUser/$1');
$routes->get('admin/export', 'Admin::exportToExcel');
$routes->post('admin/saveProfil', 'Admin::saveProfil');

// Peserta
$routes->get('dashboard', 'Dashboard::index');
$routes->get('dashboard/edit', 'Dashboard::editProfil');
$routes->get('dashboard/ubahPassword', 'Dashboard::changePassword');
$routes->get('pembayaran', 'Dashboard::pembayaran');
$routes->get('pembayaran/bukti', 'Dashboard::buktiBayar');

$routes->post('peserta/editProfil', 'Peserta::editProfil');
$routes->post('peserta/pembayaran', 'Peserta::uploadPembayaran');
$routes->post('peserta/ubahPassword', 'Peserta::changePassword');

// Auth
$routes->get('login', 'Home::login');
$routes->get('logout', 'Auth::logout');
$routes->get('registration', 'Home::registration');
$routes->get('forgotpassword', 'Home::forgotPassword');
$routes->get('resetpassword', 'Home::resetPassword');

$routes->post('auth/login', 'Auth::login');
$routes->post('auth/register', 'Auth::register');
$routes->post('auth/forgotpassword', 'Auth::forgotPassword');
$routes->post('auth/resetpassword', 'Auth::resetPassword');

/*
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
