<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EkstraController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PublikController;
use App\Http\Controllers\SambutanController;
use App\Http\Controllers\SejarahController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublikController::class, 'beranda'])->name('beranda.publik');
Route::get('/sejarah', [PublikController::class, 'sejarah'])->name('sejarah.publik');
Route::get('/sambutan', [PublikController::class, 'sambutan'])->name('sambutan.publik');
Route::get('/pegawai', [PublikController::class, 'pegawai'])->name('pegawai.publik');
Route::get('/ekstra', [PublikController::class, 'ekstra'])->name('ekstra.publik');
Route::get('/galeri', [PublikController::class, 'galeri'])->name('galeri.publik');
Route::get('/artikel', [PublikController::class, 'artikel'])->name('artikel.publik');
Route::get('/artikel/detail/{id}', [ArtikelController::class, 'show'])->name('artikel.detail');
Route::get('/berita', [PublikController::class, 'berita'])->name('berita.publik');
Route::get('/berita/detail/{id}', [BeritaController::class, 'show'])->name('berita.detail');
Route::get('/kontak', [PublikController::class, 'kontak'])->name('kontak.publik');

// Rute Admin
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dash');
    Route::get('/admin/profil/edit', [AdminController::class, 'editProf'])->name('prof.edit');
    Route::post('/admin/profil/updateProfil', [AdminController::class, 'updateProf'])->name('prof.update');
    Route::get('/admin/profil/editSandi', [AdminController::class, 'editPass'])->name('prof.edit.pass');
    Route::post('/admin/profil/updateSandi', [AdminController::class, 'updatePass'])->name('prof.update.pass');

    Route::get('/admin/beranda', [BerandaController::class, 'index'])->name('beranda.data');
    Route::get('/admin/beranda/tambah', [BerandaController::class, 'create'])->name('beranda.tambah');
    Route::post('/admin/beranda/add', [BerandaController::class, 'store'])->name('beranda.store');
    Route::get('/admin/beranda/edit/{id}', [BerandaController::class, 'edit'])->name('beranda.edit');
    Route::post('/admin/beranda/update/{id}', [BerandaController::class, 'update'])->name('beranda.update');
    Route::get('/admin/beranda/hapus/{id}', [BerandaController::class, 'destroy'])->name('beranda.hapus');

    Route::get('/admin/sejarah', [SejarahController::class, 'index'])->name('sejarah.data');
    Route::post('/admin/sejarah/edit', [SejarahController::class, 'edit'])->name('sejarah.edit');
    Route::post('/admin/sejarah/update', [SejarahController::class, 'update'])->name('sejarah.update');

    Route::get('/admin/sambutan', [SambutanController::class, 'index'])->name('sambutan.data');
    Route::post('/admin/sambutan/edit', [SambutanController::class, 'edit'])->name('sambutan.edit');
    Route::post('/admin/sambutan/update', [SambutanController::class, 'update'])->name('sambutan.update');

    Route::get('/admin/pegawai', [PegawaiController::class, 'index'])->name('pegawai.data');
    Route::get('/admin/pegawai/tambah', [PegawaiController::class, 'create'])->name('pegawai.tambah');
    Route::post('/admin/pegawai/add', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('/admin/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::post('/admin/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::get('/admin/pegawai/hapus/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.hapus');

    Route::get('/admin/ekstra', [EkstraController::class, 'index'])->name('ekstra.data');
    Route::get('/admin/ekstra/tambah', [EkstraController::class, 'create'])->name('ekstra.tambah');
    Route::post('/admin/ekstra/add', [EkstraController::class, 'store'])->name('ekstra.store');
    Route::get('/admin/ekstra/edit/{id}', [EkstraController::class, 'edit'])->name('ekstra.edit');
    Route::post('/admin/ekstra/update/{id}', [EkstraController::class, 'update'])->name('ekstra.update');
    Route::get('/admin/ekstra/hapus/{id}', [EkstraController::class, 'destroy'])->name('ekstra.hapus');

    Route::get('/admin/galeri', [GaleriController::class, 'index'])->name('galeri.data');
    Route::get('/admin/galeri/tambah', [GaleriController::class, 'create'])->name('galeri.tambah');
    Route::post('/admin/galeri/add', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('/admin/galeri/edit/{id}', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::post('/admin/galeri/update/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::get('/admin/galeri/hapus/{id}', [GaleriController::class, 'destroy'])->name('galeri.hapus');

    Route::get('/admin/artikel', [ArtikelController::class, 'index'])->name('artikel.data');
    Route::get('/admin/artikel/tambah', [ArtikelController::class, 'create'])->name('artikel.tambah');
    Route::post('/admin/artikel/add', [ArtikelController::class, 'store'])->name('artikel.store');
    Route::get('/admin/artikel/edit/{id}', [ArtikelController::class, 'edit'])->name('artikel.edit');
    Route::post('/admin/artikel/update/{id}', [ArtikelController::class, 'update'])->name('artikel.update');
    Route::get('/admin/artikel/hapus/{id}', [ArtikelController::class, 'destroy'])->name('artikel.hapus');

    Route::get('/admin/berita', [BeritaController::class, 'index'])->name('berita.data');
    Route::get('/admin/berita/tambah', [BeritaController::class, 'create'])->name('berita.tambah');
    Route::post('/admin/berita/add', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/admin/berita/edit/{id}', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::post('/admin/berita/update/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::get('/admin/berita/hapus/{id}', [BeritaController::class, 'destroy'])->name('berita.hapus');

    Route::get('/admin/kontak', [KontakController::class, 'index'])->name('kontak.data');
    Route::post('/admin/kontak/edit', [KontakController::class, 'edit'])->name('kontak.edit');
    Route::post('/admin/kontak/update', [KontakController::class, 'update'])->name('kontak.update');

    Route::get('/admin/akun', [AkunController::class, 'index'])->name('akun.data');
    Route::get('/admin/akun/tambah', [AkunController::class, 'create'])->name('akun.tambah');
    Route::post('/admin/akun/add', [AkunController::class, 'store'])->name('akun.store');
    Route::get('/admin/akun/edit/{id}', [AkunController::class, 'edit'])->name('akun.edit');
    Route::post('/admin/akun/update/{id}', [AkunController::class, 'update'])->name('akun.update');
    Route::get('/admin/akun/hapus/{id}', [AkunController::class, 'destroy'])->name('akun.hapus');
    Route::get('/admin/akun/resetPass/{id}', [AkunController::class, 'resetPass'])->name('akun.resetpass');

});

require __DIR__.'/auth.php';
