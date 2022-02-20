<?php

namespace Config;

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
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Front\HomeController');
$routes->get('home', 'Front\HomeController');
$routes->get('buku/(:alpha)/(:num)', 'Front\BukuController::index/$1/$2');
$routes->resource('buku', ['controller' => 'Front\BukuController', 'only' => ['index', 'show']]);
// Cart
$routes->resource('cart', ['controller' => 'Front\CartController']);
$routes->get('logout', 'Auth\LogoutController::index');
$routes->resource('login', ['controller' => 'Auth\LoginController', 'only' => ['index', 'create']]);
$routes->resource('registrasi', ['controller' => 'Auth\RegistrasiController', 'only' => ['index', 'create']]);

$routes->group('member', ['filter' => 'authFilter'], function ($routes) {
    $routes->resource('pemesanan', ['controller' => 'Front\Member\PemesananController']);
});

$routes->group('admin', ['filter' => 'authFilter'], function ($routes) {
    $routes->resource('dashboard', ['controller' => 'Admin\DashboardController', 'only' => 'index']);
    $routes->resource('buku', ['controller' => 'Admin\BukuController']);
    $routes->resource('kategori', ['controller' => 'Admin\KategoriController']);
    $routes->resource('penerbit', ['controller' => 'Admin\PenerbitController']);
    $routes->resource('user', ['controller' => 'Admin\UserController']);
    $routes->resource('pemesanan', ['controller' => 'Admin\PemesananController']);
    $routes->resource('laporan', ['controller' => 'Admin\LaporanController']);
    $routes->resource('status-pembayaran', ['controller' => 'Admin\StatusPembayaranController']);
});



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
