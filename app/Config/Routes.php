<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::home');

// routes buku
$routes->get('/buku/(:any)', 'Buku::detail/$1');

// menu pinjam
$routes->group('/pinjam', ['filter' => 'role:anggota'], function ($routes) {
    $routes->get('/', 'Pinjam::index');
    $routes->post('/(:any)', 'Pinjam::simpan/$1');
    $routes->put('/(:any)', 'Pinjam::edit/$1');
    $routes->delete('/(:any)', 'Pinjam::hapus/$1');
    $routes->get('/(:any)', 'Pinjam::detail/$1');
});


// routes admin
$routes->group('/admin', ['filter' => 'role:admin'], function ($routes) {
    // dashboard
    $routes->get('/', 'Admin::index');

    // menu petugas
    $routes->get('petugas', 'Admin::dataPetugas');
    $routes->post('petugas', 'Petugas::simpan');
    $routes->put('petugas/(:any)', 'Petugas::edit/$1');
    $routes->delete('petugas/(:any)', 'Petugas::hapus/$1');
    $routes->get('petugas/(:any)', 'Petugas::detail/$1');
    
    // menu petugas
    $routes->get('anggota', 'Admin::dataAnggota');
    $routes->post('anggota', 'Anggota::simpan');
    $routes->put('anggota/reset/(:any)', 'Anggota::reset/$1');
    $routes->put('anggota/(:any)', 'Anggota::edit/$1');
    $routes->delete('anggota/(:any)', 'Anggota::hapus/$1');
    $routes->get('anggota/(:any)', 'Anggota::detail/$1');
    
    // menu buku
    $routes->get('buku', 'Admin::dataBuku');
    $routes->post('buku', 'Buku::simpan');
    $routes->put('buku/(:any)', 'Buku::edit/$1');
    $routes->delete('buku/(:any)', 'Buku::hapus/$1');
    $routes->get('buku/(:any)', 'Buku::detail/$1');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
