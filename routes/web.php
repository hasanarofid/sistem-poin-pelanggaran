<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
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

// clear view
Route::get('/clear-view', function () {
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    Artisan::call('clear-compiled');
    return 'clear all cache config route';
});
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return 'View Cache cleared!';
});
Route::get('/clear-compiled', function () {
    Artisan::call('clear-compiled');
    return 'View Cache cleared!';
});
// call migrate
Route::get('/composer/autoload', function () {
    Artisan::call('shell:composer-dump-autoload');
    return 'Composer autoloader updated!';
});
Route::get('/migrate-fresh', 'MigrationController@migrateFresh');

Route::get('/seed', 'SeedController@seed');
Route::get('/umpan-balik/{generate}', 'UmpanbalikController@umpan');
Route::get('/umpan-balik-view/{generate}', 'UmpanbalikController@umpanview');
Route::post('/kirimumpanbalik', 'UmpanbalikController@saveumpan')->name('kirimumpanbalik');
Route::get('/tanggapan', 'UmpanbalikController@tanggapan')->name('tanggapan');
Route::get('/laporan/setkelas', 'LaporanController@setkelas')->name('laporan.setkelas');
Route::get('/laporan/setsiswa', 'LaporanController@setsiswa')->name('laporan.setsiswa');

Route::get('/', function () {
    return redirect('/login');
});


// route panel dashboard admin
Route::get('/', 'AdminController@index')->name('admin.index')->middleware(['auth', 'role.admin']);
Route::get('/dashboard', 'AdminController@index')->name('admin.index')->middleware(['auth', 'role.admin']);
Route::get('/chart-data', 'AdminController@chartData')->name('admin.chartData')->middleware(['auth', 'role.admin']);
Route::get('/chart-data2', 'AdminController@chartData2')->name('admin.chartData2')->middleware(['auth', 'role.admin']);
Route::get('/chartDataRaportPendidikan', 'AdminController@chartDataRaportPendidikan')->name('admin.chartDataRaportPendidikan')->middleware(['auth', 'role.admin']);
Route::get('/chartTerkonfirmasi', 'AdminController@chartTerkonfirmasi')->name('admin.chartTerkonfirmasi')->middleware(['auth', 'role.admin']);
Route::get('/chartpie', 'AdminController@chartpie')->name('admin.chartpie')->middleware(['auth', 'role.admin']);

Route::get('/spider-web-data', 'AdminController@getSpiderWebData')->name('admin.spiderWebData')->middleware(['auth', 'role.admin']);

// Routes untuk Admin
Route::prefix('admin')->middleware(['auth', 'role.admin'])->group(function () {

    Route::prefix('jenis-poin')->name('admin.jenis-poin.')->group(function () {
        Route::get('/', 'JenisPelanggaranController@index')->name('index');
        Route::post('/store', 'JenisPelanggaranController@store')->name('store');
        Route::put('/{id}/update', 'JenisPelanggaranController@update')->name('update');
        Route::delete('/{id}', 'JenisPelanggaranController@destroy')->name('destroy');
    });
    Route::prefix('kategori')->name('admin.kategori.')->group(function () {
        Route::get('/', 'KategoriController@index')->name('index');
        Route::post('/store', 'KategoriController@store')->name('store');
        Route::put('/{id}/update', 'KategoriController@update')->name('update');
        Route::delete('/{id}', 'KategoriController@destroy')->name('destroy');
    });
    Route::prefix('input-poin')->name('admin.input-poin.')->group(function () {
        Route::get('/', 'InputPelanggaranController@index')->name('index');
        Route::post('/store', 'InputPelanggaranController@store')->name('store');
        Route::delete('/{id}', 'InputPelanggaranController@destroy')->name('destroy');
        Route::get('/{id}/edit', 'InputPelanggaranController@edit')->name('edit');
        Route::put('/{id}/update', 'InputPelanggaranController@update')->name('update');
    });
    
    
    // route menu laporan untuk admin
    Route::prefix('laporan')->group(function () {
        Route::get('/', 'LaporanController@index')->name('admin.laporan.index');
        Route::get('/export/excel', 'LaporanController@export')->name('admin.laporan.export');
        Route::get('/export/excel-per-kelas', 'LaporanController@exportPerKelas')->name('admin.laporan.export-per-kelas');
        Route::get('/export/pdf', 'LaporanController@exportPDF')->name('admin.laporan.exportPDF');
    });

    // route menu siswa untuk admin (CRUD lengkap)
    Route::prefix('siswa')->group(function () {
        Route::get('/', 'AdminSiswaController@index')->name('admin.siswa.index');
        Route::get('/create', 'AdminSiswaController@create')->name('admin.siswa.create');
        Route::post('/', 'AdminSiswaController@store')->name('admin.siswa.store');
        Route::get('/{id}', 'AdminSiswaController@show')->name('admin.siswa.show');
        Route::get('/{id}/edit', 'AdminSiswaController@edit')->name('admin.siswa.edit');
        Route::put('/{id}', 'AdminSiswaController@update')->name('admin.siswa.update');
        Route::delete('/{id}', 'AdminSiswaController@destroy')->name('admin.siswa.destroy');
        Route::get('/export/excel', 'AdminSiswaController@export')->name('admin.siswa.export');
        Route::get('/import/form', 'AdminSiswaController@importForm')->name('admin.siswa.import.form');
        Route::post('/import', 'AdminSiswaController@import')->name('admin.siswa.import');
        Route::get('/template/download', 'AdminSiswaController@downloadTemplate')->name('admin.siswa.template.download');
        Route::post('/updatekelas', 'AdminSiswaController@updateKelas')->name('admin.siswa.updatekelas');
    });
});

// Routes untuk Guru
Route::prefix('guru')->middleware(['auth', 'role.guru'])->group(function () {
    Route::get('/dashboard', 'GuruController@dashboard')->name('guru.dashboard');
    Route::get('/input-poin', 'InputPelanggaranController@index')->name('guru.input-poin');
    Route::post('/input-poin/store', 'InputPelanggaranController@store')->name('guru.input-poin.store');
    Route::get('/laporan', 'LaporanController@index')->name('guru.laporan');
    Route::get('/export/excel', 'LaporanController@export')->name('guru.laporan.export');
    Route::get('/export/excel-per-kelas', 'LaporanController@exportPerKelas')->name('guru.laporan.export-per-kelas');
    Route::get('/export/pdf', 'LaporanController@exportPDF')->name('guru.laporan.exportPDF');

    // route menu siswa untuk guru (CRUD lengkap)
    Route::prefix('siswa')->group(function () {
        Route::get('/', 'GuruController@siswaIndex')->name('guru.siswa.index');
        Route::get('/create', 'GuruController@siswaCreate')->name('guru.siswa.create');
        Route::post('/', 'GuruController@siswaStore')->name('guru.siswa.store');
        Route::get('/{id}', 'GuruController@siswaShow')->name('guru.siswa.show');
        Route::get('/{id}/edit', 'GuruController@siswaEdit')->name('guru.siswa.edit');
        Route::put('/{id}', 'GuruController@siswaUpdate')->name('guru.siswa.update');
        Route::delete('/{id}', 'GuruController@siswaDestroy')->name('guru.siswa.destroy');
        Route::get('/export/excel', 'GuruController@siswaExport')->name('guru.siswa.export');
        Route::get('/import/form', 'GuruController@siswaImportForm')->name('guru.siswa.import.form');
        Route::post('/import', 'GuruController@siswaImport')->name('guru.siswa.import');
        Route::get('/template/download', 'GuruController@siswaDownloadTemplate')->name('guru.siswa.template.download');
        Route::post('/updatekelas', 'GuruController@updateKelas')->name('guru.siswa.updatekelas');
    });
});

// Routes untuk Siswa
Route::prefix('siswa')->middleware(['auth', 'role.siswa'])->group(function () {
    Route::get('/dashboard', 'SiswaController@dashboard')->name('siswa.dashboard');
    Route::get('/profile', 'SiswaController@profile')->name('siswa.profile');
    Route::post('/ubah-password/{id}', 'SiswaController@ubahPassword')->name('siswa.ubah-password');
});

Auth::routes();
Route::get('laporan/{filename}', function ($filename) {
    $path = storage_path('app/public/laporan/' . $filename);

    if (!File::exists($path)) {
        Log::error('Image file not found: ' . $path);
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->name('laporan');

Route::get('fotopengawas/{filename}', function ($filename) {
    $path = storage_path('app/public/pengawas/' . $filename);

    if (!File::exists($path)) {
        Log::error('Image file not found: ' . $path);
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->name('fotopengawas');

Route::get('favicon/{filename?}', function ($filename) {
    $path = storage_path('app/public/favicon/' . $filename);
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('favicon');


Route::get('umpanbalikfoto/{filename}', function ($filename) {
    $path = storage_path('app/public/umpanbalik/' . $filename);

    if (!File::exists($path)) {
        Log::error('Image file not found: ' . $path);
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->name('umpanbalikfoto');
