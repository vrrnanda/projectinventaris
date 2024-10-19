<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penempatan;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\BarangRusak;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Permintaan;
use App\Models\Pergantian;

class UserController extends Controller
{
    public function indexBarang(){
        $user = Auth::user();

        if (empty($user->ruangan)) {
            return redirect()->back()->with('error', 'Ruangan tidak ditemukan untuk pengguna ini.');
        }

        $ruanganNama = $user->ruangan; // Ambil nama ruangan langsung dari kolom 'ruangan'

        // Ambil data barang berdasarkan nama ruangan
        $penempatan = Penempatan::join('barang', 'penempatan.namabrg', '=', 'barang.namabrg')
        ->where('penempatan.ruangan', $ruanganNama) // Menggunakan nama ruangan dari session
        ->orderBy('barang.kodebrg', 'ASC') // Memastikan menggunakan kodebrg dari tabel barang
        ->select('penempatan.*', 'barang.kodebrg')
        ->paginate(10);

        return view('pages.user.barang.index', compact('penempatan'));
    }
    public function showBarang($kodebrg)
    {
        $barang = Barang::where('kodebrg', $kodebrg)->firstOrFail();
        return view('pages.user.barang.show', compact('barang'));
    }

    /**
     * Barang Rusak
     */
    public function indexBarangRusak(){
        $user = Auth::user();
        $isFiltered = false;

        if (empty($user->ruangan)) {
            return redirect()->back()->with('error', 'Ruangan tidak ditemukan untuk pengguna ini.');
        }
        $ruanganNama = $user->ruangan;
        $barangrusak = BarangRusak::orderBy('kodelaporan', 'ASC')
        ->where('ruangan', $ruanganNama)
        ->paginate(10);

        return view('pages.user.barangrusak.index',compact('barangrusak','isFiltered'));
    }
    public function createBarangRusak(){
        $br = \App\Models\BarangRusak::latest()->first();
        $kode = "BR";
        $inventaris = "IVT";

        if ($br == null) {
            $noUrut = "0001";
        } else {
            $explode = explode("-", $br->kodelaporan);
            $noUrut = intval($explode[0]);
            $noUrut = (int)substr($br->kodelaporan, 6, 4) + 1;
            $noUrut = str_pad($noUrut, 4, "0", STR_PAD_LEFT);
        }

        $kodeLaporan = "$kode-$inventaris" . $noUrut;
        $ruanganList = Ruangan::all();
        $barang = Barang::all();

        return view('pages.user.barangrusak.create', compact('kodeLaporan','barang','ruanganList'));
    }
    public function storeBarangRusak(Request $request)
    {
        BarangRusak::create([
            'kodelaporan'=> $request->kodelaporan,
            'tgllaporan'=> $request->tgllaporan,
            'ruangan'=> $request->ruangan,
            'namabrg'=> $request->namabrg,
            'deskripsi'=>$request->deskripsi,
            'status'=> 'sedang diproses'
        ]);
        return redirect()->route('barangrusakguser')-> with('success', 'Data berhasil ditambahkan');
    }
    public function editBarangRusak($kodelaporan){
        $barangrusak = BarangRusak::where('kodelaporan', $kodelaporan)->firstOrFail();
        $barang = Barang::all();
        $ruangan = Ruangan::all();
        return view('pages.user.barangrusak.edit', compact('barangrusak','barang','ruangan'));
    }
    public function updateBarangRusak(Request $request, $kodelaporan)
    {
        $ruangan = Ruangan::all();
        $barang = Barang::all();
        $barangrusak = BarangRusak::where('kodelaporan', $kodelaporan)->firstOrFail();
        $barangrusak->tgllapor = $request->tgllapor;
        $barangrusak->ruangan = $request->ruangan;
        $barangrusak->namabrg = $request->namabrg;
        $barangrusak->deskripsi = $request->deskripsi;
        $barangrusak->save();

        return redirect()->route('barangrusakguser', compact('barangrusak','ruangan','barang'))->with('success', 'Data berhasil diupdate!');
    }
    public function destroyBarangRusak($kodelaporan)
    {
        $barangrusak = BarangRusak::where('kodelaporan', $kodelaporan)->firstOrFail();
        $barangrusak->delete();
        return redirect()->route('barangrusakguser')->with('success', 'Data berhasil dihapus!');
    }
    public function showBarangRusak($kodelaporan)
    {
        $barangrusak = BarangRusak::where('kodelaporan', $kodelaporan)->firstOrFail();

        return view('pages.user.barangrusak.show', compact('barangrusak'));
    }
    public function searchBarangRusak(Request $request){
        $query = $request->input('cari');

        if ($query) {
            $barangrusak = BarangRusak::where('ruangan', 'Unit Gawat Darurat(UGD)') // Filter berdasarkan ruangan UGD
                ->where(function($q) use ($query) {
                    $q->where('kodelaporan', 'like', '%' . $query . '%')
                      ->orWhere('namabrg', 'like', '%' . $query . '%');
                })
                ->paginate(10);
            $isFiltered = true;
        } else {
            $barangrusak = BarangRusak::where('ruangan', 'Unit Gawat Darurat(UGD)') // Tampilkan hanya barang di ruangan UGD
                ->paginate(10);
            $isFiltered = false;
        }
        return view('pages.user.barangrusak.index', compact('barangrusak','isFiltered'));
    }
    /**
     * Penempatan Barang
     */
    public function indexPenempatan(){
        $user = Auth::user();
        $isFiltered = false;

        if (empty($user->ruangan)) {
            return redirect()->back()->with('error', 'Ruangan tidak ditemukan untuk pengguna ini.');
        }
        $ruanganNama = $user->ruangan;
        $penempatan = Penempatan::orderBy('kodepenempatan', 'ASC')
        ->where('ruangan', $ruanganNama)
        ->paginate(10);

        return view('pages.user.penempatan.index', compact('isFiltered','penempatan'));
    }
    public function updateConfirmPenempatan(Request $request, $kodepenempatan){
        $penempatan = Penempatan::where('kodepenempatan', $kodepenempatan)->firstOrFail();
        $penempatan->tglpenempatan = Carbon::now();
        $penempatan->status = 'selesai';
        $penempatan->save();
        $barang = Barang::where('namabrg', $penempatan->namabrg)->first();
        if ($barang) {
            $barang->stok -= $penempatan->jumlah;
            $barang->save();
        }
        return redirect()->route('penempatanuser')->with('success', 'Barang Telah Ditempatkan');
    }
    /**
     * Peminjaman Barang
     */
    public function indexPeminjamanBarang(){
        $user = Auth::user();
        $isFiltered = false;

        if (empty($user->ruangan)) {
            return redirect()->back()->with('error', 'Ruangan tidak ditemukan untuk pengguna ini.');
        }
        $ruanganNama = $user->ruangan;
        $peminjaman = Peminjaman::orderBy('kodepeminjaman', 'ASC')
        ->where('ruangan', $ruanganNama)
        ->paginate(10);

        return view('pages.user.peminjaman.index',compact('peminjaman', 'isFiltered'));
    }
    public function createPeminjamanBarang(){
        $p = \App\Models\Peminjaman::latest()->first();
        $kode = "PNJ";
        $barang = "IVT";
        if($p == null){
            $noUrut = "0001";
        }else{
            $explode = explode("-", $p->kodepeminjaman);
            $noUrut = intval($explode[0]);
            $noUrut = (int)substr($p->kodepeminjaman, 7, 4)+1;
            $noUrut = str_pad($noUrut, 4, "0", STR_PAD_LEFT);
        }
        $kodePeminjaman = "$kode-$barang".$noUrut;
        $ruangan = Ruangan::all();
        $barang = Barang::all();

        return view('pages.user.peminjaman.create', compact('kodePeminjaman','ruangan','barang'));
    }
    public function storePeminjamanBarang(Request $request){
        $peminjaman = Peminjaman::create([
            'kodepeminjaman'=> $request->kodepeminjaman,
            'tglpinjam'=> $request->tglpinjam,
            'ruangan'=> $request->ruangan,
            'barangpinjam'=> $request->barangpinjam,
            'jumlah'=> $request->jumlah,
            'spesifikasi'=> $request->spesifikasi,
            'keperluan'=> $request->keperluan,
            'status'=>null,
            'tglterima'=>null
        ]);
        return redirect()->route('pinjambaranguser')-> with('success', 'Data berhasil ditambahkan');
    }
    public function updateConfirmPeminjaman(Request $request, $kodepeminjaman){
        $peminjaman = Peminjaman::where('kodepeminjaman', $kodepeminjaman)->firstOrFail();
        $peminjaman->status='selesai';
        $peminjaman->tglterima = Carbon::now();
        $peminjaman->save();

        $barang = Barang::where('namabrg', $peminjaman->namabrg)->first();
        if ($barang) {
            $barang->stok -= $peminjaman->jumlah;
            $barang->save();
        }
        return redirect()->route('pinjambaranguser')->with('success', 'Barang Telah Diterima');
    }
    public function editPeminjaman($kodepeminjaman){
        $ruangan = Ruangan::all();
        $peminjaman = Peminjaman::where('kodepeminjaman', $kodepeminjaman)->firstOrFail();

        return view('pages.user.peminjaman.edit',compact('peminjaman', 'ruangan'));
    }
    public function updatePeminjaman(Request $request, $kodepeminjaman){
        $ruangan = Ruangan::all();
        $peminjaman = Peminjaman::where('kodepeminjaman', $kodepeminjaman)->firstOrFail();
        $peminjaman->tglpinjam = $request->tglpinjam;
        $peminjaman->ruangan = $request->ruangan;
        $peminjaman->namabrg = $request->namabrg;
        $peminjaman->spesifikasi = $request->spesifikasi;
        $peminjaman->jumlah = $request->jumlah;
        $peminjaman->keperluan = $request->keperluan;
        $peminjaman->save();

        return redirect()->route('pinjambaranguser', compact('peminjaman','ruangan'))->with('success', 'Data berhasil diupdate');
    }
    public function showPeminjaman($kodepeminjaman){
        $peminjaman = Peminjaman::where('kodepeminjaman', $kodepeminjaman)->firstOrFail();

        return view('pages.user.peminjaman.show', compact('peminjaman'));
    }
    public function destroyPeminjaman($kodepeminjaman){
        $peminjaman = Peminjaman::where('kodepeminjaman', $kodepeminjaman)->firstOrFail();
        $peminjaman->delete();

        return redirect()->route('pinjambaranguser')->with('success','Data berhasil dihapus');
    }
    public function searchPeminjaman(Request $request){
        $query = $request->input('cari');
        if ($query) {
            $peminjaman = Peminjaman::where('ruangan', 'Unit Gawat Darurat(UGD)')
                ->where(function($q) use ($query) {
                    $q->where('kodepeminjaman', 'like', '%' . $query . '%')
                      ->orWhere('barangpinjam', 'like', '%' . $query . '%');
                })
                ->paginate(10);
            $isFiltered = true;
        } else {
            $peminjaman = Peminjaman::where('ruangan', 'Unit Gawat Darurat(UGD)')
            ->paginate(10);
            $isFiltered = false;
        }
        return view('pages.user.peminjaman.index', compact('peminjaman','isFiltered'));
    }
    /**
     * Pengembalian Barang
     */
    public function indexPengembalianBarang(){
        $user = Auth::user();
        $isFiltered = false;

        if (empty($user->ruangan)) {
            return redirect()->back()->with('error', 'Ruangan tidak ditemukan untuk pengguna ini.');
        }

        $ruanganNama = $user->ruangan;
        $peminjaman = Peminjaman::where('ruangan', $ruanganNama)
        ->where(function($query) {
            $query->where('status', 'selesai')
                  ->orWhereNull('tglterima');
        })
            ->orderBy('kodepeminjaman', 'ASC')
            ->paginate(10);

        return view('pages.user.pengembalian.index',compact('peminjaman', 'isFiltered'));
    }
    public function searchPengembalian(Request $request){
        $query = $request->input('cari');
        if ($query) {
            $peminjaman = Peminjaman::where('ruangan', 'Unit Gawat Darurat(UGD)')
                ->where(function($q) use ($query) {
                    $q->where('barangpinjam', 'like', '%' . $query . '%')
                      ->orWhere('namabrg', 'like', '%' . $query . '%');
                })
                ->paginate(10);
            $isFiltered = true;
        } else {
            $peminjaman = Peminjaman::where('ruangan', 'Unit Gawat Darurat(UGD)')
            ->paginate(10);
            $isFiltered = false;
        }
        return view('pages.user.pengembalian.index', compact('peminjaman','isFiltered'));
    }
    /**
     * Permintaan Barang
     */
    public function indexPermintaanBarang(){
        $user = Auth::user();
        $isFiltered = false;

        if (empty($user->ruangan)) {
            return redirect()->back()->with('error', 'Ruangan tidak ditemukan untuk pengguna ini.');
        }
        $ruanganNama = $user->ruangan;
        $permintaan = Permintaan::orderBy('kodepermintaan', 'ASC')
        ->where('ruangan', $ruanganNama)
        ->paginate(10);

        return view('pages.user.permintaan.index', compact('permintaan','isFiltered'));
    }
    public function createPermintaanBarang(){
        $pm = \App\Models\Permintaan::latest()->first();
        $kode = "ORD";
        $inventaris = "IVT";
        if($pm == null){
            $noUrut = "0001";
        }else{
            $explode = explode("-", $pm->kodepermintaan);
            $noUrut = intval($explode[0]);
            $noUrut = (int)substr($pm->kodepermintaan, 7, 4)+1;
            $noUrut = str_pad($noUrut, 4, "0", STR_PAD_LEFT);
        }
        $kodePermintaan = "$kode-$inventaris".$noUrut;
        $ruangan = Ruangan::all();

        return view('pages.user.permintaan.create', compact('kodePermintaan','ruangan'));
    }
    public function storePermintaanBarang(Request $request){
        $permintaan = Permintaan::create([
            'kodepermintaan'=> $request->kodepermintaan,
            'tglpermintaan'=> $request->tglpermintaan,
            'ruangan'=> $request->ruangan,
            'namabrg'=> $request->namabrg,
            'jumlah'=> $request->jumlah,
            'keterangan'=> $request->keterangan,
            'status'=>null
        ]);
        return redirect()->route('permintaanuser')-> with('success', 'Data berhasil ditambahkan');
    }
    public function confirmPermintaanBarang($kodepermintaan){
        $permintaan = Permintaan::where('kodepermintaan', $kodepermintaan)->firstOrFail();
        $permintaan->tglterima = Carbon::now();
        $permintaan->status='selesai';
        $permintaan->save();

        return redirect()->route('permintaanuser')->with('success', 'Barang Telah Diterima');
    }
    public function editPermintaan($kodepermintaan){
        $ruangan = Ruangan::all();
        $permintaan = Permintaan::where('kodepermintaan', $kodepermintaan)->firstOrFail();

        return view('pages.user.permintaan.edit',compact('permintaan','ruangan'));
    }
    public function updatePermintaan(Request $request, $kodepermintaan){
        $permintaan = Permintaan::where('kodepermintaan', $kodepermintaan)->firstOrFail();
        $permintaan->tglpermintaan = $request->tglpermintaan;
        $permintaan->namabrg = $request->namabrg;
        $permintaan->jumlah = $request->jumlah;
        $permintaan->ruangan = $request->ruangan;
        $permintaan->keterangan = $request->keterangan;
        $permintaan->save();

        return redirect()->route('permintaanuser')->with('success', 'Data Berhasil Diupdate');
    }
    public function destroyPermintaan($kodepermintaan){
        $permintaan = Permintaan::where('kodepermintaan', $kodepermintaan)->firstOrFail();
        $permintaan->delete();

        return redirect()->route('permintaanuser')->with('success','Data Berhasil Dihapus');
    }
    public function showPermintaan($kodepermintaan){
        $permintaan = Permintaan::where('kodepermintaan', $kodepermintaan)->firstOrFail();

        return view('pages.user.permintaan.show',compact('permintaan'));
    }
    public function searchPermintaan(Request $request){
        $query = $request->input('cari');
        if ($query) {
            $permintaan = Permintaan::where('ruangan', 'Unit Gawat Darurat(UGD)')
                ->where(function($q) use ($query) {
                    $q->where('kodepermintaan', 'like', '%' . $query . '%')
                      ->orWhere('namabrg', 'like', '%' . $query . '%');
                })
                ->paginate(10);
            $isFiltered = true;
        } else {
            $permintaan = Permintaan::where('ruangan', 'Unit Gawat Darurat(UGD)')
            ->paginate(10);
            $isFiltered = false;
        }

        return view('pages.user.permintaan.index', compact('permintaan', 'isFiltered'));
    }
    /**
     * Pergantian Barang
     */
    public function indexPergantianBarang(){
        $user = Auth::user();
        $isFiltered = false;

        if (empty($user->ruangan)) {
            return redirect()->back()->with('error', 'Ruangan tidak ditemukan untuk pengguna ini.');
        }
        $ruanganNama = $user->ruangan;
        $pergantian = Pergantian::orderBy('kodepergantian', 'ASC')
        ->where('ruangan', $ruanganNama)
        ->paginate(10);


        return view('pages.user.pergantian.index', compact('pergantian', 'isFiltered'));
    }
    public function updateConfirmPergantian(Request $request, $kodepergantian){
        $pergantian = Pergantian::where('kodepergantian', $kodepergantian)->firstOrFail();
        $pergantian->tglterima = Carbon::now();
        $pergantian->status='selesai';
        $pergantian->save();

        $barang = Barang::where('namabrg', $request->namabrg)->first();
        if ($barang) {
            $barang->stok -= $request->jumlah;
            $barang->save();
        }

        return redirect()->route('pergantianuser')->with('success', 'Pergantian Barang Telah Diterima');
    }
    public function searchPergantian(Request $request){
        $query = $request->input('cari');

        $query = $request->input('cari');
        if ($query) {
            $pergantian = Pergantian::where('ruangan', 'Unit Gawat Darurat(UGD)')
                ->where(function($q) use ($query) {
                    $q->where('kodepergantian', 'like', '%' . $query . '%')
                      ->orWhere('namabrg', 'like', '%' . $query . '%');
                })
                ->paginate(10);
            $isFiltered = true;
        } else {
            $pergantian = Pergantian::where('ruangan', 'Unit Gawat Darurat(UGD)')
            ->paginate(10);
            $isFiltered = false;
        }

        return view('pages.user.pergantian.index', compact('pergantian', 'isFiltered'));
    }
}
