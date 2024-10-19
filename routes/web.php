<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StafController;
use App\Http\Controllers\ManajemenController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/laporan', function () {
    return view('pages.manajemen.pembelian.print');
});
Route::group(['middleware'=>['auth','checkRole:admin']], function(){
    Route::get('/admin/beranda',[AdminController::class,'beranda'])->name('berandaadmin');
    Route::get('/admin/persedianbarang', [AdminController::class,'indexPersediaan'])->name('persediaan');
    Route::get('/admin/barangmasuk',[AdminController::class,'indexBarangMasuk'])->name('barangmasukadmin');
    Route::get('/admin/barangkeluar',[AdminController::class,'indexBarangKeluar'])->name('barangkeluaradmin');
    Route::get('/admin/lokasibarang',[AdminController::class,'indexLokasiBarang'])->name('lokasiadmin');
    Route::get('/admin/filterlokasi',[AdminController::class, 'filterLokasi'])->name('filterlokasiadmin');

    Route::get('/admin/daftarbarang',[AdminController::class,'indexBarang'])->name('barangadmin');
    Route::get('/admin/tambahbarang',[AdminController::class,'createBarang'])->name('tambahbarangadmin');
    Route::post('/admin/simpanbarang',[AdminController::class,'storeBarang'])->name('simpanbarangadmin');
    Route::get('/admin/editbarang/{kodebrg}',[AdminController::class,'editBarang'])->name('editbarangadmin');
    Route::put('/admin/updatebarang/{kodebrg}', [AdminController::class, 'updateBarang'])->name('updatebarangadmin');
    Route::get('/admin/caribarang', [AdminController::class, 'searchBarang'])->name('caribarangadmin');
    Route::get('/admin/detailbarang/{kodebrg}', [AdminController::class, 'showBarang'])->name('detailbarangadmin');
    Route::get('/admin/hapusbarang/{kodebrg}',[AdminController::class,'destroyBarang'])->name('hapusbarangadmin');
    Route::get('/admin/filtebarang',[AdminController::class,'filterBarang'])->name('filterbarang');
    Route::get('/admin/cetakbarang',[AdminController::class, 'printBarang'])->name('printbarang');

    Route::get('/admin/penempatanbarang',[AdminController::class,'indexPenempatan'])->name('penempatanadmin');
    Route::get('/admin/tambahpenempatanbarang',[AdminController::class,'createPenempatan'])->name('tambahpenempatanadmin');
    Route::post('/admin/simpanpenempatanbarang',[AdminController::class,'storePenempatan'])->name('simpanpenempatanadmin');
    Route::get('/admin/hapuspenempatan/{kodepenempatan}',[AdminController::class,'destroyPenempatan'])->name('hapuspenempatanadmin');
    Route::get('/admin/editpenempatan/{kodepenempatan}',[AdminController::class,'editPenempatan'])->name('editpenempatanadmin');
    Route::put('/admin/updatepenempatan/{kodepenempatan}',[AdminController::class,'updatePenempatan'])->name('updatepenempatanadmin');
    Route::get('/admin/detailpenempatan/{kodepenempatan}',[AdminController::class,'showPenempatan'])->name('detailpenempatanadmin');
    Route::get('/admin/filterpenempatan',[AdminController::class, 'filterPenempatan'])->name('filterpenempatan');
    Route::get('/admin/cetakpenempatan',[AdminController::class, 'printPenempatan'])->name('printpenempatan');

    Route::get('admin/barangrusak',[AdminController::class, 'indexBarangRusak'])->name('barangrusakadmin');
    Route::get('/admin/detailbarangrusak/{kodelaporan}',[AdminController::class, 'showBarangRusak'])->name('detailbarangrusakadmin');
    Route::get('/admin/konfirmasibarangrusak/{kodelaporan}',[AdminController::class, 'confirmBarangRusak'])->name('konfirmbarangrusakadmin');
    Route::put('/admin/updatekonfirmasibarangrusak/{kodelaporan}',[AdminController::class, 'updateConfirmBarangRusak'])->name('updatekonfirmbarangrusakadmin');
    Route::get('/admin/tambahbarangrusak',[AdminController::class, 'createBarangRusak']);
    Route::post('/admin/simpanbarangrusak',[AdminController::class,'storeBarangRusak']);
    Route::get('/admin/filterbarangrusak',[AdminController::class,'filterBarangRusak'])->name('filterbarangrusak');
    Route::get('/admin/cetakbarangrusak',[AdminController::class, 'printBarangRusak'])->name('printbarangrusak');

    Route::get('/admin/perbaikanbarang',[AdminController::class, 'indexPerbaikanBarang'])->name('perbaikanbarangadmin');
    Route::get('/admin/tambahperbaikanbarang',[AdminController::class,'createPerbaikanBarang']);
    Route::post('/admin/simpanperbaikanbarang',[AdminController::class,'storePerbaikanBarang']);
    Route::get('/admin/editperbaikan/{kodeperbaikan}',[AdminController::class,'editPerbaikanBarang']);
    Route::put('/admin/updateperbaikan/{kodeperbaikan}',[AdminController::class, 'updatePerbaikanBarang']);
    Route::get('/admin/konfirmperbaikan/{kodeperbaikan}',[AdminController::class,'confrimPerbaikanBarang']);
    Route::put('/admin/updatekonfirmasiperbaikan/{kodeperbaikan}',[AdminController::class,'updateConfirmPerbaikanBarang']);
    Route::get('/admin/detailperbaikan/{kodeperbaikan}',[AdminController::class,'showPerbaikanBarang']);
    Route::get('/admin/filterperbaikan',[AdminController::class, 'filterPerbaikan'])->name('filterperbaikan');
    Route::get('/admin/cetakperbaikan',[AdminController::class, 'printPerbaikan'])->name('printperbaikan');

    Route::get('/admin/peminjamanbarang',[AdminController::class, 'indexPeminjamanBarang'])->name('peminjamanadmin');
    Route::get('/admin/konfirmasipeminjaman/{kodepeminjaman}',[AdminController::class, 'confirmPeminjamanBarang']);
    Route::put('/admin/updatekonfirmasipeminjaman/{kodepeminjaman}',[AdminController::class, 'updateConfirmPeminjamanBarang']);
    Route::get('/admin/detailpeminjaman/{kodepeminjaman}',[AdminController::class, 'showPeminjamanBarang']);
    Route::get('/admin/filterpeminjaman',[AdminController::class,'filterPeminjaman'])->name('filterpeminjaman');
    Route::get('/admin/cetakpeminjaman',[AdminController::class, 'printPeminjaman'])->name('printpeminjaman');

    Route::get('/admin/pengembalianbarang',[AdminController::class, 'indexPengembalianBarang'])->name('pengembalianadmin');
    Route::get('/admin/filterpengembalian',[AdminController::class, 'filterPengembalian'])->name('filterpengembalian');
    Route::get('/admin/cetakpengembalan',[AdminController::class, 'printPengembalian'])->name('printpengembalian');

    Route::get('/admin/permintaanbarang',[AdminController::class, 'indexPermintaanBarang'])->name('permintaanadmin');
    Route::get('/admin/filterpermintaan',[AdminController::class, 'filterPermintaan'])->name('filterpemintaan');
    Route::get('/admin/cetakpermintaan',[AdminController::class, 'printPermintaan'])->name('printpermintaan');

    Route::get('/admin/pembelianbarang',[AdminController::class,'indexPembelianBarang'])->name('pembelianadmin');
    Route::get('/admin/tambahpembelian',[AdminController::class,'createPembelianBarang']);
    Route::post('/admin/simpanpembelian',[AdminController::class,'storePembelianBarang']);
    Route::get('/admin/pembelianbarang/{kodepembelian}',[AdminController::CLASS, 'editPembelianBarang']);
    Route::put('/admin/updatepembelian/{kodepembelian}',[AdminController::class, 'updatePembelian']);
    Route::get('/admin/konfirmpembelian/{kodepembelian}',[AdminController::class,'confrimPembelianBarang']);
    Route::put('/admin/updatekonfirmpembelian/{kodepembelian}', [AdminController::class, 'updateConfirmPembelianBarang']);
    Route::get('/admin/detailpembelian/{kodepembelian}', [AdminController::class, 'showPembelianBarang']);
    Route::get('/admin/hapuspembelian/{kodepembelian}', [AdminController::class, 'destroyPembelianBarang']);
    Route::get('/admin/filterpembelian',[AdminController::class,'filterReportPembelian'])->name('filterpembelianadmin');
    Route::get('/admin/cetakpembelian',[AdminController::class, 'printPembelian'])->name('printpembelian');


    Route::get('admin/pergantianbarang', [AdminController::class, 'indexPergantianBarang'])->name('pergantianadmin');
    Route::get('/admin/tambahpergantian', [AdminController::class, 'createPergantianBarang']);
    Route::post('/admin/simpanpergantian', [AdminController::class, 'storePergantian']);
    Route::get('/admin/editpergantian/{kodepergantian}', [AdminController::class, 'editPergantian']);
    Route::put('/admin/updatepergantian/{kodepergantian}', [AdminController::class, 'updatePergantian']);
    Route::get('/admin/detailpergantian/{kodepergantian}',[AdminController::class, 'showPergantian']);
    Route::get('/admin/hapuspergantian/{kodepergantian}', [AdminController::class, 'destroyPergantian']);
    Route::get('/admin/filterpergantian',[AdminController::class, 'filterPergantian'])->name('filterpergantian');
    Route::get('/admin/cetakpergantian',[AdminController::class, 'printPergantian'])->name('printpergantian');


    Route::get('/admin/penghapusan',[AdminController::class,'indexBarangTerbuang'])->name('barangterbuangadmin');
    Route::get('/admin/tambahenghapusan',[AdminController::class,'createBarangTerbuang']);
    Route::post('/admin/simpanpenghapusan',[AdminController::class,'storeBarangTerbuang']);
    Route::get('/admin/editpenghapusan/{kodehapus}',[AdminController::class,'editBarangTerbuang']);
    Route::put('/admin/updatepenghapusan/{kodehapus}',[AdminController::class, 'updateBarangTerbuang']);
    Route::get('/admin/hapuspenghapusan/{kodehapus}',[AdminController::class,'destroyBarangTerbuang']);
    Route::get('/admin/detailpenghapusan/{kodehapus}',[AdminController::class,'shoewBarangTerbuang']);
    Route::get('/admin/filterpenghapusan',[AdminController::class, 'filterBarangTerbuang'])->name('filterbarangterbuang');
    Route::get('/admin/cetakpenghapusan',[AdminController::class, 'printBarangTerbuang'])->name('printbarangterbuang');
});

Route::group(['middleware'=>['auth','checkRole:pengguna']], function(){
    Route::get('/user/barang',[UserController::class,'indexBarang'])->name('baranguser');
    Route::get('/user/detailbarang/{kodebrg}',[UserController::class,'showBarang']);

    Route::get('/user/barangrusak',[UserController::class,'indexBarangRusak'])->name('barangrusakguser');
    Route::get('/user/tambahbarangrusak',[UserController::class,'createBarangRusak']);
    Route::post('/user/simpanbarangrusak',[UserController::class,'storeBarangRusak']);
    Route::get('/user/editbarangrusak/{kodelaporan}',[UserController::class,'editBarangRusak']);
    Route::put('/user/updatebarangrusak/{kodelaporan}',[UserController::class,'updateBarangRusak']);
    Route::get('/user/detailbarangrusak/{kodelaporan}',[UserController::class,'showBarangRusak']);
    Route::get('/user/hapusbarangrusak/{kodelaporan}',[UserController::class,'destroyBarangRusak']);
    Route::get('/user/caribarangrusak',[UserController::class, 'searchBarangRusak']);

    Route::get('/user/penempatanbarang',[UserController::class, 'indexPenempatan'])->name('penempatanuser');
    Route::get('/user/konfirmasipenempatan/{kodepenempatan}',[UserController::class, 'updateConfirmPenempatan']);

    Route::get('/user/peminjamanbarang',[UserController::class, 'indexPeminjamanBarang'])->name('pinjambaranguser');
    Route::get('/user/tambahpeminjaman',[UserController::class, 'createPeminjamanBarang']);
    Route::get('/user/hapuspeminjaman/{kodepeminjaman}',[UserController::class, 'destroyPeminjaman']);
    Route::get('/user/editpeminjaman/{kodepeminjaman}', [UserController::class, 'editPeminjaman']);
    Route::put('/user/updatepeminjaman/{kodepeminjaman}',[UserController::class, 'updatePeminjaman']);
    Route::get('/user/detailpeminjaman/{kodepeminjaman}',[UserController::class, 'showPeminjaman']);
    Route::post('/user/simpanpeminjamanbarang',[UserController::class, 'storePeminjamanBarang']);
    Route::get('/user/konfirmpeminjaman/{kodepeminjaman}',[UserController::class,'updateConfirmPeminjaman']);
    Route::get('/user/caripeminjaman',[UserController::class,'searchPeminjaman']);

    Route::get('/user/pengembalianbarang',[UserController::class, 'indexPengembalianBarang'])->name('pengembalianuser');
    Route::get('/user/caripengembalian',[UserController::class, 'searchPengembalian']);

    Route::get('/user/permintaanbarang', [UserController::class, 'indexPermintaanBarang'])->name('permintaanuser');
    Route::get('/user/tambahpermintaanbarang', [UserController::class, 'createPermintaanBarang']);
    Route::post('/user/simpanpermintaan', [UserController::class, 'storePermintaanBarang']);
    Route::get('/user/konfirmasipermintaan/{kodepermintaan}', [UserController::class, 'confirmPermintaanBarang']);
    Route::get('/user/editpermintaan/{kodepermintaan}',[UserController::class, 'editPermintaan']);
    Route::put('/user/updatepermintaan/{kodepermintaan}',[UserController::class, 'updatePermintaan']);
    Route::get('/user/hapuspermintaan/{kodepermintaan}',[UserController::class, 'destroyPermintaan']);
    Route::get('/user/detailpermintaan/{kodepermintaan}',[UserController::class, 'showPermintaan']);
    Route::get('/user/caripermintaan',[UserController::class, 'searchPermintaan']);

    Route::get('user/pergantianbarang',[UserController::class, 'indexPergantianBarang'])->name('pergantianuser');
    Route::get('/user/caripergantian',[UserController::class, 'searchPergantian']);
    Route::get('/user/konfirmasipergantian/{kodepergantian}', [UserController::class, 'updateConfirmPergantian']);
});
    Route::group(['middleware'=>['auth','checkRole:staf']], function(){
    Route::get('/staf/barangrusak',[StafController::class,'indexBarangRusak'])->name('barangrusakstaf');
    Route::get('/staf/detailbarangrusak/{kodelaporan}',[StafController::class,'showBarangRusak'])->name('detailbarangrusakstaf');
    Route::get('/staf/konfirmasibarangrusak/{kodelaporan}',[StafController::class, 'confirmBarangRusak'])->name('konfirmbarangrusakstaf');
    Route::put('/staf/updatekonfirmasibarangrusak/{kodelaporan}',[StafController::class, 'updateConfirmBarangRusak'])->name('updatekonfirmbarangrusakstaf');
    Route::get('/staf/caribarangrusak',[StafController::class,'searchBarangRusak']);

    Route::get('/staf/penempatanbarang',[StafController::class,'indexPenempatan'])->name('penempatanstaff');
    Route::get('/staf/konfirmasipenempatan/{kodepenempatan}',[StafController::class,'updateConfirmPenempatan']);
    Route::get('staf/caripenempatan',[StafController::class, 'searchPenempatan']);

    Route::get('/staf/peminjamanbarang',[StafController::class, 'indexPeminjamanBarang'])->name('peminjamanbarangstaf');
    Route::get('/staf/konfirmasipeminjamanbarang/{kodepeminjaman}',[StafController::class, 'confirmPeminjaman'])->name('konfirmpeminjamanbarangstaf');
    Route::put('/staf/updatekonfirmasipeminjaman/{kodepeminjaman}',[StafController::class, 'updateConfirmPeminjamanBarang'])->name('updatekonfrimpeminjamanbarangstaf');
    Route::get('/staf/caripeminjaman',[StafController::class, 'searchPeminjaman']);


    Route::get('/staf/pengembalianbarang',[StafController::class, 'indexPengembalianBarang'])->name('pengembalianstaf');
    Route::get('/staf/konfirmpengembalian/{kodepeminjaman}',[StafController::class, 'updateConfirmPengembalianBarang']);
    Route::get('/staf/caripengembalian',[StafController::class, 'searchPengembalian']);

    Route::get('/staf/permintaanbarang',[StafController::class, 'indexPermintaanBarang'])->name('permintaanstaf');
    Route::get('/staf/konfirmasipermintaan/{kodepermintaan}',[StafController::class, 'confrimPermintaanBarang']);
    Route::put('/staf/updatekonfirmasipermintaan/{kodelaporan}',[StafController::class, 'updateConfirmPermintaanBarang']);
    Route::get('/staf/caripermintaan',[StafController::class, 'searchPermintaan']);


    Route::get('/staf/pergantianbarang',[StafController::class, 'indexPergantianBarang'])->name('pergantianstaf');
    Route::get('/staf/konfirmpergantian/{kodepergantian}', [StafController::class,'updateConfirmPergantian']);
    Route::get('/staf/caripergantian', [StafController::class, 'searchPergantian']);

});

    Route::group(['middleware'=>['auth','checkRole:manajemen']], function(){
    Route::get('/manajemen/beranda',[ManajemenController::class, 'beranda'])->name('berandamanajemen');
    Route::get('/manajemen/persedianbarang',[ManajemenController::class,'indexPersediaan']);
    Route::get('/manajemen/barangmasuk',[ManajemenController::class,'indexBarangMasuk'])->name('barangmasukmanajemen');
    Route::get('/manajemen/barangkeluar',[ManajemenController::class,'indexBarangKeluar'])->name('barangkeluarmanajemen');
    Route::get('/manajemen/lokasibarang',[ManajemenController::class,'indexLokasiBarang'])->name('lokasimanajemen');
    Route::get('/manajemen/filter-penempatan',[ManajemenController::class, 'filterLokasi'])->name('filtermanajemen');

    Route::get('/manajemen/barang',[ManajemenController::class, 'indexBarang'])->name('barangmanajemen');

    Route::get('/manajemen/permintaanbarang',[ManajemenController::class, 'indexPermintaanBarang'])->name('permintaanmanajemen');
    Route::get('/manajemen/konfirmasipermintaan/{kodepermintaan}',[ManajemenController::class, 'confirmPermintaanBarang']);
    Route::put('/manajemen/updatekonfirmasipermintaan/{kodepermintaan}',[ManajemenController::class, 'updateConfirmPermintaanBarang']);
    Route::get('/manajemen/permintaanbeli/{kodepermintaan}',[ManajemenController::class, 'updatePermintaanBeli']);
    Route::get('/manajemen/pembelianbarang',[ManajemenController::class, 'indexPembelianBarang'])->name('pembelianmanajemen');

    Route::get('//manajemen/konfirmpembelian/{kodepembelian}',[ManajemenController::class, 'confirmPembelianBarang']);
    Route::put('/manajemen/updatekonfirmpembelian/{kodepembelian}',[ManajemenController::class, 'updateConfirmPembelianBarang']);
    Route::get('/manajemen/detailpembelian/{kodepembelian}',[ManajemenController::class, 'showPembelianBarang']);
    Route::get('/manajemen/cetakpembelian',[ManajemenController::class, 'printPembelian'])->name('printpembelianmanajemen');
    Route::get('/manajemen/laporanpembelian',[ManajemenController::class, 'indexLaporanPembelian'])->name('laporanpembelian');
    Route::get('/manajemen/filterlaporanpembelian',[ManajemenController::class,'filterReportPembelian'])->name('filterreportpembelian');

    Route::get('/manajemen/laporanpergantian',[ManajemenController::class,'indexPergantianBarang'])->name('reportpergantianmanajemen');
    Route::get('/manajemen/detailpergantian/{kodepergantin}',[ManajemenController::class,'showPergantian']);
    Route::get('/manajemen/cetakpergantian',[ManajemenController::class,'printPergantian']);

    Route::get('/manajemen/laporanpermintaan',[ManajemenController::class,'indexLaporanPermintaan'])->name('reportpermintaanmanajemen');
    Route::get('/manajemen/cetakpermintaan',[ManajemenController::class,'printPermintaan'])->name('printpermintaanmanajemen');
    Route::get('/manajemen/filterlaporanpermintaan',[ManajemenController::class,'filterReportPermintaan'])->name('filterpermintaanmanajemen');

    Route::get('manajemen/laporanpeminjaman',[ManajemenController::class,'indexPeminjaman'])->name('peminjamanmanajemen');
    Route::get('/manajemen/cetakpeminjaman',[ManajemenController::class,'printPeminjaman']);

    Route::get('/manajemen/laporanpenempatan',[ManajemenController::class,'indexPenempatan'])->name('penempatanmanajemen');
    Route::get('/manajemen/detailpenempatan/{kodepenempatan}',[ManajemenController::class,'showPenempatan']);
    Route::get('/manajemen/filterlaporanpenempatan',[ManajemenController::class,'filterLokasi'])->name('filterpenempatanmanajemen');
    Route::get('/manajemen/cetakpenempatan',[ManajemenController::class,'printPenempatan'])->name('printpenempatanmanajemen');

    Route::get('/manajemen/laporanbarangrusak',[ManajemenController::class,'indexBarangRusak'])->name('barangrusakmanajemen');
    Route::get('/manajemen/detailbarangrusak/{kodelaporam}',[ManajemenController::class,'showBarangRusak']);
    Route::get('/manajemen/cetakbarangrusak',[ManajemenController::class,'printBarangRusak']);

    Route::get('/manajemen/laporanperbaikan',[ManajemenController::class,'indexPerbaikan'])->name('perbaikanmanajemen');
    Route::get('/manajemen/detailperbaikan/{id}',[ManajemenController::class,'showPerbaikan']);
    Route::get('/manajemen/cetakperbaikan',[ManajemenController::class,'printPerbaikan']);

    Route::get('/manajemen/laporanpenghapusanbarang',[ManajemenController::class,'indexPenghapusan'])->name('penghapusanmanajemen');
    Route::get('/manajemen/cetakpengahpusan',[ManajemenController::class, 'printPenghapusan']);
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
