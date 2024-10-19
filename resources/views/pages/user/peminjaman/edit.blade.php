@extends('layouts.user.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Edit Pengajuan Peminjaman Barang</h2>
        <form action="/user/updatepeminjaman/{{$peminjaman->kodepeminjaman}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Kode Peminjaman</label>
                <input type="text" name="kodepeminjaman" class="form-control" value="{{$peminjaman->kodepeminjaman}}" readonly>
            </div>
            <div class="row">
                <div class="col">
                    <label>Tanggal Peminjaman</label>
                        <input type="date" name="tglpinjam" class="form-control" value="{{$peminjaman->tglpinjam}}">
                </div>
                <div class="col">
                    <label> Ruangan</label>
                    <select class="form-select " name="ruangan" value="{{$peminjaman->ruangan}}">
                        @foreach ($ruangan as $item)
                        <option value="{{$item->namaruang}}">{{$item->namaruang}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label> Nama Barang </label>
                    <input type="text" name="barangpinjam" class="form-control" value="{{$peminjaman->namabrg}}">
                </div>
                <div class="col">
                    <label> Jumlah </label>
                    <input type="number" name="jumlah" class="form-control" value="{{$peminjaman->jumlah}}">
                </div>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Spesifikasi</label>
                <textarea class="form-control" name="spesifikasi" placeholder="Spesifikasi barang yang dibutuhkan" rows="5">{{$peminjaman->spesifikasi}}</textarea>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Keperluan dan Lama Penggunaan Barang</label>
                <textarea class="form-control" name="keperluan" placeholder="Keperluan peminjaman barang" rows="5">{{$peminjaman->keperluan}}</textarea>
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
