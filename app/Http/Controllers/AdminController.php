<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Penempatan;
use App\Models\Ruangan;
use App\Models\Kategori;
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
use PDF;


class AdminController extends Controller
{
    /**
     * Beranda Admin
     */
    public function beranda(){
        return view('pages.admin.beranda.beranda');
    }
    public function indexPersediaan(){
        $barang = Barang::orderBy('kodebrg','ASC')
        ->paginate(10);

        return view('pages.admin.beranda.persediaan', compact('barang'));
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
                'tanggal' => $item->tglpengembalian,
                'sumber' => 'Pengembalian',
                'jumlah' => $item->jumlah,
            ]);
        }
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $barangMasuk->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $barangMasuk = new LengthAwarePaginator($currentItems, $barangMasuk->count(), $perPage);

        $barangMasuk->setPath(request()->url());

        return view('pages.admin.beranda.barangmasuk', compact('barangMasuk'));
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

        return view('pages.admin.beranda.barangkeluar', compact('barangKeluar'));
    }
    public function indexLokasiBarang(Request $request){
        $ruangan_id = $request->input('ruangan');
        $ruanganList = Ruangan::all();

        $penempatan = Penempatan::orderBy('kodepenempatan','ASC')
        ->where('status','selesai')
        ->paginate(10);


        return view('pages.admin.beranda.lokasi', compact('penempatan','ruanganList'));
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

        return view('pages.admin.beranda.lokasi', compact('penempatan', 'ruangan','ruanganList','bulan'));
    }
    /**Barang Controller
     *
    */
    public function indexBarang()
    {
        $isFiltered = false;
        $kategoriList = Kategori::all();
        $barang = Barang::orderBy('kodebrg', 'ASC')->paginate(10);

        return view('pages.admin.barang.index',compact('barang','isFiltered','kategoriList'));
    }
    public function getBarangByKode($kodebrg)
    {
        $barang = Barang::where('kodebrg', $kodebrg)->first();
        return response()->json($barang);
    }
    public function createBarang()
    {
        $kategori = Kategori::all();
        $b = \App\Models\Barang::latest()->first();
        $kode = "NM";
        $barang = "IVT";
        if($b == null){
            $noUrut = "0001";
        }else{
            $explode = explode("-", $b->kodebrg);
            $noUrut = intval($explode[0]);
            $noUrut = (int)substr($b->kodebrg, 6, 4)+1;
            $noUrut = str_pad($noUrut, 4, "0", STR_PAD_LEFT);
        }
        $kodeBarang = "$kode-$barang".$noUrut;
        return view('pages.admin.barang.create', compact('kodeBarang','kategori'));
    }
    public function storeBarang(Request $request)
    {
        Barang::create([
            'kodebrg'=> $request->kodebrg,
            'namabrg'=>$request->namabrg,
            'kategori'=> $request->kategori,
            'jumlah'=> $request->jumlah,
            'spesifikasi'=>$request->spesifikasi,
            'stok'=> $request->jumlah,
        ]);
        Persediaan::create($request->all());
        return redirect()->route('barangadmin')-> with('success', 'Data berhasil ditambahkan');

        Persedian::create($request->all());
    }
    public function showBarang($kodebrg)
    {
        $barang = Barang::where('kodebrg', $kodebrg)->firstOrFail();

        return view('pages.admin.barang.show', compact('barang'));
    }
    public function editBarang($kodebrg)
    {
        $kategori = Kategori::all();
        $barang = Barang::where('kodebrg', $kodebrg)->firstOrFail();
        return view('pages.admin.barang.edit', compact('barang','kategori'));
    }
    public function updateBarang(Request $request, $kodebrg)
    {
        $barang = Barang::where('kodebrg', $kodebrg)->firstOrFail();
        $barang->kodebrg = $request->kodebrg;
        $barang->namabrg = $request->namabrg;
        $barang->kategori = $request->kategori;
        $barang->jumlah = $request->jumlah;
        $barang->spesifikasi = $request->spesifikasi;
        $barang->save();

        return redirect()->route('barangadmin', compact('barang'))->with('success', 'Data berhasil diupdate!');
    }
    public function destroyBarang($kodebrg)
    {
        $barang = Barang::where('kodebrg', $kodebrg)->firstOrFail();
        $barang->delete();
        return redirect()->route('barangadmin')->with('success', 'Data berhasil dihapus!');
    }
    public function searchBarang(Request $request){
        $cari = $request-> cari;
        $barang = Barang::where('namabrg', 'like', '%'.$cari.'%')
        ->orWhere('kodebrg','like','%'.$cari.'%')
        ->paginate();

        return view('pages.admin.barang.index', compact('barang'));
    }
    public function filterBarang(Request $request){
        $kategoriList = Kategori::all();
        $kategori = $request->input('kategori');

        $barangQuery = Barang::query();
        if ($kategori) {
            $barangQuery->where('kategori', $kategori);
            $isFiltered = true;
        } else {
            $isFiltered = false; // Jika tidak ada kategori yang dipilih
        }
        $barang = $barangQuery->paginate(10);

        return view('pages.admin.barang.index', compact('barang', 'kategori', 'kategoriList', 'isFiltered'));
    }
    public function printBarang(Request $request){
        $kategori = $request->input('kategori');
        if ($kategori) {
            $barang = Barang::where('kategori', $kategori)->get();
            $title = 'Laporan Barang Kategori: ' . $kategori;
        } else {
            $barang = Barang::all(); // Ambil semua barang jika tidak ada kategori yang dipilih
            $title = "Laporan Barang";
        }
        $pdf = PDF::loadView('pages.admin.barang.print', compact('barang', 'title'))
                   ->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-barang.pdf');
    }

    /** Penempatan Controller
     *
    */
    public function indexPenempatan(){
        $isFiltered = false;
        $penempatan = Penempatan::orderBy('kodepenempatan','ASC')->paginate(10);
        return view('pages.admin.penempatan.index', compact('penempatan', 'isFiltered'));
    }
    public function createPenempatan(Request $request){
        $kategori = Kategori::all();
        $barang = Barang::all();
        $ruangan = Ruangan::all();

        // Ambil kode penempatan
        $p = \App\Models\Penempatan::latest()->first();
        $kode = "LOC";
        $inventaris = "IVT";

        if ($p == null) {
            $noUrut = "0001";
        } else {
            $noUrut = (int)substr($p->kodepenempatan, 7, 4) + 1;
            $noUrut = str_pad($noUrut, 4, "0", STR_PAD_LEFT);
        }

        $kodePenempatan = "$kode-$inventaris" . $noUrut;

        return view('pages.admin.penempatan.create', compact('kategori','barang','ruangan','kodePenempatan'));
    }

    public function storePenempatan(Request $request)
    {
        $penempatan = Penempatan::create([
            'kodepenempatan'=> $request->kodepenempatan,
            'ruangan'=> $request->ruangan,
            'namabrg'=> $request->namabrg,
            'jumlah'=> $request->jumlah,
        ]);
        $barang = Barang::where('namabrg', $penempatan->namabrg)->first();
        if ($barang) {
            $barang->stok += $penempatan->jumlah;
            $barang->save();
        }

        return redirect()->route('penempatanadmin')-> with('success', 'Data berhasil ditambahkan');
    }
    public function editPenempatan($kodepenempatan)
    {
        $penempatan = Penempatan::where('kodepenempatan', $kodepenempatan)->firstOrFail();
        $barang = Barang::all();
        $ruangan = Ruangan::all();
        return view('pages.admin.penempatan.edit', compact('penempatan','barang','ruangan'));
    }
    public function updatePenempatan(Request $request, $kodepenempatan)
    {
        $ruangan = Ruangan::all();
        $barang = Barang::all();
        $penempatan = Penempatan::where('kodepenempatan', $kodepenempatan)->firstOrFail();
        $penempatan->tglpenempatan = $request->tglpenempatan;
        $penempatan->id_ruang = $request->id_ruang;
        $penempatan->namabrg = $request->namabrg;
        $penempatan->jumlah = $request->jumlah;
        $penempatan->kategori = $request->kategori;
        $penempatan->save();

        return redirect()->route('penempatanadmin', compact('penempatan','ruangan','barang'))->with('success', 'Data berhasil diupdate!');
    }
    public function destroyPenempatan($kodepenempatan){
        $penempatan = Penempatan::where('kodepenempatan', $kodepenempatan)->firstOrFail();
        $penempatan->delete();

        return redirect()->route('penempatanadmin')->with('success', 'Data Berhasil Dihapus');
    }
    public function showPenempatan($kodepenempatan)
    {
        $penempatan = Penempatan::where('kodepenempatan', $kodepenempatan)->firstOrFail();

        return view('pages.admin.penempatan.show', compact('penempatan'));
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

        return view('pages.admin.penempatan.index', compact('penempatan','isFiltered'));
    }
      public function printPenempatan(Request $request){
        $bulan = $request->input('bulan');

        if ($bulan) {
            $penempatan = Penempatan::whereMonth('tglpenempatan', $bulan)->get();
            $title = "Laporan Penempatan Barang Bulan " . date('F', mktime(0, 0, 0, $bulan, 10));
        } else {
            $penempatan = Penempatan::all();
            $title = "Laporan Penempatan Barang";
        }
        $pdf = PDF::loadView('pages.admin.penempatan.print', compact('penempatan','title'))->setPaper('a4','landscape');

        return $pdf->stream('laporan-penempatan.pdf');
      }
    /**
     * Barang Rusak
     */
    public function indexBarangRusak(){
        $isFiltered = false;
        $barangrusak = BarangRusak::orderBy('kodelaporan','ASC')
        ->paginate(10);

        return view('pages.admin.barangrusak.index',compact('barangrusak','isFiltered'));
    }
    public function showBarangRusak($kodelaporan){
        $barangrusak = BarangRusak::where('kodelaporan', $kodelaporan)->firstOrFail();

        return view('pages.admin.barangrusak.show', compact('barangrusak'));
    }
    public function createBarangRusak(){
        $br = \App\Models\BarangRusak::latest()->first();
        $kode = "BR";
        $inventaris = "IVT";
        if($br == null){
            $noUrut = "0001";
        }else{
            $explode = explode("-", $br->kodelaporan);
            $noUrut = intval($explode[0]);
            $noUrut = (int)substr($br->kodelaporan, 6, 4)+1;
            $noUrut = str_pad($noUrut, 4, "0", STR_PAD_LEFT);
        }
        $kodeLaporan = "$kode-$inventaris".$noUrut;

        $ruangan = Ruangan::all();
        $barang = Barang::all();

        return view('pages.admin.barangrusak.create', compact('kodeLaporan','ruangan','barang'));
    }
    public function storeBarangRusak(Request $request){
        BarangRusak::create([
            'kodelaporan'=> $request->kodelaporan,
            'tgllaporan'=> $request->tgllaporan,
            'ruangan'=> $request->ruangan,
            'namabrg'=> $request->namabrg,
            'deskripsi'=>$request->deskripsi,
            'status'=> 'sedang diproses'
        ]);
        return redirect()->route('barangrusakadmin')->with('success','Data berhasil ditambahkan');
    }
    public function filterBarangRusak(Request $request){
        $isFiltered = false;
        $bulan = $request->input('bulan');

        $kerusakanQuery = BarangRusak::query();

        if ($bulan) {
            $kerusakanQuery->whereMonth('tgllapor', $bulan);
            $isFiltered = true;
        }
        $barangrusak = $kerusakanQuery->paginate(10);

        return view('pages.admin.barangrusak.index', compact('barangrusak','isFiltered'));
    }
    public function printBarangRusak(Request $request){
        $bulan = $request->input('bulan');

        if ($bulan) {
            $barangrusak = BarangRusak::whereMonth('tgllaporan', $bulan)->get();
            $title = "Laporan Barang Rusak Bulan " . date('F', mktime(0, 0, 0, $bulan, 10));
        } else {
            $barangrusak = BarangRusak::all();
            $title = "Laporan Barang Rusak";
        }
        $pdf = PDF::loadView('pages.admin.barangrusak.print', compact('barangrusak','title'))->setPaper('a4','landscape');

        return $pdf->stream('laporan-barangrusak.pdf');
    }
    /**
     * Perbaikan Barang
     */
    public function indexPerbaikanBarang(){
        $isFiltered = false;
        $itemsPerbaikan = BarangRusak::where('penanganan', 'perbaikan eksternal')
        ->get(['namabrg', 'kodelaporan', 'deskripsi']);

        foreach ($itemsPerbaikan as $item) {
            $pb = Perbaikan::where('kodeperbaikan', 'like', 'RPIR-IVT%')
                ->orderBy('kodeperbaikan', 'desc')
                ->first();

            $kode = "RPIR";
            $barang = "IVT";

            if ($pb == null) {
                $noUrut = "0001";
            } else {
                $noUrut = intval(substr($pb->kodeperbaikan, -4)) + 1;
                $noUrut = str_pad($noUrut, 4, "0", STR_PAD_LEFT);
            }

        $kodePerbaikan = "$kode-$barang$noUrut";
        $exists = Perbaikan::where('kodelaporan', $item->kodelaporan)
            ->where('namabrg', $item->namabrg)
            ->exists();
        if (!$exists){
            Perbaikan::updateOrCreate(
                [
                    'kodeperbaikan' => $kodePerbaikan,
                    'namabrg' => $item->namabrg,
                ],
                [
                    'deskripsi' => $item->deskripsi,
                    'status' => 'sedang diproses',
                    'kodelaporan' => $item->kodelaporan,
                ]
            );
        }
    }

    $perbaikan = Perbaikan::orderBy('kodeperbaikan', 'ASC')
        ->paginate(10);

    return view('pages.admin.perbaikan.index', compact('perbaikan','isFiltered'));
}
    public function createPerbaikanBarang(){
        $pb = \App\Models\Perbaikan::latest()->first();
        $kode = "RPIR";
        $inventaris = "IVT";
        if($pb == null){
            $noUrut = "0001";
        }else{
            $explode = explode("-", $pb->kodepergantian);
            $noUrut = intval($explode[0]);
            $noUrut = (int)substr($pb->kodepergantian, 9, 4)+1;
            $noUrut = str_pad($noUrut, 4, "0", STR_PAD_LEFT);
        }
        $kodePerbaikan= "$kode-$inventaris".$noUrut;

        $vendor = Vendor::all();
        $barang = Barang::all();

        return view('pages.admin.perbaikan.create', compact('kodePerbaikan','vendor','barang'));
    }
    public function storePerbaikanBarang(Request $request){
        Perbaikan::create([
            'kodeperbaikan'=> $request->kodeperbaikan,
            'tglperbaikan'=>$request->tglperbaikan,
            'namabrg' => $request->namabrg,
            'jumlah' => $request->jumlah,
            'vendor' => $request->vendor,
            'deskripsi' => $request->deskripsi,
            'status' => 'sedang diproses'
        ]);
        return redirect()->route('perbaikanbarangadmin')->with('success','Data Berhasil Ditambahkan');
    }
    public function editPerbaikanBarang($kodeperbaikan){
        $vendor = Vendor::all();
        $perbaikan = Perbaikan::where('kodeperbaikan', $kodeperbaikan)->firstOrFail();

        return view('pages.admin.perbaikan.edit', compact('perbaikan','vendor'));
    }
    public function updatePerbaikanBarang(Request $request, $kodeperbaikan){
        $perbaikan = Perbaikan::where('kodeperbaikan', $kodeperbaikan)->firstOrFail();
        $perbaikan->tglperbaikan = $request->tglperbaikan;
        $perbaikan->vendor = $request->vendor;
        $perbaikan->deskripsi = $request->deskripsi;
        $perbaikan->status='sedang diproses';
        $perbaikan->save();

        return redirect()->route('perbaikanbarangadmin')->with('success', 'Perbaikan Barang Telah Diupdate');
    }
    public function confrimPerbaikanBarang($kodeperbaikan){
        $perbaikan = Perbaikan::where('kodeperbaikan', $kodeperbaikan)->firstOrFail();

        return view('pages.admin.perbaikan.confirm', compact('perbaikan'));
    }
    public function updateConfirmPerbaikanBarang(Request $request, $kodeperbaikan){
        $perbaikan = Perbaikan::where('kodeperbaikan', $kodeperbaikan)->firstOrFail();
        $perbaikan->tglselesai = $request->tglselesai;
        $perbaikan->status='selesai';
        $perbaikan->biaya = $request->biaya;
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/nota-perbaikan', $filename);
            $perbaikan->bukti = $filename;
        }
        $perbaikan->save();

        return redirect()->route('perbaikanbarangadmin')->with('success', 'Data Telah Dikonfirmasi');
    }
    public function showPerbaikanBarang($kodeperbaikan){
        $vendor = Vendor::all();
        $perbaikan = Perbaikan::where('kodeperbaikan', $kodeperbaikan)->firstOrFail();

        return view('pages.admin.perbaikan.show', compact('vendor','perbaikan'));
    }
    public function filterPerbaikan(Request $request){
        $isFiltered = false;
        $bulan = $request->input('bulan');

        $perbaikanQuery = Perbaikan::query();

        if ($bulan) {
            $perbaikanQuery->whereMonth('tglperbaikan', $bulan);
            $isFiltered = true;
        }
        $perbaikan= $perbaikanQuery->paginate(10);

        return view('pages.admin.perbaikan.index', compact('perbaikan','isFiltered'));
    }
    public function printPerbaikan(Request $request){
        $bulan = $request->input('bulan');

        if ($bulan) {
            $perbaikan = Perbaikan::whereMonth('tglperbaikan', $bulan)->get();
            $title = "Laporan BPerbaikan Barang Bulan " . date('F', mktime(0, 0, 0, $bulan, 10));
        } else {
            $perbaikan = Perbaikan::all();
            $title = "Laporan Perbaikan Barang";
        }
        $pdf = PDF::loadView('pages.admin.perbaikan.print', compact('perbaikan','title'))->setPaper('a4','landscape');

        return $pdf->stream('laporan-perbaikan.pdf');
    }
    /**
     * Peminjaman Barang
     */
    public function indexPeminjamanBarang(){
        $isFiltered = false;
        $peminjaman = Peminjaman::orderBy('kodepeminjaman', 'ASC')
        ->paginate(10);

        return view('pages.admin.peminjaman.index', compact('peminjaman','isFiltered'));
    }
    public function confirmPeminjamanBarang($kodepeminjaman){
        $peminjaman = Peminjaman::where('kodepeminjaman', $kodepeminjaman)->firstOrFail();

        return view('pages.admin.peminjaman.confirm', compact('peminjaman'));
    }
    public function updateConfirmPeminjamanBarang(Request $request, $kodepeminjaman){
        $barang = Barang::all();
        $ruangan = Ruangan::all();
        $peminjaman = Peminjaman::where('kodepeminjaman', $kodepeminjaman)->firstOrFail();
        $peminjaman->tglpengembalian = $request->tglpengembalian;
        if ($request->input('action') == 'Konfirmasi') {
            $peminjaman->status = 'sedang diproses';
        } elseif ($request->input('action') == 'Ditolak') {
            $peminjaman->status = 'Ditolak';
            $peminjaman->tglterima = null;
        }
        $peminjaman->save();

        return redirect()->route('peminjamanadmin')->with('success', 'Data Telah Dikonfirmasi');
    }
    public function showPeminjamanBarang($kodepeminjaman){
        $peminjaman = Peminjaman::where('kodepeminjaman', $kodepeminjaman)->firstOrFail();

        return view('pages.admin.peminjaman.show', compact('peminjaman'));
    }
    public function filterPeminjaman(Request $request){
        $isFiltered = false;
        $bulan = $request->input('bulan');

        $peminjamanQuery = Peminjaman::query();

        if ($bulan) {
            $peminjamanQuery->whereMonth('tglterima', $bulan);
            $isFiltered = true;
        }
        $peminjaman = $peminjamanQuery->paginate(10);

        return view('pages.admin.peminjaman.index', compact('peminjaman','isFiltered'));
    }
    public function printPeminjaman(Request $request){
        $bulan = $request->input('bulan');

        if ($bulan) {
            $peminjaman = Peminjaman::whereMonth('tglterima', $bulan)->get();
            $title = "Laporan Pembelian Bulan " . date('F', mktime(0, 0, 0, $bulan, 10));
        } else {
            $peminjaman = Peminjaman::all();
            $title = "Laporan Peminjaman Barang";
        }
        $pdf = PDF::loadView('pages.admin.peminjaman.print', compact('peminjaman','title'))->setPaper('a4','landscape');

        return $pdf->stream('laporan-peminjaman.pdf');
    }
    /**
     * Pengembalian Barang
     */
    public function indexPengembalianBarang(){
        $isFiltered = false;
        $peminjaman = Peminjaman::where('status', 'selesai')
        ->orderBy('kodepeminjaman', 'ASC')
        ->paginate(10);

        return view('pages.admin.pengembalian.index', compact('peminjaman','isFiltered'));
    }
    public function filterPengembalian(Request $request){
        $isFiltered = false;
        $bulan = $request->input('bulan');

        $pengembalianQuery = Peminjaman::query();

        if ($bulan) {
            $pengembalianQuery->whereMonth('tglkembali', $bulan);
            $isFiltered = true;
        }
        $peminjaman = $pengembalianQuery->paginate(10);

        return view('pages.admin.pengembalian.index', compact('peminjaman','isFiltered'));
    }
    public function printPengembalian(Request $request){
        $bulan = $request->input('bulan');

        if ($bulan) {
            $peminjaman= Peminjaman::whereMonth('tglkembali', $bulan)->get();
            $title = "Laporan Pengembalian Bulan " . date('F', mktime(0, 0, 0, $bulan, 10));
        } else {
            $peminjaman = Peminjaman::all();
            $title = "Laporan Pengembalian Barang";
        }
        $pdf = PDF::loadView('pages.admin.pengembalian.print', compact('peminjaman','title'))->setPaper('a4','landscape');

        return $pdf->stream('laporan-pengembalian.pdf');
    }
    /**
     * Permintaan Barang
     */
    public function indexPermintaanBarang(){
        $isFiltered = false;
        $permintaan = Permintaan::orderBy('kodepermintaan', 'ASC')
        ->paginate(10);

        return view('pages.admin.permintaan.index', compact('permintaan', 'isFiltered'));
    }
    public function filterPermintaan(Request $request){
        $isFiltered = false;
        $bulan = $request->input('bulan');

        $permintaanQuery = Permintaan::query();

        if ($bulan) {
            $permintaanQuery->whereMonth('tglpermintaan', $bulan);
            $isFiltered = true;
        }

        $permintaan = $permintaanQuery->paginate(10);

        return view('pages.admin.permintaan.index', compact('permintaan','isFiltered'));
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
        $pdf = PDF::loadView('pages.admin.permintaan.print', compact('permintaan','title'))
        ->setPaper('a4','landscape');

        return $pdf->stream('laporan-permintaan.pdf');
    }
    /**
     * Pembelian Barang
     */

    public function indexPembelianBarang(){
        $isFiltered = false;
        $pembelian = Pembelian::orderBy('kodepembelian', 'ASC')
        ->paginate(10);

        return view('pages.admin.pembelian.index', compact('pembelian', 'isFiltered'));
    }
    public function createPembelianBarang(){
        $pb = \App\Models\Pembelian::latest()->first();
        $kode = "OBRG";
        $barang = "IVT";
        if($pb == null){
            $noUrut = "0001";
        }else{
            $explode = explode("-", $pb->kodepembelian);
            $noUrut = intval($explode[0]);
            $noUrut = (int)substr($pb->kodepembelian, 8, 4)+1;
            $noUrut = str_pad($noUrut, 4, "0", STR_PAD_LEFT);
        }
        $kodePembelian = "$kode-$barang".$noUrut;
        $vendor = Vendor::all();

        return view('pages.admin.pembelian.create', compact('kodePembelian','vendor'));
    }
    public function storePembelianBarang(Request $request){
        Pembelian::create([
            'kodepembelian'=> $request->kodepembelian,
            'namabrg'=> $request->namabrg,
            'tglbeli'=> $request->tglbeli,
            'jumlah'=> $request->jumlah,
            'vendor'=>$request->vendor,
            'harga'=> $request->harga,
            'spesifikasi'=> $request->spesifikasi,
            'status'=>null,
        ]);

        return redirect()->route('pembelianadmin')->with('success', 'Pembelian Berhasil Ditambahkan');
    }
    public function confrimPembelianBarang($kodepembelian){
        $pembelian = Pembelian::where('kodepembelian', $kodepembelian)->firstOrFail();

        return view('pages.admin.pembelian.confirm', compact('pembelian'));
    }
    public function updateConfirmPembelianBarang(Request $request, $kodepembelian){
        $pembelian = Pembelian::where('kodepembelian', $kodepembelian)->firstOrFail();
        $pembelian->tglterima= $request->tglterima;
        $pembelian->status = 'selesai';

        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/nota-pembelian', $filename);
            $pembelian->bukti = $filename;
        }
        $pembelian->save();

        $namaBarang = $pembelian->namabrg;
        $jumlahPembelian = $pembelian->jumlah;

        $barang = Barang::where('namabrg', $namaBarang)->first();
        if ($barang) {
            $barang->jumlah += $jumlahPembelian;
            $barang->stok += $jumlahPembelian;
            $barang->save();
        } else {
            $b = Barang::latest()->first();
            $kode = "NM";
            $barang = "IVT";
            if($b == null){
                $noUrut = "0001";
            }else{
                $noUrut =  intval(substr($b->kodebrg, -4)) + 1;
                $noUrut = str_pad($noUrut, 4, "0", STR_PAD_LEFT);
            }
            $kodeBarang = "$kode-$barang".$noUrut;

            Barang::create([
                'kodebrg'=> $kodeBarang,
                'namabrg'=> $pembelian->namabrg,
                'jumlah'=> $pembelian->jumlah,
                'spesifikasi' => $pembelian->spesifikasi,
                'stok' => $pembelian->jumlah,
            ]);
        }

        return redirect()->route('pembelianadmin')->with('success', 'Transaksi Pembelian Barang Telah Selesai');
    }
    public function showPembelianBarang($kodepembelian){
        $pembelian = Pembelian::where('kodepembelian', $kodepembelian)->firstOrFail();

        return view('pages.admin.pembelian.show', compact('pembelian'));
    }
    public function destroyPembelianBarang($kodepembelian){
        $pembelian = Pembelian::where('kodepembelian', $kodepembelian)->firstOrFail();
        $pembelian->delete();

        return redirect()->route('pembelianadmin')->with('success', 'Data Pembelian Telah Dihapus');

    }
    public function editPembelianBarang($kodepembelian){
        $vendor = Vendor::all();
        $pembelian = Pembelian::where('kodepembelian', $kodepembelian)->firstOrFail();

        return view('pages.admin.pembelian.edit', compact('pembelian','vendor'));
    }
    public function updatePembelian(Request $request, $kodepembelian){
        $pembelian = Pembelian::where('kodepembelian', $kodepembelian)->firstOrFail();
        $pembelian->tglbeli = $request->tglbeli;
        $pembelian->namabrg = $request->namabrg;
        $pembelian->vendor = $request->vendor;
        $pembelian->jumlah = $request->jumlah;
        $pembelian->harga = $request->harga;
        $pembelian->spesifikasi = $request->spesifikasi;
        $pembelian->save();

        return redirect()->route('pembelianadmin')->with('success', 'Data Pembelian Telah diupdate');
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

        return view('pages.admin.pembelian.index', compact('pembelian','isFiltered'));
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
        $pdf = PDF::loadView('pages.admin.pembelian.print', compact('pembelian','title'))->setPaper('a4','landscape');

        return $pdf->stream('laporan-pembelian.pdf');
      }
    /**
     * Pergantian Barang
     */
    public function indexPergantianBarang(){
        $isFiltered = false;
        $pergantian = Pergantian::orderBy('kodepergantian', 'ASC')
        ->paginate(10);

        return view('pages.admin.pergantian.index', compact('pergantian','isFiltered'));
    }
    public function createPergantianBarang(){
        $pg = \App\Models\Pergantian::latest()->first();
        $kode = "SWTC";
        $inventaris = "IVT";
        if($pg == null){
            $noUrut = "0001";
        }else{
            $explode = explode("-", $pg->kodepergantian);
            $noUrut = intval($explode[0]);
            $noUrut = (int)substr($pg->kodepergantian, 8, 4)+1;
            $noUrut = str_pad($noUrut, 4, "0", STR_PAD_LEFT);
        }
        $kodePergantian = "$kode-$inventaris".$noUrut;

        $ruangan = Ruangan::all();
        $barang = Barang::all();
        return view('pages.admin.pergantian.create', compact('kodePergantian','barang','ruangan'));
    }
    public function storePergantian(Request $request){
        Pergantian::create([
            'kodepergantian'=> $request->kodepergantian,
            'tglpergantian'=> $request->tglpergantian,
            'ruangan'=> $request->ruangan,
            'namabrg'=> $request->namabrg,
            'jumlah'=> $request->jumlah,
            'keterangan'=> $request->keterangan,
        ]);
        return redirect()->route('pergantianadmin')-> with('success', 'Data berhasil ditambahkan');
    }
    public function editPergantian($kodepergantian){
        $pergantian= Pergantian::where('kodepergantian', $kodepergantian)->firstOrFail();
        $ruangan = Ruangan::all();
        $barang = Barang::all();

        return view('pages.admin.pergantian.edit', compact('pergantian', 'ruangan', 'barang'));
    }
    public function updatePergantian(Request $request, $kodepergantian){
        $ruangan = Ruangan::all();
        $barang = Barang::all();
        $pergantian = Pergantian::where('kodepergantian', $kodepergantian)->firstOrFail();
        $pergantian->tglpergantian= $request->tglpergantian;
        $pergantian->ruangan = $request->ruangan;
        $pergantian->namabrg = $request->namabrg;
        $pergantian->jumlah = $request->jumlah;
        $pergantian->keterangan = $request->keterangan;
        $pergantian->save();

        return redirect()->route('pergantianadmin')->with('success', 'Data Berhasil Diupdate');
    }
    public function showPergantian($kodepergantian){
        $pergantian = Pergantian::where('kodepergantian', $kodepergantian)->firstOrFail();

        return view('pages.admin.pergantian.show', compact('pergantian'));
    }
    public function destroyPergantian($kodepergantian){
        $pergantian = Pergantian::where('kodepergantian', $kodepergantian)->firstOrFail();
        $pergantian->delete();

        return redirect()->route('pergantianadmin')->with('success', 'Data Berhasil Dihapus');
    }
    public function filterPergantian(Request $request){
        $isFiltered = false;
        $bulan = $request->input('bulan');

        $pergantianQuery = Pergantian::query();

        if ($bulan) {
            $pergantianQuery->whereMonth('tglpergantian', $bulan);
            $isFiltered = true;
        }

        $pergantian = $pergantianQuery->paginate(10);

        return view('pages.admin.pergantian.index', compact('pergantian','isFiltered'));
    }
    public function printPergantian(Request $request){
        $bulan = $request->input('bulan');

        if ($bulan) {
            $pergantian = Pergantian::whereMonth('tglpergantian', $bulan)->get();
            $title = "Laporan Pergantian Barang Bulan " . date('F', mktime(0, 0, 0, $bulan, 10));
        } else {
            $pergantian = Pergantian::all();
            $title = "Laporan Pergantian Barang";
        }
        $pdf = PDF::loadView('pages.admin.pergantian.print', compact('pergantian','title'))->setPaper('a4','landscape');

        return $pdf->stream('laporan-pergantianbarang.pdf');
    }
    /**
     * Barang Terbuang
     */
    public function indexBarangTerbuang(){
        $isFiltered = false;
        $barangterbuang = BarangTerbuang::orderBy('kodehapus','ASC')
        ->paginate(10);

        return view('pages.admin.penghapusan.index', compact('barangterbuang','isFiltered'));
    }
    public function createBarangTerbuang(){
        $bh = \App\Models\BarangTerbuang::latest()->first();
        $kode = "TRSH";
        $inventaris = "IVT";
        if($bh == null){
            $noUrut = "0001";
        }else{
            $explode = explode("-", $bh->kodehapus);
            $noUrut = intval($explode[0]);
            $noUrut = (int)substr($bh->kodehapus, 8, 4)+1;
            $noUrut = str_pad($noUrut, 4, "0", STR_PAD_LEFT);
        }
        $kodeHapus = "$kode-$inventaris".$noUrut;

        $barang = Barang::all();
        return view('pages.admin.penghapusan.create', compact('kodeHapus','barang'));
    }
    public function storeBarangTerbuang(Request $request){
        $barangterbuang = BarangTerbuang::create([
            'kodehapus'=> $request->kodehapus,
            'namabrg'=> $request->namabrg,
            'jumlah'=> $request->jumlah,
            'tglhapus'=> Carbon::now(),
            'status'=> $request->status,
        ]);
        $barang = Barang::where('namabrg', $barangterbuang->namabrg)->first();
        if ($barang) {
            $barang->stok -= $barangterbuang->jumlah;
            $barang->save();
        }
        return redirect()->route('barangterbuangadmin')-> with('success', 'Data berhasil ditambahkan');
    }
    public function editBarangTerbuang($kodehapus){
        $kategori = Kategori::all();
        $barang = Barang::all();

        $barangterbuang = BarangTerbuang::where('kodehapus', $kodehapus)->firstOrFail();

        return view('pages.admin.penghapusan.edit', compact('barangterbuang','kategori','barang'));
    }
    public function updateBarangTerbuang(Request $request, $kodehapus){
        $barangterbuang = BarangTerbuang::where('kodehapus', $kodehapus)->firstOrFail();
        $barangterbuang->namabrg = $request->namabrg;
        $barangterbuang->jumlah = $request->jumlah;
        $barangterbuang->status = $request->status;
        $barangterbuang->save();

        return redirect()->route('barangterbuangadmin')->with('success', 'Data Berhasil Diupdate');
    }
    public function destroyBarangTerbuang($kodehapus){
        $barangterbuang = BarangTerbuang::where('kodehapus', $kodehapus)->firstOrFail();
        $barangterbuang->delete();

        return redirect()->route('barangterbuangadmin')->with('success', 'Data Berhasil Dihapus');
    }
    public function filterBarangTerbuang(Request $request){
        $isFiltered = false;
        $bulan = $request->input('bulan');

        $terbuangQuery = BarangTerbuang::query();

        if ($bulan) {
            $terbuangQuery->whereMonth('tglhapus', $bulan);
            $isFiltered = true;
        }

        $barangterbuang = $terbuangQuery->paginate(10);

        return view('pages.admin.penghapusan.index', compact('barangterbuang','isFiltered'));
    }
    public function shoewBarangTerbuang($kodehapus){
        $barangterbuang = BarangTerbuang::where('kodehapus', $kodehapus)->firstOrFail();

        return view('pages.admin.penghapusan.show', compact('barangterbuang'));
    }
    public function printBarangTerbuang(Request $request){
        $bulan = $request->input('bulan');

        if ($bulan) {
            $barangterbuang = BarangTerbuang::whereMonth('tglhapus', $bulan)->get();
            $title = "Laporan Penghapusan Barang Bulan " . date('F', mktime(0, 0, 0, $bulan, 10));
        } else {
            $barangterbuang = BarangTerbuang::all();
            $title = "Laporan Penghapusan Barang";
        }
        $pdf = PDF::loadView('pages.admin.penghapusan.print', compact('barangterbuang','title'))->setPaper('a4','landscape');

        return $pdf->stream('laporan-penghapusanbarang.pdf');
    }
}
