@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Pembelian Barang</h2>
        <form action="/admin/simpanpembelian" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <label>Kode Pembelian</label>
                    <input type="text" name="kodepembelian" class="form-control" value="{{$kodePembelian}}" readonly>
                </div>
                <div class="col">
                <label>Tanggal Pembelian</label>
                    <input type="date" name="tglbeli" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Nama Barang</label>
                    <input type="text" name="namabrg" class="form-control" required>
                </div>
                <div class="col">
                <label>jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="form-label">Nama Vendor</label>
                    <select class="form-select " name="vendor">
                        <option value="" disabled selected hidden>Pilih Vendor</option>
                        @foreach ($vendor as $item)
                        <option value="{{$item->namavendor}}">{{ $item->namavendor}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>Biaya</label>
                        <input type="text" name="harga" class="form-control" required>
                    </div>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Spesifikasi</label>
                <textarea class="form-control" name="spesifikasi" placeholder="Spesifikasi Barang" rows="3" required></textarea>
            </div>
            <div class="form-group w-25 mt-2 p-2">
                <input type="submit" value="Simpan" class="btn btn-outline-primary">
            </div>
        </form>
    </div>
</div>
@endsection
