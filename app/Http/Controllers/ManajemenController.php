<?php

namespace App\Http\Controllers;
use PDF;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Penempatan;
use App\Models\Ruangan;
use App\Models\Barang;
use App\Models\BarangRusak;
use App\Models\Perbaikan;
use App\Models\Vendor;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Permintaan;
use App\Models\Pembelian;
use App\Models\Pergantian;
use App\Models\Persediaan;
use App\Models\BarangTerbuang;

class ManajemenController extends Controller
{
 public function beranda(){
    return view('pages.manajemen.beranda.beranda');
 }
 public function indexPersediaan(){
    $barang = Barang::orderBy('kodebrg','ASC')
    ->paginate(10);

    return view('pages.manajemen.beranda.persediaan', compact('barang'));
}
public function indexBarangMasuk(){
    $pembelian = Pembelian::where('status', 'selesai')->get();
    $perbaikan = Perbaikan::where('status', 'selesai')->get();
    $peminjaman = Peminjaman::where('statuskembali','selesai')->get();
    $barangMasuk = collect();

    foreach ($pembelian as $item) {
        $barangMasuk->push([
            'kode' => $item->kodepembelian,
            'nama' => $item->namabrg,
            'tanggal' => $item->tglterima,
            'sumber' => 'Pembelian',
            'jumlah' => $item->jumlah,
        ]);
    }

    foreach ($perbaikan as $item) {
        $barangMasuk->push([
            'kode' => $item->kodelaporan,
            'nama' => $item->namabrg,
            'tanggal' => $item->tglselesai,
            'sumber' => 'Perbaikan',
            'jumlah' => '-',
        ]);
    }

    foreach ($peminjaman as $item) {
        $barangMasuk->push([
            'kode' => $item->kodepeminjaman,
            'nama' => $item->namabrg,
            'tanggal' => $item->tglkembali,
            'sumber' => 'Peminjaman',
            'jumlah' => $item->jumlah,
        ]);
    }
    $perPage = 10;
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $currentItems = $barangMasuk->slice(($currentPage - 1) * $perPage, $perPage)->all();
    $barangMasuk = new LengthAwarePaginator($currentItems, $barangMasuk->count(), $perPage);

    $barangMasuk->setPath(request()->url());

    return view('pages.manajemen.beranda.barangmasuk', compact('barangMasuk'));
}
public function indexBarangKeluar(){
    $penempatan = Penempatan::where('status', 'selesai')->get();
    $pergantian = Pergantian::where('status', 'selesai')->get();
    $pergantian = Pergantian::where('status', 'selesai')->get();
    $peminjaman = Peminjaman::where('status', 'selesai')->get();
    $barangterbuang = BarangTerbuang::whereIn('status', ['dihibahkan', 'dijual', 'dibuang'])->get();


    $barangKeluar = collect();

    foreach ($penempatan as $item) {
        $barangKeluar->push([
            'kode' => $item->kodepenempatan,
            'nama' => $item->namabrg,
            'tanggal' => $item->tglpenempatan,
            'sumber' => 'Penempatan',
            'jumlah' => $item->jumlah,
        ]);
    }

    foreach ($pergantian as $item) {
        $barangKeluar->push([
            'kode' => $item->kodepergantian,
            'nama' => $item->namabrg,
            'tanggal' => $item->tglterima,
            'sumber' => 'Pergantian',
            'jumlah' => $item->jumlah,
        ]);
    }
    foreach ($peminjaman as $item) {
        $barangKeluar->push([
            'kode' => $item->kodepeminjaman,
            'nama' => $item->namabrg,
            'tanggal' => $item->tglterima,
            'sumber' => 'Peminjaman',
            'jumlah' => $item->jumlah,
        ]);
    }
    foreach ($barangterbuang as $item) {
        $barangKeluar->push([
            'kode' => $item->kodehapus,
            'nama' => $item->namabrg,
            'tanggal' => $item->tglhapus,
            'sumber' => 'Barang Terbuang',
            'jumlah' => $item->jumlah,
        ]);
    }
    $perPage = 10;
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $currentItems = $barangKeluar->slice(($currentPage - 1) * $perPage, $perPage)->all();
    $barangKeluar = new LengthAwarePaginator($currentItems, $barangKeluar->count(), $perPage);

    $barangKeluar->setPath(request()->url());

    return view('pages.manajemen.beranda.barangkeluar', compact('barangKeluar'));
}
public function indexLokasiBarang(Request $request){
    $ruangan_id = $request->input('ruangan');
    $ruanganList = Ruangan::all();

    $penempatan = Penempatan::orderBy('kodepenempatan','ASC')
    ->paginate(10);


    return view('pages.manajemen.beranda.lokasi', compact('penempatan','ruanganList'));
}
public function filterLokasi(Request $request){
    $ruanganList = Ruangan::all();
    $ruangan = $request->input('ruangan');
    $bulan = $request->input('bulan');

    $penempatanQuery = Penempatan::query();

    if ($ruangan) {
        $penempatanQuery->where('ruangan', $ruangan);
    }

    if ($bulan) {
        $penempatanQuery->whereMonth('tglpenempatan', $bulan);
    }
    $penempatan = $penempatanQuery->paginate(10);

    return view('pages.manajemen.beranda.lokasi', compact('penempatan', 'ruangan','ruanganList','bulan'));
}
 /**
  * Barang
  */
  public function indexBarang(){
    $barang= Barang::orderBy('kodebrg', 'ASC')
    ->paginate(10);

    return view('pages.manajemen.barang.index', compact('barang'));
  }

 /**
  * Permintaan dan Pengadaan Barang
  */
  public function indexPermintaanBarang(){
    $permintaan = Permintaan::whereNull('status')
    ->orWhereIn('status', ['permintaan disetujui', 'permintaan ditolak', 'dalam proses pembelian'])
    ->orderBy('kodepermintaan', 'ASC')
    ->paginate(10);

    return view('pages.manajemen.permintaan.index', compact('permintaan'));
  }
  public function confirmPermintaanBarang($kodepermintaan){
    $permintaan = Permintaan::where('kodepermintaan', $kodepermintaan)->firstOrFail();

    return view('pages.manajemen.permintaan.confirm', compact('permintaan'));
  }
  public function updateConfirmPermintaanBarang(Request $request, $kodepermintaan){
    $permintaan = Permintaan::where('kodepermintaan', $kodepermintaan)->firstOrFail();
    if ($request->input('action') == 'Konfirmasi') {
        $permintaan->status = 'permintaan disetujui';
    } elseif ($request->input('action') == 'Ditolak') {
        $permintaan->status = 'permintaan ditolak';
    }
    $permintaan->save();

    return redirect()->route('permintaanmanajemen')->with('success', 'Data Berhasil Dikonfirmasi');
  }
  public function updatePermintaanBeli(Request $request, $kodepermintaan){
    $permintaan = Permintaan::where('kodepermintaan', $kodepermintaan)->firstOrFail();
    $permintaan->status = 'dalam proses pembelian';
    $permintaan->save();

    $itemsPermintaan = Permintaan::where('kodepermintaan', $kodepermintaan)
        ->where('status', 'dalam proses pembelian')
        ->get(['namabrg', 'jumlah']);

    $pb = Pembelian::latest()->first();
    $kode = "OBRG";
    $barang = "IVT";

    if ($pb == null) {
        $noUrut = "0001";
    } else {
        $noUrut = intval(substr($pb->kodepembelian, -4)) + 1;
        $noUrut = str_pad($noUrut, 4, "0", STR_PAD_LEFT);
    }

    $kodePembelian = "$kode-$barang$noUrut";

    foreach ($itemsPermintaan as $item) {
        Pembelian::updateOrCreate(
            [
                'kodepembelian' => $kodePembelian,
                'namabrg' => $item->namabrg,
            ],
            [
                'jumlah' => $item->jumlah,
                'status' => 'sedang diproses',
            ]
        );
    }
    return redirect()->route('permintaanmanajemen')->with('success', 'Permintaan Pembelian Telah Dikonfirmasi');
}
  /**
   * Pembelian Barang
   */
  public function indexPembelianBarang(){
    $isFiltered = false;
    $pembelian = Pembelian::whereNull('status')
    ->orWhereIn('status',['ceklis','selesai','Ditolak'])
    ->orWhere('kodepembelian')
    ->orderBy('kodepembelian', 'ASC')
    ->paginate(10);

    return view('pages.manajemen.pembelian.index', compact('pembelian','isFiltered'));
  }
  public function confirmPembelianBarang($kodepembelian){
    $pembelian = Pembelian::where('kodepembelian', $kodepembelian)->firstOrFail();

    return view('pages.manajemen.pembelian.confirm', compact('pembelian'));
  }
  public function updateConfirmPembelianBarang(Request $request, $kodepembelian){
    $pembelian = Pembelian::where('kodepembelian', $kodepembelian)->firstOrFail();
    $pembelian->catatan = $request->catatan;
    if ($request->input('action') == 'Konfirmasi') {
        $pembelian->status = 'ceklis';
    } elseif ($request->input('action') == 'Ditolak') {
        $pembelian->status = 'Ditolak';
        $pembelian->tglterima = null;
    }
    $pembelian->save();

    return redirect()->route('pembelianmanajemen')->with('success', 'Pembelian Barang Telah Dikonfirmasi');
  }
  public function showPembelianBarang($kodepembelian){
    $pembelian = Pembelian::where('kodepembelian', $kodepembelian)->firstOrFail();

    return view('pages.manajemen.pembelian.show', compact('pembelian'));
  }

  /**
   * Laporan Pembelian
   */
  public function indexLaporanPembelian(Request $request){
    $isFiltered = false;
    $bulan = $request->input('bulan');
    $ruanganId = $request->input('ruangan');


    $query = Pembelian::orderBy('kodepembelian', 'ASC');
    if ($bulan) {
        $query->whereMonth('tglterima', $bulan);
        $isFiltered = true; // Set filtered status
        $title = "Laporan Pembelian Bulan " . date('F', mktime(0, 0, 0, $bulan, 10));
    } else {
        $title = "Laporan Pembelian Barang";
    }
    $pembelian = $query->paginate(10);
    return view('pages.manajemen.pembelian.report', compact('pembelian','isFiltered','title'));
  }
  public function showLaporanPembelian($kodepembelian){
    $pembelian = Pembelian::where('kodepembelian', $kodepembelian)->firstOrFail();

    return view('pages.manajemen.pembelian.show', compact('pembelian'));
  }
  public function filterReportPembelian(Request $request){
    $isFiltered = false;
    $bulan = $request->input('bulan');

    $pembelianQuery = Pembelian::query();

    if ($bulan) {
        $pembelianQuery->whereMonth('tglterima', $bulan);
        $isFiltered = true;
    }

    $pembelian = $pembelianQuery->paginate(10);

    return view('pages.manajemen.pembelian.report', compact('pembelian','isFiltered'));

  }
  public function printPembelian(Request $request){
    $bulan = $request->input('bulan');

    if ($bulan) {
        $pembelian = Pembelian::whereMonth('tglterima', $bulan)->get();
        $title = "Laporan Pembelian Bulan " . date('F', mktime(0, 0, 0, $bulan, 10));
    } else {
        $pembelian = Pembelian::all();
        $title = "Laporan Pembelian Barang";
    }
    $pdf = PDF::loadView('pages.manajemen.pembelian.print', compact('pembelian','title'))->setPaper('a4','landscape');

    return $pdf->stream('laporan-pembelian.pdf');
  }
  /**
   * Laporan Permintaan
   */
  public function indexLaporanPermintaan(Request $request){
    $isFiltered = false;
    $bulan = $request->input('bulan');

    $query = Permintaan::orderBy('kodepermintaan', 'ASC');
    if ($bulan) {
        $query->whereMonth('tglpermintaan', $bulan);
        $isFiltered = true;
        $title = "Laporan Permintaan Bulan " . date('F', mktime(0, 0, 0, $bulan, 10));
    } else {
        $title = "Laporan Permintaan Barang";
    }
    $permintaan = $query->paginate(10);
    return view('pages.manajemen.permintaan.report', compact('permintaan','isFiltered','title'));
  }
  public function printPermintaan(Request $request){
    $bulan = $request->input('bulan');
    if ($bulan) {
        $permintaan = Permintaan::whereMonth('tglpermintaan', $bulan)->get();
        $title = "Laporan Permintaan Bulan " . date('F', mktime(0, 0, 0, $bulan, 10));
    } else {
        $permintaan = Permintaan::all();
        $title = "Laporan Permintaan Barang";
    }
    $pdf = PDF::loadView('pages.manajemen.permintaan.print', compact('permintaan','title'))
    ->setPaper('a4','landscape');

    return $pdf->stream('laporan-permintaan.pdf');
  }
  public function filterReportPermintaan(Request $request){
    $isFiltered = false;
    $bulan = $request->input('bulan');

    $permintaanQuery = Permintaan::query();

    if ($bulan) {
        $permintaanQuery->whereMonth('tglpermintaan', $bulan);
        $isFiltered = true;
    }

    $permintaan = $permintaanQuery->paginate(10);

    return view('pages.manajemen.permintaan.report', compact('permintaan','isFiltered'));
  }
   /**
     * Laporan Pergantian Barang
     */
    public function indexPergantianBarang(){
        $pergantian = Pergantian::orderBy('kodepergantian', 'ASC')
        ->paginate(10);

        return view('pages.manajemen.pergantian.index', compact('pergantian'));
    }
    public function showPergantian($kodepergantian){
        $pergantian = Pergantian::where('kodepergantian', $kodepergantian)->firstOrFail();

        return view('pages.manajemen.pergantian.show', compact('pergantian'));
    }
    public function printPergantian(){
        $pergantian = Pergantian::all();
        $pdf = PDF::loadView('pages.manajemen.pergantian.print', compact('pergantian','title'))->setPaper('a4','landscape');

        return $pdf->stream('laporan-pergantian.pdf');
    }
  /**
   * Laporan Peminjaman dan Pengembalian
   */
  public function indexPeminjaman(){
    $peminjaman = Peminjaman::orderBy('kodepeminjaman', 'ASC')
    ->paginate(10);

    return view('pages.manajemen.peminjaman.index', compact('peminjaman'));
  }
  public function printPeminjaman(){
    $peminjaman = Peminjaman::all();
    $pdf = PDF::loadView('pages.manajemen.peminjaman.print', compact('peminjaman'))->setPaper('a4','landscape');

    return $pdf->stream('laporan-peminjaman.pdf');
  }
  /**
   * Laporan Penempatan Barang
   */
  public function indexPenempatan(){
    $isFiltered = false;
    $penempatan = Penempatan::orderBy('kodepenempatan','ASC')
    ->paginate(10);

    return view('pages.manajemen.penempatan.index', compact('penempatan','isFiltered'));
  }
  public function showPenempatan($kodepenempatan){
    $penempatan = Penempatan::where('kodepenempatan', $kodepenempatan)->firstOrFail();

    return view('pages.manajemen.penempatan.show', compact('penempatan'));
  }
  public function printPenempatan(Request $request){
    $ruangan = $request->input('ruangan');
    if ($ruangan) {
        $penempatan = Penempatan::where('ruangan', $ruangan)->get();
        $title = "Laporan Penempatan Barang Ruangan: " . $ruangan;
    } else {
        $penempatan = Penempatan::all();
        $title = "Laporan Penempatan Barang";
    }
    $pdf = PDF::loadView('pages.manajemen.penempatan.print',compact('penempatan','title'))->setPaper('a4','landscape');

    return $pdf->stream('laporan-penempatan.pdf');
  }
  public function filterPenempatan(Request $request){
    $isFiltered = false;
    $bulan = $request->input('bulan');

    $penempatanQuery = Penempatan::query();

    if ($bulan) {
        $penempatanQuery->whereMonth('tglpenempatan', $bulan);
        $isFiltered = true;
    }

    $penempatan = $penempatanQuery->paginate(10);

    return view('pages.manajemen.penempatan.index', compact('penempatan','isFiltered'));
  }
  /**
   * Laporan Barang Rusak
   */
  public function indexBarangRusak(){
    $barangrusak = BarangRusak::orderBy('kodelaporan','ASC')
    ->paginate(10);

    return view('pages.manajemen.barangrusak.index', compact('barangrusak'));
  }
  public function showBarangRusak($kodelaporan){
    $barangrusak = BarangRusak::where('kodelaporan', $kodelaporan)->firstOrFail();

    return view('pages.manajemen.barangrusak.show',compact('barangrusak'));
  }
  public function printBarangRusak(){
    $barangrusak = BarangRusak::all();
    $pdf = PDF::loadView('pages.manajemen.barangrusak.print',compact('barangrusak'))->setPaper('a4','landscape');

    return $pdf->stream('laporan-barangrusak.pdf');
  }
  /**
   * Laporan Perbaikan
   */
  public function indexPerbaikan(){
    $perbaikan = Perbaikan::orderBy('kodelaporan','ASC')
    ->paginate(10);

    return view('pages.manajemen.perbaikan.index', compact('perbaikan'));
  }
  public function showPerbaikan($id){
    $vendor = Vendor::all();
    $perbaikan = Perbaikan::findOrFail($id);

    return view('pages.manajemen.perbaikan.show', compact('vendor','perbaikan'));
  }
  public function printPerbaikan(){
    $perbaikan = Perbaikan::all();
    $pdf = PDF::loadView('pages.manajemen.perbaikan.print', compact('perbaikan'))->setPaper('a4','landscape');

    return $pdf->stream('laporan-perbaikan.pdf');
  }
  /**
   * Penghapusan Barang
   */
  public function indexPenghapusan(){
    $barangterbuang = BarangTerbuang::orderBy('kodehapus','ASC')
    ->paginate(10);

    return view('pages.manajemen.penghapusan.index', compact('barangterbuang'));
  }
  public function showPenghapusan(){
    $barangterbuang = BarangTerbuang::where('kodehapus','ASC')->firstOrFail();
  }
  public function printPenghapusan(){
    $barangterbuang = BarangTerbuang::all();
    $pdf = PDF::loadView('pages.manajemen.penghapusan.print',compact('barangterbuang'))->setPaper('a4','landscape');

    return $pdf->stream('laporan-penghapusan.pdf');
  }
}
