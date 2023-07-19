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
$routes->get('buku/(:any)', 'User\Buku::detail/$1');

// fitur pinjam
$routes->group('pinjam', ['filter' => 'role:anggota'], function ($routes) {
    $routes->get('', 'User\Pinjam::index');
    $routes->post('(:any)', 'User\Pinjam::simpan/$1');
    $routes->put('(:any)', 'User\Pinjam::edit/$1');
    $routes->delete('(:any)', 'User\Pinjam::hapus/$1');
    $routes->get('(:any)', 'User\Pinjam::detail/$1');
});

// routes admin
$routes->group('admin', ['filter' => 'role:admin,petugas', 'namespace' => 'App\Controllers\Admin'], function ($routes) {
    // dashboard
    $routes->get('/', 'Admin::index');

    // konfigurasi
    $routes->get('informasi', 'Admin::appConfig', ['filter' => 'permission:management-config-app']);
    $routes->post('informasi', 'Admin::appConfigSave', ['filter' => 'permission:management-config-app']);

    // menu petugas
    $routes->get('petugas', 'Petugas::index');
    $routes->post('petugas', 'Petugas::simpan');
    $routes->put('petugas/(:any)', 'Petugas::edit/$1');
    $routes->delete('petugas/(:any)', 'Petugas::hapus/$1');
    $routes->get('petugas/(:any)/edit', 'Petugas::detailEdit/$1');
    $routes->get('petugas/(:any)', 'Petugas::detail/$1');

    // menu anggota
    $routes->get('anggota', 'Anggota::index');
    $routes->post('anggota', 'Anggota::simpan');
    $routes->put('anggota/reset/(:any)', 'Anggota::reset/$1');
    $routes->put('anggota/(:any)', 'Anggota::edit/$1');
    $routes->delete('anggota/(:any)', 'Anggota::hapus/$1');
    $routes->get('anggota/(:any)/edit', 'Anggota::detailEdit/$1');
    $routes->get('anggota/(:any)', 'Anggota::detail/$1');

    // menu pinjam
    $routes->get('pinjam', 'Pinjam::index');
    $routes->post('pinjam', 'Pinjam::simpan');
    $routes->put('pinjam/(:any)', 'Pinjam::edit/$1');
    $routes->delete('pinjam/(:any)', 'Pinjam::hapus/$1');

    $routes->post('pinjam/(:any)', 'Pinjam::tambahDetail/$1');
    $routes->delete('pinjam/(:any)/(:any)', 'Pinjam::hapusDetail/$1/$2');

    $routes->get('pinjam/(:any)/tambah', 'Pinjam::detailTambah/$1');
    $routes->get('pinjam/(:any)/edit', 'Pinjam::detailEdit/$1');
    $routes->get('pinjam/(:any)', 'Pinjam::detail/$1');


    // menu pengembalian
    $routes->get('pengembalian', 'Pengembalian::index');
    $routes->get('pengembalian/kembali/(:any)', 'Pengembalian::kembali/$1');
    $routes->post('pengembalian/kembali/(:any)', 'Pengembalian::aksiKembali/$1');
    $routes->delete('pengembalian/(:any)', 'Pengembalian::hapus/$1');
    $routes->get('pengembalian/(:any)/edit', 'Pengembalian::detailEdit/$1');
    $routes->get('pengembalian/(:any)', 'Pengembalian::detail/$1');


    // menu buku
    $routes->group('buku', ['filter' => 'role:admin,petugas', 'namespace' => 'App\Controllers\Admin\MasterBuku'], function ($routes) {

        // menu data kategori
        $routes->get('kategori', 'Kategori::index');
        $routes->post('kategori', 'Kategori::simpan');
        $routes->put('kategori/(:any)', 'Kategori::edit/$1');
        $routes->delete('kategori/(:any)', 'Kategori::hapus/$1');

        // menu data penulis
        $routes->get('penulis', 'Penulis::index');
        $routes->post('penulis', 'Penulis::simpan');
        $routes->put('penulis/(:any)', 'Penulis::edit/$1');
        $routes->delete('penulis/(:any)', 'Penulis::hapus/$1');

        // menu data penerbit
        $routes->get('penerbit', 'Penerbit::index');
        $routes->post('penerbit', 'Penerbit::simpan');
        $routes->put('penerbit/(:any)', 'Penerbit::edit/$1');
        $routes->delete('penerbit/(:any)', 'Penerbit::hapus/$1');

        // menu data rak
        $routes->get('rak', 'Rak::index');
        $routes->post('rak', 'Rak::simpan');
        $routes->put('rak/(:any)', 'Rak::edit/$1');
        $routes->delete('rak/(:any)', 'Rak::hapus/$1');

        // menu data buku
        $routes->get('/', 'Buku::index');
        $routes->post('/', 'Buku::simpan');
        $routes->put('(:any)', 'Buku::edit/$1');
        $routes->delete('(:any)', 'Buku::hapus/$1');
        $routes->get('(:any)/edit', 'Buku::detailEdit/$1');
        $routes->get('(:any)', 'Buku::detail/$1');
    });
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
