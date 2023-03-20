<?php

use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminSatuanController;
use App\Http\Controllers\AdminBarangController;
use App\Http\Controllers\AdminPassswordController;
use App\Http\Controllers\AdminBarangPedagangController;
use App\Http\Controllers\AdminProfilController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardPasswordController;
use App\Http\Controllers\DashboardBarangPedagangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangPedagangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Models\Profil;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Halaman beranda
Route::get('/', function () {
    return view('index', [
        "title" => "Beranda",
        "profiles" => Profil::all()
    ]);
});

// Halaman barang
Route::get('/home/catalogs', [BarangPedagangController::class, 'index']);

// Halaman detail barang
Route::get('/home/catalogs/{catalog:slug}', [BarangPedagangController::class, 'show']);

// Halaman profil
Route::get('/home/profiles', function () {
    return view('home/profiles/index', [
        "title" => "Profil",
        "profiles" => Profil::all(),
        "users" => User::all(),
        'image' => 'default.jpg',
        'foto' => 'default.png'
    ]);
});

// Halaman users
Route::get('/home/users/{user:id}', function (User $user) {
    return view('home/users/index', [
        "title" => "Toko",
        "profiles" => Profil::all(),
        "users" => $user,
        'image' => 'default.png',
    ]);
});


// Halaman contact
Route::get('/home/contacts', function () {
    return view('home/contacts/index', [
        "title" => "Kontak",
        "profiles" => Profil::all()
    ]);
});

// Halaman kategori
Route::get('/home/categories', [CategoryController::class, 'index']);

// Halaman login
Route::get('/home/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/home/login', [LoginController::class, 'authenticate']);

// Halaman registrasi
Route::get('/home/signup', [SignupController::class, 'index'])->name('signup')->middleware('guest');
Route::post('/home/signup', [SignupController::class, 'authenticate']);

// Halaman logout
Route::post('/home/logout', [LoginController::class, 'logout']);

// --------------------------------------------------------------------------------------------------

// Route untuk dashboard

// Halaman barang saya
Route::get('/dashboard/catalogs/checkSlug', [DashboardBarangPedagangController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/catalogs', DashboardBarangPedagangController::class)->middleware('auth');

// Halaman reset kata sandi
Route::get('/dashboard/passwords', [DashboardPasswordController::class, 'index'])->middleware('auth');
Route::post('/dashboard/passwords', [DashboardPasswordController::class, 'authenticate'])->name('change-password');
// --------------------------------------------------------------------------------------------------

// Route untuk admin
// Halaman kategori
Route::get('/dashboard/categories/checkSlug', [AdminKategoriController::class, 'checkSlug'])->middleware('admin');
Route::resource('/dashboard/categories', AdminKategoriController::class)->middleware('admin');

// Halaman satuan
Route::get('/dashboard/units/checkSlug', [AdminSatuanController::class, 'checkSlug'])->middleware('admin');
Route::resource('/dashboard/units', AdminSatuanController::class)->middleware('admin');

// Halaman profil
Route::resource('/dashboard/profiles', AdminProfilController::class)->middleware('admin');

// Halaman data toko
Route::resource('/dashboard/users', AdminUserController::class)->middleware('auth');
// Reset kata sandi
Route::put('/dashboard/users/reset/{user:id}', [AdminPassswordController::class, 'authenticate']);

// Halaman supplier
Route::get('/dashboard/suppliers/checkSlug', [AdminBarangController::class, 'checkSlug'])->middleware('admin');
Route::resource('/dashboard/suppliers', AdminBarangController::class)->middleware('admin');

// Halaman semua katalog
Route::get('/dashboard/allcatalogs', [AdminBarangPedagangController::class, 'index'])->middleware('admin');
Route::get('/dashboard/allcatalogs/show/{catalog:slug}', [AdminBarangPedagangController::class, 'show'])->middleware('admin');
Route::get('/dashboard/allcatalogs/destroy/{catalog:slug}', [AdminBarangPedagangController::class, 'destroy'])->middleware('admin');
