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
$routes->get('/', function () {
    return redirect()->to(base_url('/admin'));
},  ['filter' => 'role:admin,petugas']);

$routes->get('/', 'User\Home::index');

// routes buku
$routes->get('/buku/(:any)', 'User\Buku::detail/$1');

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
    $routes->get('informasi', 'Admin\Admin::appConfig', ['filter' => 'permission:management-config-app']);
    $routes->post('informasi', 'Admin\Admin::appConfigSave', ['filter' => 'permission:management-config-app']);

    // menu petugas
    $routes->group('petugas', function ($routes) {
        $routes->get('/', 'Petugas::index');
        $routes->post('/', 'Petugas::simpan');
        $routes->put('(:any)', 'Petugas::edit/$1');
        $routes->delete('(:any)', 'Petugas::hapus/$1');
        $routes->get('(:any)/edit', 'Petugas::detailEdit/$1');
        $routes->get('(:any)', 'Petugas::detail/$1');
    });

    // menu anggota
    $routes->group('anggota', function ($routes) {
        $routes->get('/', 'Anggota::index');
        $routes->post('/', 'Anggota::simpan');
        $routes->put('reset/(:any)', 'Anggota::reset/$1');
        $routes->put('(:any)', 'Anggota::edit/$1');
        $routes->delete('(:any)', 'Anggota::hapus/$1');
        $routes->get('(:any)/edit', 'Anggota::detailEdit/$1');
        $routes->get('(:any)', 'Anggota::detail/$1');
    });

    // menu buku
    $routes->group('buku', ['namespace' => 'App\Controllers\Admin\MasterBuku'], function ($routes) {

        // menu data kategori
        $routes->group('kategori', function ($routes) {
            $routes->get('/', 'Kategori::index');
            $routes->post('/', 'Kategori::simpan');
            $routes->put('(:any)', 'Kategori::edit/$1');
            $routes->delete('(:any)', 'Kategori::hapus/$1');
        });
        // menu data pengarang
        $routes->group('pengarang', function ($routes) {
            $routes->get('/', 'Pengarang::index');
            $routes->post('/', 'Pengarang::simpan');
            $routes->put('(:any)', 'Pengarang::edit/$1');
            $routes->delete('(:any)', 'Pengarang::hapus/$1');
        });
        // menu data penerbit
        $routes->group('penerbit', function ($routes) {
            $routes->get('/', 'Penerbit::index');
            $routes->post('/', 'Penerbit::simpan');
            $routes->put('(:any)', 'Penerbit::edit/$1');
            $routes->delete('(:any)', 'Penerbit::hapus/$1');
        });
        // menu data penerbit
        $routes->group('rak', function ($routes) {
            $routes->get('/', 'Rak::index');
            $routes->post('/', 'Rak::simpan');
            $routes->put('(:any)', 'Rak::edit/$1');
            $routes->delete('(:any)', 'Rak::hapus/$1');
        });

        // menu data buku
        // $routes->get('/', 'Buku::index');
        // $routes->post('/', 'Buku::simpan');
        // $routes->put('(:any)', 'Buku::edit/$1');
        // $routes->delete('(:any)', 'Buku::hapus/$1');
        // $routes->get('(:any)/edit', 'Buku::detailEdit/$1');
        // $routes->get('(:any)', 'Buku::detail/$1');
    });

    // menu pinjam
    $routes->group('pinjam', function ($routes) {
        $routes->get('/', 'Pinjam::index');
        $routes->post('/', 'Pinjam::simpan');
        $routes->post('(:any)', 'Pinjam::tambahDetail/$1');

        $routes->put('perpanjang/(:any)', 'Pinjam::perpanjangWaktu/$1');
        $routes->put('(:any)', 'Pinjam::edit/$1');

        $routes->delete('(:any)/(:any)', 'Pinjam::hapusDetail/$1/$2');
        $routes->delete('(:any)', 'Pinjam::hapus/$1');

        $routes->get('(:any)/tambah', 'Pinjam::detailTambah/$1');
        $routes->get('(:any)/edit', 'Pinjam::detailEdit/$1');
        $routes->get('(:any)', 'Pinjam::detail/$1');
    });

    // menu pengembalian
    $routes->group('pengembalian', function ($routes) {
        $routes->get('/', 'Pengembalian::index');

        $routes->get('kembali/(:any)', 'Pengembalian::kembali/$1');
        $routes->post('kembali/(:any)', 'Pengembalian::aksiKembali/$1');

        $routes->delete('(:any)', 'Pengembalian::hapus/$1');

        $routes->get('(:any)/edit', 'Pengembalian::detailEdit/$1');
        $routes->get('(:any)', 'Pengembalian::detail/$1');
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
