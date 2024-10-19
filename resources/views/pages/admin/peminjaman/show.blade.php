@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <div class="mb-3 mt-2">
            <a href="{{route('peminjamanadmin')}}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        </div>
        <h2>Detail Pengajuan Peminjaman Barang</h2>
            @method('PUT')
            <div class="row">
                <div class="col">
                    <label>Kode Peminjaman</label>
                    <input type="text" name="kodepeminjaman" class="form-control" value="{{$peminjaman->kodepeminjaman}}" readonly>
                </div>
                <div class="col">
                    <label> Ruangan</label>
                    <input type="text" name="ruangan" class="form-control" value="{{$peminjaman->ruangan}}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Tanggal Peminjaman</label>
                        <input type="date" name="tglpinjam" class="form-control" value="{{$peminjaman->tglpinjam}}" readonly>
                </div>
                <div class="col">
                    <label> Tanggal Pengembalian</label>
                    <input type="text" name="tglkembali" class="form-control" value="{{$peminjaman->tglkembali}}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label> Nama Barang </label>
                    <input type="text" name="barangpinjam" class="form-control" value="{{$peminjaman->barangpinjam}}" readonly>
                </div>
                <div class="col">
                    <label> Jumlah </label>
                    <input type="text" name="jumlah" class="form-control" value="{{$peminjaman->jumlah}}" readonly>
                </div>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Spesifikasi</label>
                <textarea class="form-control" name="spesifikasi" rows="5" readonly>{{$peminjaman->spesifikasi}}</textarea>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Keperluan dan Lama Penggunaan Barang</label>
                <textarea class="form-control" name="keperluan" rows="5" readonly>{{$peminjaman->keperluan}}</textarea>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Barang Pinjam</label>
                <input type="text" name="barangpinjam" class="form-control" value="{{$peminjaman->namabrg}}" readonly>
            </div>
        </form>
    </div>
</div>
@endsection
