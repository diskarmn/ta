<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\OrderanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\BEController\EditPassword;
use App\Http\Controllers\BEController\Notifdinamis;
use App\Http\Controllers\BEController\Notification;
use App\Http\Controllers\BEController\ChartsProcess;
use App\Http\Controllers\BEController\JuraganProcess;
use App\Http\Controllers\BEController\OrderanProcess;
use App\Http\Controllers\BEController\CSDataPelanggan;
use App\Http\Controllers\BEController\EmployeeProcess;
use App\Http\Controllers\BEController\PelangganProcess;
use App\Http\Controllers\BEController\DataBarangProcess;
use App\Http\Controllers\BEController\AdminDataPelanggan;
use App\Http\Controllers\BEController\OtentikasiController;
use App\Http\Controllers\BEController\SuperAdminController;



use App\Http\Controllers\BEController\TulisOrderanController;
use App\Http\Controllers\AuthController as CustomerController;
use App\Http\Controllers\BEController\SuperAdminDataPelanggan;
use App\Http\Controllers\PelangganController as PelangganController;
use App\Http\Controllers\BEController\ProfileController as BEControllerProfileController;
use App\Http\Controllers\BEController\RequestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Auth

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
 });
 Route::post('register', [OtentikasiController::class, 'registerCustomer']);
//  Route::post('login', [CustomerController::class, 'login'])->name('login');



Route::prefix('cs')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        // Api routes untuk CS
        Route::post('logout', [CustomerController::class, 'logout'])->name('logout');
        // Route::get('email/verify/{id}', [CustomerController::class, 'verify'])->name('verification.verify');
        // Route::get('email/verify', [CustomerController::class, 'notice'])->name('verification.notice');



        // Pelanggan
        // Route::post('tambahData', [PelangganController::class, 'create']);
        Route::post('pelanggan/create', [PelangganController::class, 'create']);

        Route::put('pelanggan/store', [PelangganController::class, 'store']);
        Route::get('/pelanggan', [PelangganController::class, 'ApiIndex']);
        Route::post('/addPelangganData', [PelangganController::class, 'addPelangganData']);
        // Route::post('/cs/dataBarang', [BarangController::class, 'store']);
    });

    // Pelanggan
    // Route::post('tambahData', [PelangganController::class, 'create']);
    Route::post('pelanggan/create', [PelangganController::class, 'create']);


    // Pelanggan
    // Route::post('tambahData', [PelangganController::class, 'create']);
    Route::post('pelanggan/create', [PelangganController::class, 'create']);


    Route::put('pelanggan/store', [PelangganController::class, 'store']);
    Route::get('/pelanggan', [PelangganController::class, 'ApiIndex']);
    Route::post('/addPelangganData', [PelangganController::class, 'addPelangganData']);
    // Route::post('/cs/dataBarang', [BarangController::class, 'store']);
});

Route::post('/notif/edit/{id}', [Notification::class, 'editNotif'])->name('updateNotifSA');


// Pelanggan
// Route::post('tambahData', [PelangganController::class, 'create']);
Route::post('pelanggan/create', [PelangganController::class, 'create']);

Route::put('pelanggan/store', [PelangganController::class, 'store']);
Route::get('/pelanggan', [PelangganController::class, 'ApiIndex']);
Route::post('/addPelangganData', [PelangganController::class, 'addPelangganData']);
// Route::post('/cs/dataBarang', [BarangController::class, 'store']);

//SuperAdmin
Route::get("search/{barang}", [SuperAdminController::class, 'APIsearch']);
Route::post("create", [SuperAdminController::class, 'tambah_data_jasa_ekspedisi']);
Route::get("show/{id_ekspedisi}", [SuperAdminController::class, 'show_data_jasa_ekspedisi']);
Route::put("update/{id_ekspedisi}", [SuperAdminController::class, 'update_data_jasa_ekspedisi']);
Route::delete("delete/{id_ekspedoisi}", [SuperAdminController::class, 'delete_data_jasa_ekspedisi']);

Route::post('pelanggan/tambahPelanggan', [PelangganController::class, 'tambahPelanggan']);
Route::post('pelanggan/store', [PelangganController::class, 'store']);
Route::get('pelanggan/show/{id}', [PelangganController::class, 'show']);
Route::post('pelanggan/update/{id}', [PelangganController::class, 'update']);
Route::delete('pelanggan/delete/{id}', [PelangganController::class, 'delete']);

// cs
Route::get('cs/semua-orderan', [OrderanController::class, 'index'])->name('semua-orderanCS');
Route::get('cs/belum-proses-orderan', [OrderanController::class, 'belumproses'])->name('belum-proses-orderanCS');
Route::get('cs/semua-orderan/search', [OrderanController::class, 'search']);
Route::get('cs/charts', [ChartsProcess::class, 'getTotalPenjualan']);
Route::get('cs/charts/filterJuragan', [ChartsProcess::class, 'getOrderanByJuragan']);
Route::get('cs/charts/filterStatus', [ChartsProcess::class, 'getOrderanByStatus']);
Route::get('cs/charts/leaderboard', [ChartsProcess::class, 'leaderboard']);

Route::get('cs/profile', [BEControllerProfileController::class, 'index']);

Route::get('cs/profile/{id}', [BEControllerProfileController::class, 'show']);
Route::put('/cs/profile/edit-profile-process/{id}', [BEControllerProfileController::class, 'update']);
Route::post('cs/profile/edit-password/{email}', [EditPassword::class, 'update']);

Route::get('superadmin/notifications/{id?}', [Notification::class, 'index']);
Route::delete('superadmin/notifications/{notif}', [Notification::class, 'destroy']);

Route::get('cs/notifications/{id}', [Notification::class, 'index']);
Route::put('/cs/notifications/{id}/mark-as-read', [Notification::class,'markAsRead']);

Route::post('/notificationss', [Notification::class, 'addNotif']);

Route::post('/notifdinamis', [Notifdinamis::class, 'Notif_dinamis']);
Route::delete('/notifdinamis/{id}', [Notifdinamis::class, 'delete']);
Route::put('/notifdinamis/{id}/update-status', [Notifdinamis::class, 'update']);


Route::get('admin/notifications/{id?}', [Notification::class, 'index']);
Route::put('admin/notifications/{id}/mark-as-read', [Notification::class, 'markAsRead']);

// Data Barang
Route::get('cs/dataBarang', [BarangController::class, 'index']);
Route::post('cs/dataBarang/add', [DataBarangProcess::class, 'addBarang']);
Route::put('cs/dataBarang/update/{barang}', [DataBarangProcess::class, 'updateBarang'])->name('barangs.update');
Route::delete('cs/dataBarang/delete/{barang}', [DataBarangProcess::class, 'deleteBarang'])->name('barangs.destroy');

//Data pelanggan
Route::post('cs/create', [CSDataPelanggan::class, 'create']);
Route::post('cs/store', [CSDataPelanggan::class, 'store']);
Route::get('cs/show/{id}', [CSDataPelanggan::class, 'show']);
Route::post('cs/update/{id}', [CSDataPelanggan::class, 'update']);
Route::delete('cs/delete/{id}', [CSDataPelanggan::class, 'delete']);

//Orderan
// Route::get('cs/tulisOrderan', [TulisOrderanController::class, 'addOrderan']);
Route::post('cs/tulisOrderan', [OrderanProcess::class, 'addOrderan']);
Route::put('cs/tulisOrderan/update/{id}', [OrderanProcess::class, 'updateOrderan']);
Route::delete('orderan/delete/{orderNumber}', [OrderanProcess::class, 'deleteOrderan']);

Route::get('admin/data-cs', [EmployeeProcess::class, 'index']);
Route::post('admin/data-cs/add', [EmployeeProcess::class, 'addEmployee']);
Route::post('admin/data-cs/update/{id}', [EmployeeProcess::class, 'updateEmployee']);
Route::delete('admin/data-cs/delete/{id}', [EmployeeProcess::class, 'destroyEmployee']);
Route::post('/admin/ubah-password-cs/{id}', [EmployeeProcess::class, 'changePasswordEmployee']);

//Data Pelanggan
// Route::post('admin/create', [AdminDataPelanggan::class, 'create']);
// Route::post('admin/store', [AdminDataPelanggan::class, 'store']);
// Route::get('admin/show/{id}', [AdminDataPelanggan::class, 'show']);
// Route::post('admin/update/{id}', [AdminDataPelanggan::class, 'update']);
// Route::delete('admin/delete/{id}', [AdminDataPelanggan::class, 'delete']);

Route::get('superAdmin/dataAdmin', [EmployeeController::class, 'indexAdmin']);
Route::post('superAdmin/dataAdmin/add', [EmployeeProcess::class, 'addEmployee']);
Route::post('superAdmin/dataAdmin/update/{id}', [EmployeeProcess::class, 'updateEmployee']);
Route::delete('superAdmin/dataAdmin/delete/{id}', [EmployeeProcess::class, 'destroyEmployee']);
Route::post('superAdmin/dataAdmin/ubahPassword/{id}', [EmployeeProcess::class, 'changePasswordEmployee']);

Route::get('admin/charts', [ChartsProcess::class, 'indexChartsAdmin']);


Route::get('admin/charts', [ChartsProcess::class, 'indexChartsAdmin']);

//Data pelanggan
Route::post('superAdmin/store', [PelangganProcess::class, 'addPelanggan']);
// Route::get('superAdmin/show/{id}', [SuperAdminDataPelanggan::class, 'show']);
Route::put('superAdmin/update/{id}', [PelangganProcess::class, 'update']);
Route::delete('superAdmin/delete/{id}', [PelangganProcess::class, 'delete']);

Route::get('admin/charts', [ChartsProcess::class, 'indexChartsAdmin']);



//Juragan
Route::post('admin/data-juragan/add', [JuraganProcess::class, 'store']);


// Route::prefix('admin')->group(function () {
//     Route::middleware('auth:sanctum')->group(function () {
//      // Api routes untuk Admin
//      Route::post('logout', [AdminController::class, 'logout']);
//      // Route::get('email/verify/{id}', [AdminController::class, 'verify'])->name('verification.verify');
//      // Route::get('email/verify', [AdminController::class, 'notice'])->name('verification.notice');
//  });
//  });

// Route::post('/tambah-pesanan', [RequestController::class, 'tambahPesanan']);