@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Konfirmasi Peminjaman Barang</h2>
        <form action="/admin/updatekonfirmasipeminjaman/{{$peminjaman->kodepeminjaman}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Kode Peminjaman</label>
                <input type="text" name="kodepeminjaman" class="form-control" value="{{$peminjaman->kodepeminjaman}}" readonly>
            </div>
            <div class="row">
                <div class="col">
                    <label>Tanggal Peminjaman</label>
                        <input type="date" name="tglpinjam" class="form-control"  value="{{$peminjaman->tglpinjam}}"readonly>
                </div>
                <div class="col">
                    <label> Tanggal Pengembalian </label>
                    <input type="date" name="tglpengembalian" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label> Ruangan </label>
                <input type="text" name="ruangan" class="form-control"  value="{{$peminjaman->ruangan}}"readonly>
            </div>
            <div class="row">
                <div class="col">
                    <label> Nama Barang </label>
                    <input type="text" name="namabrg" class="form-control"  value="{{$peminjaman->barangpinjam}}"readonly>
                </div>
                <div class="col">
                    <label> Jumlah </label>
                    <input type="number" name="jumlah" class="form-control" value="{{$peminjaman->jumlah}}" readonly>
                </div>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Spesifikasi</label>
                <textarea class="form-control" name="spesifikasi" rows="5" readonly>{{$peminjaman->spesifikasi}}</textarea>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Keperluan dan Lama Penggunaan</label>
                <textarea class="form-control" name="keperluan" rows="5" readonly>{{$peminjaman->keperluan}}</textarea>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Catatan</label>
                <textarea class="form-control" name="catatan" rows="5" placeholder="Catatan Penolakan Peminjaman"></textarea>
            </div>
            <div class="form-group w-25 mt-2 p-2">
                <input type="submit" name="action" value="Konfirmasi" class="btn btn-outline-primary">
                <input type="submit" name="action" value="Ditolak" class="btn btn-outline-danger">
            </div>
        </form>
    </div>
</div>
@endsection
