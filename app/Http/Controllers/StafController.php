<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangRusak;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Permintaan;
use App\Models\Pergantian;
use App\Models\Penempatan;

class StafController extends Controller
{
    public function indexBarangRusak(){
        $isFiltered = false;
        $barangrusak = BarangRusak::where('status', 'sedang diproses')
        ->orWhere('status', 'selesai')
        ->orderBy('kodelaporan', 'ASC')
        ->paginate(10);

        return view('pages.staf.barangrusak.index',compact('barangrusak', 'isFiltered'));
    }
    public function showBarangRusak($kodelaporan){
        $barangrusak = BarangRusak::where('kodelaporan', $kodelaporan)->firstOrFail();

        return view('pages.staf.barangrusak.show', compact('barangrusak'));
    }
    public function confirmBarangRusak($kodelaporan){
        $barangrusak = BarangRusak::where('kodelaporan', $kodelaporan)->firstOrFail();

        return view('pages.staf.barangrusak.confirm', compact('barangrusak'));
    }
    public function updateConfirmBarangRusak(Request $request, $kodelaporan){
        $barangrusak = BarangRusak::where('kodelaporan', $kodelaporan)->firstOrFail();
        $barangrusak->penanganan = $request->penanganan;
        if (auth()->user()->role === 'staf') {
            if ($barangrusak->status === 'sedang diproses') {
                $barangrusak->status = 'selesai';
            }
        }
        $barangrusak->save();

        return redirect()->route('barangrusakstaf')->with('success', 'Data Telah Dikonfirmasi');
    }
    public function searchBarangRusak(Request $request){
        $query = $request->input('cari');

        if ($query) {
            $barangrusak = BarangRusak::where('kodelaporan', 'like', '%' . $query . '%')
                ->orWhere('namabrg', 'like', '%' . $query . '%')
                ->paginate(10);
            $isFiltered = true;
        } else {
            $barangrusak = BarangRusak::paginate(10);
            $isFiltered = false; // Tidak ada pencarian
        }
        return view('pages.staf.barangrusak.index', compact('barangrusak','isFiltered'));
    }
    /**
   * Penempatan Barang
   */
  public function indexPenempatan(){
    $isFiltered = false;
    $penempatan = Penempatan::orderBy('kodepenempatan','ASC')
    ->paginate(10);

    return view('pages.staf.penempatan.index', compact('penempatan', 'isFiltered'));
  }
  public function updateConfirmPenempatan(Request $request, $kodepenempatan){
    $penempatan = Penempatan::where('kodepenempatan', $kodepenempatan)->firstOrFail();
    $penempatan->status='ceklis';
    $penempatan->save();

    return redirect()->route('penempatanstaff')->with('success','Penempatan Barang Telah Diselesaikan');
  }
  public function searchPenempatan(Request $request){
    $query = $request->input('cari');

        if ($query) {
           $penempatan = Penempatan::where('kodepenempatan', 'like', '%' . $query . '%')
                ->orWhere('ruangan', 'like', '%' . $query . '%')
                ->paginate(10);
            $isFiltered = true;
        } else {
            $penempatan = Penempatan::paginate(10);
            $isFiltered = false; // Tidak ada pencarian
        }
        return view('pages.staf.penempatan.index', compact('penempatan', 'isFiltered'));
  }
    /**
     * Peminjaman Barang
     */
    public function indexPeminjamanBarang(){
        $isFiltered = false;
        $peminjaman = Peminjaman::whereIn('status', ['sedang diproses', 'selesai','ceklis'])
        ->orderBy('kodepeminjaman', 'ASC')
        ->paginate(10);

        return view('pages.staf.peminjaman.index', compact('peminjaman', 'isFiltered'));
    }
    public function confirmPeminjaman($kodepeminjaman){
        $barang = Barang::all();
        $peminjaman = Peminjaman::where('kodepeminjaman', $kodepeminjaman)->firstOrFail();

        return view('pages.staf.peminjaman.confirm', compact('peminjaman','barang'));
    }
    public function updateConfirmPeminjamanBarang(Request $request, $kodepeminjaman){
        $peminjaman = Peminjaman::where('kodepeminjaman', $kodepeminjaman)->firstOrFail();
        $peminjaman->namabrg = $request->namabrg;
        $peminjaman->status='ceklis';
        $peminjaman->save();

        return redirect()->route('peminjamanbarangstaf')->with('success', 'Data Telah Dikonfirmasi');
    }
    public function searchPeminjaman(Request $request){
        $query = $request->input('cari');

        if ($query) {
            $peminjaman = Peminjaman::where('barangpinjam', 'like', '%' . $query . '%')
                ->orWhere('ruangan', 'like', '%' . $query . '%')
                ->paginate(10);
            $isFiltered = true;
        } else {
            $peminjaman = Peminjaman::paginate(10);
            $isFiltered = false; // Tidak ada pencarian
        }
        return view('pages.staf.peminjaman.index',compact('peminjaman', 'isFiltered'));
    }
    /**
     * Pengembalian Barang
     */
    public function indexPengembalianBarang(){
        $isFiltered = false;
        $peminjaman = Peminjaman::whereIn('status',['ceklis','selesai'])
        ->orderBy('kodepeminjaman', 'ASC')
        ->paginate(10);

        return view('pages.staf.pengembalian.index', compact('peminjaman','isFiltered'));
    }
    public function updateConfirmPengembalianBarang(Request $request, $kodepeminjaman){
        $peminjaman = Peminjaman::where('kodepeminjaman', $kodepeminjaman)->firstOrFail();

        $peminjaman->tglkembali = Carbon::now();
        $peminjaman->statuskembali='selesai';
        $peminjaman->save();

        $barang = Barang::where('namabrg', $peminjaman->namabrg)->first();
        if ($barang) {
            $barang->stok += $peminjaman->jumlah;
            $barang->save();
        }
        return redirect()->route('pengembalianstaf')->with('success', 'Barang Telah Dikembalikan');
    }
    public function searchPengembalian(Request $request){
        $query = $request->input('cari');

        if ($query) {
            $peminjaman = Peminjaman::where('kodepeminjaman', 'like', '%' . $query . '%')
                ->orWhere('ruangan', 'like', '%' . $query . '%')
                ->paginate(10);
            $isFiltered = true;
        } else {
            $peminjaman = Peminjaman::paginate(10);
            $isFiltered = false; // Tidak ada pencarian
        }
        return view('pages.staf.peminjaman.index',compact('peminjaman', 'isFiltered'));
    }
    /**
     * Permintaan Barang
     */
    public function indexPermintaanBarang(){
        $isFiltered = false;
        $permintaan = Permintaan::whereIn('status',['sedang diproses','ceklis','selesai'])
        ->orderBy('kodepermintaan', 'ASC')
        ->paginate('10');

        return view('pages.staf.permintaan.index', compact('permintaan','isFiltered'));
    }
    public function confrimPermintaanBarang($kodepermintaan){
        $permintaan = Permintaan::where('kodepermintaan', $kodepermintaan)->firstOrFail();

        return view('pages.staf.permintaan.confirm', compact('permintaan'));
    }
    public function updateConfirmPermintaanBarang(Request $request, $kodepermintaan){
        $permintaan = Permintaan::where('kodepermintaan', $kodepermintaan)->firstOrFail();
        $permintaan->status='ceklis';
        $permintaan->save();

        return redirect()->route('permintaanstaf')->with('success', 'Permintaan Telah Diselesaikan');
    }
    public function searchPermintaan(Request $request){
        $query = $request->input('cari');

        if ($query) {
            $permintaan = Permintaan::where('kodepermintaan', 'like', '%' . $query . '%')
                ->orWhere('ruangan', 'like', '%' . $query . '%')
                ->paginate(10);
            $isFiltered = true;
        } else {
            $permintaan = Permintaan::paginate(10);
            $isFiltered = false; // Tidak ada pencarian
        }
        return view('pages.staf.permintaan.index',compact('permintaan', 'isFiltered'));
    }

    /**
     * Pergantian Barang
     */
    public function indexPergantianBarang(){
        $isFiltered = false;
        $pergantian = Pergantian::whereNull('status')
        ->orWhereIn('status', ['ceklis','selesai'])
        ->orderBy('kodepergantian', 'ASC')
        ->paginate(10);

        return view('pages.staf.pergantian.index', compact('pergantian', 'isFiltered'));
    }
    public function updateConfirmPergantian(Request $request, $kodepergantian){
        $pergantian = Pergantian::where('kodepergantian', $kodepergantian)->firstOrFail();
        $pergantian->tglpergantian = Carbon::now();
        $pergantian->status='ceklis';
        $pergantian->save();

        return redirect()->route('pergantianstaf')->with('success', 'Pergantian Barang Telah Diselesaikan');
    }
    public function searchPergantian(Request $request){
        $query = $request->input('cari');

        if ($query) {
            $pergantian = Pergantian::where('ruangan', 'like', '%' . $query . '%')
                ->orWhere('kodepergantian', 'like', '%' . $query . '%')
                ->paginate(10);
            $isFiltered = true;
        } else {
            $pergantian = Pergantian::paginate(10);
            $isFiltered = false; // Tidak ada pencarian
        }
        return view('pages.staf.pergantian.index',compact('pergantian', 'isFiltered'));
    }
}
