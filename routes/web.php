<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'AuthController@index');
Route::post('/auth/login', 'AuthController@login');
Route::get('/auth/logout', 'AuthController@logout');
Route::get('/admin/', function ()
{
    return redirect('admin/dashboard');
});
//DASHBOARD
Route::resource('admin/dashboard', admin\DashboardController::class)->middleware('auth');
//SISWA
Route::get('admin/siswa/delete/{nis}', 'admin\SiswaController@destroy')->middleware('auth')->name('siswa.delete');
Route::get('admin/siswa/json_siswa', 'admin\SiswaController@json_siswa')->middleware('auth')->name('siswa.json');
Route::get('admin/siswa/json_siswa_by_id/{id_siswa}', 'admin\SiswaController@json_siswa_by_id')->middleware('auth')->name('siswa.json.edit');
Route::resource('admin/siswa', admin\SiswaController::class)->middleware('auth');
//BUKU
Route::get('admin/buku/delete/{id_buku}', 'admin\BukuController@destroy')->middleware('auth')->name('buku.delete');
Route::get('admin/buku/delete/{id_buku}', 'admin\BukuController@destroy')->middleware('auth')->name('buku.delete');
Route::get('admin/buku/json_buku', 'admin\BukuController@json_buku')->middleware('auth')->name('buku.json');
Route::resource('admin/buku', admin\BukuController::class)->middleware('auth');
//PEMINJAMAN
// Route::get('admin/buku/delete/{id_buku}', 'admin\BukuController@destroy')->middleware('auth')->name('buku.delete');
// Route::get('admin/buku/delete/{id_buku}', 'admin\BukuController@destroy')->middleware('auth')->name('buku.delete');
Route::get('admin/peminjaman/pinjam_json_buku/', 'admin\PeminjamanController@pinjam_json_buku')->middleware('auth')->name('pinjam.buku.json');
Route::resource('admin/peminjaman', admin\PeminjamanController::class)->middleware('auth');




