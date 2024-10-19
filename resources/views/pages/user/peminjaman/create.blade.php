@extends('layouts.user.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Peminjaman Barang</h2>
        <form action="/user/simpanpeminjamanbarang" method="POST">
            @csrf
            <div class="mb-3">
                <label>Kode Peminjaman</label>
                <input type="text" name="kodepeminjaman" class="form-control" value="{{$kodePeminjaman}}" readonly>
            </div>
            <div class="row">
                <div class="col">
                    <label>Tanggal Peminjaman</label>
                        <input type="date" name="tglpinjam" class="form-control" required>
                </div>
                <div class="col">
                    <label> Ruangan</label>
                    <select class="form-select " name="ruangan">
                        <option value="" disabled selected hidden>Pilih Ruangan</option>
                        @foreach ($ruangan as $item )
                        <option value="{{$item->namaruang}}">{{$item->namaruang}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label> Nama Barang </label>
                    <input type="text" name="barangpinjam" class="form-control" required>
                </div>
                <div class="col">
                    <label> Jumlah </label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Spesifikasi</label>
                <textarea class="form-control" name="spesifikasi" placeholder="Spesifikasi barang yang dibutuhkan" rows="5" required></textarea>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Keperluan dan Lama Penggunaan</label>
                <textarea class="form-control" name="keperluan" placeholder="Keperluan peminjaman barang" rows="5" required></textarea>
            </div>
            <div class="form-group w-25 mt p-2">
                <input type="submit" value="Simpan" class="btn btn-outline-primary">
            </div>
            <div class="mb-3 mt-2">
                <h6 class="mb-4 text-gray-350 fw-bold"> Notes:
                    <br> Tidak menuliskan keperluan maka barang hanya dapat dipinjam selama 3 hari
                </h6>
            </div>
        </form>
    </div>
</div>
@endsection
