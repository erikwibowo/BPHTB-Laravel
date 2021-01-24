<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\JenisTransaksiController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KeteranganController;
use App\Http\Controllers\KodeposController;
use App\Http\Controllers\PemberitahuanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PpatController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\RiwayatTransaksiController;
use App\Http\Controllers\TarifBangunanController;
use App\Http\Controllers\TarifTanahController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\WpController;
use App\Models\Desa;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login', function () {
    return view('admin/login', ['title' => "Login | " . config('variable.webname')]);
})->name('admin.login');
Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

//AMINISTRATOR
Route::group(['prefix' => 'admin',  'middleware' => 'adminauth'], function () {

    Route::get('/', function () {
        return view('admin/dashboard', ['title' => "Dashboard"]);
    })->name('admin.dashboard');

    //Admin
    Route::get('admin', [AdminController::class, 'index'])->name('admin.admin.index');
    Route::post('admin/create', [AdminController::class, 'create'])->name('admin.admin.create');
    Route::put('admin/update', [AdminController::class, 'update'])->name('admin.admin.update');
    Route::delete('admin/delete', [AdminController::class, 'delete'])->name('admin.admin.delete');
    Route::post('admin/data', [AdminController::class, 'data'])->name('admin.admin.data');

    //PPAT
    Route::get('ppat', [PpatController::class, 'index'])->name('admin.ppat.index');
    Route::post('ppat/create', [PpatController::class, 'create'])->name('admin.ppat.create');
    Route::put('ppat/update', [PpatController::class, 'update'])->name('admin.ppat.update');
    Route::delete('ppat/delete', [PpatController::class, 'delete'])->name('admin.ppat.delete');
    Route::post('ppat/data', [PpatController::class, 'data'])->name('admin.ppat.data');

    //WP
    Route::get('wp', [WpController::class, 'index'])->name('admin.wp.index');
    Route::post('wp/create', [WpController::class, 'create'])->name('admin.wp.create');
    Route::put('wp/update', [WpController::class, 'update'])->name('admin.wp.update');
    Route::delete('wp/delete', [WpController::class, 'delete'])->name('admin.wp.delete');
    Route::post('wp/data', [WpController::class, 'data'])->name('admin.wp.data');

    //TRANSAKSI
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi.index');
    Route::get('transaksi/didaftarkan', [TransaksiController::class, 'index'])->name('admin.transaksi.didaftarkan');
    Route::get('transaksi/difinalisasi', [TransaksiController::class, 'index'])->name('admin.transaksi.difinalisasi');
    Route::get('transaksi/diperiksa', [TransaksiController::class, 'index'])->name('admin.transaksi.diperiksa');
    Route::get('transaksi/ditolak', [TransaksiController::class, 'index'])->name('admin.transaksi.ditolak');
    Route::get('transaksi/diverifikasi', [TransaksiController::class, 'index'])->name('admin.transaksi.diverifikasi');
    Route::get('transaksi/selesai', [TransaksiController::class, 'index'])->name('admin.transaksi.selesai');
    Route::get('transaksi/kadaluarsa', [TransaksiController::class, 'index'])->name('admin.transaksi.kadaluarsa');
    Route::get('transaksi/dihapus', [TransaksiController::class, 'index'])->name('admin.transaksi.dihapus');

    
    Route::put('transaksi/delete', [TransaksiController::class, 'delete'])->name('admin.transaksi.delete');
    Route::put('transaksi/restore', [TransaksiController::class, 'restore'])->name('admin.transaksi.restore');
    Route::put('transaksi/ubah-status', [TransaksiController::class, 'ubah_status'])->name('admin.transaksi.ubahstatus');
    Route::put('transaksi/ubah-finalisasi', [TransaksiController::class, 'ubah_finalisasi'])->name('admin.transaksi.ubahfinalisasi');
    Route::post('transaksi/data-rinci-transaksi', [TransaksiController::class, 'data_rinci_transaksi'])->name('admin.transaksi.datarincitransaksi');

    //RIWAYAT TRANSAKSI
    Route::post('riwayat-transaksi/data-by-transaksi', [RiwayatTransaksiController::class, 'data_by_transaksi'])->name('admin.riwayattransaksi.databytransaksi');
    Route::post('riwayat-transaksi/create', [RiwayatTransaksiController::class, 'create'])->name('admin.riwayattransaksi.create');
    Route::post('riwayat-transaksi/update', [RiwayatTransaksiController::class, 'update'])->name('admin.riwayattransaksi.update');
    Route::post('riwayat-transaksi/delete', [RiwayatTransaksiController::class, 'delete'])->name('admin.riwayattransaksi.delete');

    //BILLING
    Route::get('billing', [BillingController::class, 'index'])->name('admin.billing.index');
    Route::get('billing/lunas', [BillingController::class, 'index'])->name('admin.billing.lunas');
    Route::get('billing/belum-lunas', [BillingController::class, 'index'])->name('admin.billing.belumlunas');
    Route::get('billing/kadaluarsa', [BillingController::class, 'index'])->name('admin.billing.kadaluarsa');

    //KETERANGAN
    Route::post('keterangan/data', [KeteranganController::class, 'data'])->name('admin.keterangan.data');
    Route::get('keterangan', [KeteranganController::class, 'index'])->name('admin.keterangan.index');
    Route::post('keterangan/create', [KeteranganController::class, 'create'])->name('admin.keterangan.create');
    Route::put('keterangan/update', [KeteranganController::class, 'update'])->name('admin.keterangan.update');
    Route::delete('keterangan/delete', [KeteranganController::class, 'delete'])->name('admin.keterangan.delete');
    Route::post('keterangan/dataid', [KeteranganController::class, 'data_id'])->name('admin.keterangan.dataid');

    //PEMBEITAHUAN
    Route::post('pemberitahuan/data', [PemberitahuanController::class, 'data'])->name('admin.pemberitahuan.data');
    Route::get('pemberitahuan', [PemberitahuanController::class, 'index'])->name('admin.pemberitahuan.index');
    Route::post('pemberitahuan/create', [PemberitahuanController::class, 'create'])->name('admin.pemberitahuan.create');
    Route::put('pemberitahuan/update', [PemberitahuanController::class, 'update'])->name('admin.pemberitahuan.update');
    Route::delete('pemberitahuan/delete', [PemberitahuanController::class, 'delete'])->name('admin.pemberitahuan.delete');

    //JENIS TRANSAKSI
    Route::get('jenis-transaksi', [JenisTransaksiController::class, 'index'])->name('admin.jenistransaksi.index');
    Route::post('jenis-transaksi/create', [JenisTransaksiController::class, 'create'])->name('admin.jenistransaksi.create');
    Route::put('jenis-transaksi/update', [JenisTransaksiController::class, 'update'])->name('admin.jenistransaksi.update');
    Route::delete('jenis-transaksi/delete', [JenisTransaksiController::class, 'delete'])->name('admin.jenistransaksi.delete');
    Route::post('jenis-transaksi/data', [JenisTransaksiController::class, 'data'])->name('admin.jenistransaksi.data');

    //WILAYAH ADMINISTRATIF
    Route::get('daerah-administratif/provinsi', [ProvinsiController::class, 'index'])->name('admin.provinsi.index');
    Route::get('daerah-administratif/kabupaten', [KabupatenController::class, 'index'])->name('admin.kabupaten.index');
    Route::get('daerah-administratif/kecamatan', [KecamatanController::class, 'index'])->name('admin.kecamatan.index');
    Route::get('daerah-administratif/desa', [DesaController::class, 'index'])->name('admin.desa.index');
    Route::get('daerah-administratif/kodepos', [KodeposController::class, 'index'])->name('admin.kodepos.index');

    //PENGATURAN
    Route::get('pengaturan', [PengaturanController::class, 'index'])->name('admin.pengaturan.index');
    Route::put('pengaturan/update', [PengaturanController::class, 'update'])->name('admin.pengaturan.update');

    //TARIF TANAH
    Route::get('tarif-tanah', [TarifTanahController::class, 'index'])->name('admin.tariftanah.index');
    Route::post('tarif-tanah/create', [TarifTanahController::class, 'create'])->name('admin.tariftanah.create');
    Route::put('tarif-tanah/update', [TarifTanahController::class, 'update'])->name('admin.tariftanah.update');
    Route::delete('tarif-tanah/delete', [TarifTanahController::class, 'delete'])->name('admin.tariftanah.delete');
    Route::post('tarif-tanah/data', [TarifTanahController::class, 'data'])->name('admin.tariftanah.data');

    //TARIF BANGUNAN
    Route::get('tarif-bangunan', [TarifBangunanController::class, 'index'])->name('admin.tarifbangunan.index');
    Route::post('tarif-bangunan/create', [TarifBangunanController::class, 'create'])->name('admin.tarifbangunan.create');
    Route::put('tarif-bangunan/update', [TarifBangunanController::class, 'update'])->name('admin.tarifbangunan.update');
    Route::delete('tarif-bangunan/delete', [TarifBangunanController::class, 'delete'])->name('admin.tarifbangunan.delete');
    Route::post('tarif-bangunan/data', [TarifBangunanController::class, 'data'])->name('admin.tarifbangunan.data');
});
