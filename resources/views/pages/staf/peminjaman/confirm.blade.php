@extends('layouts.staf.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Konfirmasi Peminjaman Barang</h2>
        <form action="/staf/updatekonfirmasipeminjaman/{{$peminjaman->kodepeminjaman}}" method="POST">
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
                    <input type="date" name="tglpengembalian" class="form-control" value="{{$peminjaman->tglpengembalian}}" readonly>
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
                <label class> Barang yang dipinjamkan </label>
                <select class="form-select " name="namabrg">
                    <option value="" disabled selected hidden>Pilih Barang</option>
                    @foreach ($barang as $item)
                    <option value="{{$item->namabrg}}">{{ $item->namabrg}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group w-25 mt-2 p-2">
                <input type="submit" value="Konfirmasi" class="btn btn-outline-primary">
            </div>
        </form>
    </div>
</div>
@endsection
