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
$routes->get('/', 'Index::index');

// routes buku
$routes->get('/buku/(:any)', 'User\Buku::detail/$1');

// fitur pinjam
$routes->group('/pinjam/', ['filter' => 'role:anggota'], function ($routes) {
    $routes->get('', 'User\Pinjam::index');
    $routes->post('(:any)', 'User\Pinjam::simpan/$1');
    $routes->put('(:any)', 'User\Pinjam::edit/$1');
    $routes->delete('(:any)', 'User\Pinjam::hapus/$1');
    $routes->get('(:any)', 'User\Pinjam::detail/$1');
});


// routes admin
$routes->group('/admin', ['filter' => 'role:admin'], function ($routes) {
    // dashboard
    $routes->get('/', 'Admin\Admin::index');
    
    // menu petugas
    $routes->get('petugas', 'Admin\Petugas::index');
    $routes->post('petugas', 'Admin\Petugas::simpan');
    $routes->put('petugas/(:any)', 'Admin\Petugas::edit/$1');
    $routes->delete('petugas/(:any)', 'Admin\Petugas::hapus/$1');
    $routes->get('petugas/(:any)', 'Admin\Petugas::detail/$1');
    
    // menu petugas
    $routes->get('anggota', 'Admin\Anggota::index');
    $routes->post('anggota', 'Admin\Anggota::simpan');
    $routes->put('anggota/reset/(:any)', 'Admin\Anggota::reset/$1');
    $routes->put('anggota/(:any)', 'Admin\Anggota::edit/$1');
    $routes->delete('anggota/(:any)', 'Admin\Anggota::hapus/$1');
    $routes->get('anggota/(:any)', 'Admin\Anggota::detail/$1');
    
    // menu buku
    $routes->get('buku', 'Admin\Buku::index');
    $routes->post('buku', 'Admin\Buku::simpan');
    $routes->put('buku/(:any)', 'Admin\Buku::edit/$1');
    $routes->delete('buku/(:any)', 'Admin\Buku::hapus/$1');
    $routes->get('buku/(:any)', 'Admin\Buku::detail/$1');

    // menu pinjam
    $routes->get('pinjam', 'Admin\Pinjam::index');
    $routes->post('pinjam', 'Admin\Pinjam::simpan');
    $routes->put('pinjam/(:any)', 'Admin\Pinjam::edit/$1');
    $routes->delete('pinjam/(:any)', 'Admin\Pinjam::hapus/$1');
    $routes->get('pinjam/(:any)', 'Admin\Pinjam::detail/$1');

    
});

// AJAX
$routes->get('/listbuku', 'User\Buku::listBuku');
$routes->get('/listbuku/ambil/(:any)', 'User\Buku::ambilBuku/$1');





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
