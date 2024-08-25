<?php

use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BEController\EkspedisiProcess;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\JuraganController;
use App\Http\Controllers\OrderanController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\BEController\JuraganProcess;
use App\Http\Controllers\BEController\RequestController;
use App\Http\Controllers\BEController\DataBarangProcess;
use App\Http\Controllers\BEController\OtentikasiController;
use App\Http\Controllers\BEController\OrderanProcess;
use App\Http\Controllers\BEController\SuperAdminController;
use App\Http\Controllers\KeranjangController;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ROUTE LOGIN LOGOUT

// Route::get('/coba', function () {
//         return view('coba', ["title" => "login"]);
//     })->name('coba');

//     Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/', function () {
        return view('login', ["title" => "utama"]);
    })->name('loginPage');
Route::get('/logout', [AuthController::class, 'logout'])->name('web.logout');



Route::post('/login', function (Request $request) {
    try {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('employee')->check()) {
            Auth::guard('employee')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }


        $user = Employee::where('email', $request->email)->first();

        if (Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('employee')->user();



            if (isset($request->remember) && !empty($request->remember)) {
                setcookie('email', $request->email, time() + 3600);
                setcookie('password', $request->password, time() + 3600);
            } else {
                setcookie('email', '', time() - 3600);
                setcookie('password', '', time() - 3600);
            }

            session(['user_id' => $user->id, 'user_role' => $user->role]);

            if ($user->role === 'admin') {
                return redirect()->route('utamaadmin');
            } elseif ($user->role === 'ceo') {
                return redirect()->route('chartsceo');
            } elseif ($user->role === 'cs') {
                return redirect()->route('semua-orderancs');
            }
        } else {
            return redirect()->route('loginPage')->with('error', 'Login gagal. Email atau password tidak valid');
        }
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return redirect()->route('loginPage')->with('error', 'Terjadi kesalahan pada server.');
    }
})->name('login');


Route::middleware(['auth:employee'])->group(function () {
    Route::middleware(['auth:employee', 'checkrole:ceo'])->prefix('ceo')->group(function () {
        Route::get('/charts', [ChartsController::class, 'index'])->name('chartsceo');
        Route::get('/charts/{juragan}', [ChartsController::class, 'juragancs']);
    });


    Route::middleware(['auth:employee', 'checkrole:cs'])->prefix('cs')->group(function () {
        Route::get('/search', [OrderanController::class, 'search'])->name('searchinA');

        Route::get('/semua-orderan', [OrderanController::class, 'indexa'])->name('semua-orderancs');
        Route::get('/belum-proses-orderan', [OrderanController::class, 'belumprosesA'])->name('belum-proses-orderana');
        Route::get('/menunggu-dicek-orderan', [OrderanController::class, 'menunggudicekA'])->name('menunggu-dicek-orderana');
        Route::get('/dalam-proses-orderan', [OrderanController::class, 'dalamprosesA'])->name('dalam-proses-orderana');
        Route::get('/orderan-selesai', [OrderanController::class, 'orderanselesaiA'])->name('orderan-selesaia');

        Route::delete('/deleteorder/{orderNumber}', [OrderanController::class, 'deleteorder'])->name('deleteordera');
        Route::post('/tambah-pembayaran/{orderNumber}', [OrderanController::class, 'tambahPembayaran'])->name('tambah-pembayarana');
        Route::post('/resi/{orderNumber}', [OrderanProcess::class, 'resisa'])->name('resia');
        Route::post('/update-on-process/{orderId}', [OrderanProcess::class, 'updateOnProcess'])->name('update.on.procesa');
        Route::post('/update-check-payment/{orderId}', [DashboardController::class, 'updateCheckPaymentsa'])
            ->name('update.check.paymenta');

        Route::get('/suntingOrderan/{orderNumber}', [OrderanController::class, 'suntinga'])->name('suntinga');
        Route::post('/belum-proses-orderan/ubah/{orderNumber}', [OrderanController::class, 'kesunting'])->name('kesuntinga');
        Route::post('/semua-orderan/{order_number}', [RequestController::class, 'suntingeditordersA'])->name('suntingeditordera');

        Route::get('/invoice/{orderNumber}', [OrderanController::class, 'cetakInvoiceAdmin'])
            ->name('admin.dashboard-invoice.invoice');


        Route::get('/tulisOrderan', [OrderanController::class, 'tulisOrder'])->name('tulisorder');
        Route::post('/tulisOrderan/viewtulisorder', [KeranjangController::class, 'viewtulisorder'])->name('viewtulisorder');
        Route::post('/tulisOrderan/addcs', [KeranjangController::class, 'addcs'])->name('addcs');
        Route::post('/tulisOrderan/keorders', [OrderanProcess::class, 'keorders'])->name('keorders');
        Route::delete('/tulisOrderan/bataltulis', [KeranjangController::class, 'bataltulis'])->name('batalsa');


        Route::post('/tulisOrderan/edittulisorder/{id}', [KeranjangController::class, 'edittulisorder'])->name('edittulisorder');
        Route::delete('/tulisOrderan/deleteorder/{id}', [KeranjangController::class, 'hapusorder'])->name('hapusordera');

        Route::post('/tulisOrderan/ongkir', [KeranjangController::class, 'ongkir'])->name('ongkir');
        Route::post('/tulisOrderan/editongkir/{id}', [KeranjangController::class, 'editongkir'])->name('editongkir');
        Route::delete('/tulisOrderan/deleteongkir/{id}', [KeranjangController::class, 'hapusongkir'])->name('hapusongkir');

        Route::post('/tulisOrderan/lain', [KeranjangController::class, 'lain'])->name('lain');
        Route::post('/tulisOrderan/editlain/{id}', [KeranjangController::class, 'editlain'])->name('editlain');
        Route::delete('/tulisOrderan/deletelain/{id}', [KeranjangController::class, 'hapuslain'])->name('hapuslain');


        Route::get('/dataBarang', [BarangController::class, 'indexAdmin'])->name('barang');
        Route::post('/dataBarang/store', [BarangController::class, 'addbarang'])->name('addbarang');
        Route::delete('/dataBarang/destroy/{id}', [BarangController::class, 'destroyA'])->name('deleteBarangA');
        Route::post('/dataBarang/update/{id}', [BarangController::class, 'updatebarang'])->name('update');
        Route::post('/dataBarang/stock/{id}', [BarangController::class, 'stock'])->name('stock');
        Route::delete('/dataBarang/destroy/{barang}', [BarangController::class, 'destroy'])->name('barangs.destroy');



        Route::get('/request', [RequestController::class, 'main'])->name('admin.request.main');
        Route::get('/request/{order_number}/detail/', [RequestController::class, 'showOrderDetail'])->name('admin.request.detail');

        Route::post('/requestEdit/{order_number}', [RequestController::class, 'edit'])->name('admin.requestEdit.kerequest');
        Route::post('/request/ditolak/{order_number}', [RequestController::class, 'ditolakA'])->name('admin.requestEdit.ditolak');

        Route::get('/request/requestEdit/{order_number}', [RequestController::class, 'viewrequestA'])->name('admin.requestEdit.view');

        Route::post('/request/keranjang', [RequestController::class, 'suntingtulisorder'])->name('suntingtulisorder');
        Route::post('/request/editkeranjang/{id}', [RequestController::class, 'editkeranjangrequest'])->name('keranjangrequestedita');
        Route::post('/request/ongkir', [RequestController::class, 'ongkirrequest'])->name('ongkirrequesta');
        Route::post('/request/lain', [RequestController::class, 'lainrequest'])->name('lainrequesta');
        Route::post('/request/{order_number}', [RequestController::class, 'editordersSA'])->name('editordersa');

        Route::get('/data-pelanggan', [PelangganController::class, 'indexForAdmin'])->name('dataPelangganAdmin');
        Route::get('/detail/{id}', [PelangganController::class, 'showDetailForAdmin'])->name('detailPelangganAdmin');
        Route::get('/detail/riwayat-transaksi/{id}', [PelangganController::class, 'showRiwayatTransaksiForAdmin'])->name('dataRiwayatTransaksiAdmin');
        Route::post('/data-pelanggan/tambah', [PelangganController::class, 'store'])->name('tambahPelangganAdmin');
        Route::put('/data-pelanggan/{id}/edit', [PelangganController::class, 'editPelangganForAdmin'])->name('editPelangganAdmin');
        Route::get('/invoice/{orderNumber}', [OrderanController::class, 'cetakInvoiceAdmin'])
            ->name('cs.data-pelanggan.invoice');
        Route::post('/add-points/{id}', [PelangganController::class, 'addPointsAdmin'])->name('add-pointsAdmin');
    });



    Route::middleware(['auth:employee', 'checkrole:admin'])->prefix('admin')->group(function () {
        Route::get('/utamaadmin', [OrderanController::class, 'utamaadmin'])->name('utamaadmin');

        Route::get('/profile', [ProfileController::class, 'profile'])->name('indexProfile');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('getEditProfilinSA');
        Route::put('/profile/update', [ProfileController::class, 'updateData'])->name('updateProfileSA');
        Route::get('/profile/ubah-password', [ProfileController::class, 'passwordView'])->name('tampilUbahPasSA');
        Route::put('/profile/ubah-password/', [ProfileController::class, 'updatePassword'])->name('ubahPasSA');
        Route::get('/notif', [NotifController::class, 'indexSuperadmin'])->name('indexNotif');
        Route::post('/notif/add', [NotifController::class, 'create'])->name('addNotifinSA');
        Route::put('/notif/edit/{id}', [NotifController::class, 'update'])->name('updateNotifSA');
        Route::delete('/notif/delete/{id}', [NotifController::class, 'destroy'])->name('deleteNotifSA');

        Route::get('/juragan', [JuraganController::class, 'indexSuperAdmin'])->name('dataJuragan');
        Route::put('/juragan/edit/{id}', [JuraganController::class, 'updateSuperAdmin'])->name('editJuraganSuperAdmin');
        Route::delete('/juragan/delete/{id}', [JuraganController::class, 'deleteJuragan'])->name('deleteJuragan');
        Route::get('/juragan/search', [JuraganController::class, 'search'])->name('searchJuraganSuperAdmin');
        Route::get('/juragan/getExistingIds', [JuraganController::class, 'getExistingIds'])->name('getExistingIds');

        Route::get('/juragan/add', [EmployeeController::class, 'viewaddjuragan'])->name('tambahjuraganview');
        Route::post('/juragan/add/tambah', [JuraganController::class, 'addjuragan'])->name('addjuragan');

        Route::get('/ceo', [EmployeeController::class, 'dataceo'])->name('dataceo');
        Route::get('/ceo/add', [EmployeeController::class, 'addceo'])->name('addceo');
        Route::post('/ceo/add', [EmployeeController::class, 'tambahceo'])->name('tambahceo');

        Route::get('/data-cs', [EmployeeController::class, 'indexSuperAdmin'])->name('datacs');
        Route::get('/data-cs/add', [EmployeeController::class, 'addCsSuperAdmin'])->name('pageTambahCSinSA');
        Route::post('/data-cs/add', [EmployeeController::class, 'createCssa'])->name('tambahCsSuperAdmin');
        Route::PUT('/data-cs/edit/{id}', [EmployeeController::class, 'editcs2'])->name('editcs2');
        Route::delete('/data-cs/delete/{id}', [EmployeeController::class, 'destroy'])->name('deleteDataCSSuperAdmin');
    });
});
