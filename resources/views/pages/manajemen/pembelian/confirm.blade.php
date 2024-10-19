@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Konfirmasi Pembelian Barang</h2>
        <form action="/manajemen/updatekonfirmpembelian/{{$pembelian->kodepembelian}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <label>Kode Pembelian</label>
                    <input type="text" name="kodepembelian" class="form-control" value="{{$pembelian->kodepembelian}}" readonly>
                </div>
                <div class="col">
                <label>Tanggal Pembelian</label>
                    <input type="date" name="tglbeli" class="form-control" value="{{$pembelian->tglbeli}}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Nama Barang</label>
                    <input type="text" name="namabrg" class="form-control"value="{{$pembelian->namabrg}}" readonly>
                </div>
                <div class="col">
                <label>jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{$pembelian->jumlah}}" readonly>
                </div>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Nama Vendor</label>
                <input type="text" name="vendor" class="form-control" value="{{$pembelian->vendor}}" readonly>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Spesifikasi</label>
                <textarea class="form-control" name="spesifikasi" placeholder="Spesifikasi" rows="5" readonly>{{$pembelian->spesifikasi}}</textarea>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Catatan</label>
                <textarea class="form-control" name="catatan" placeholder="Catatan Penolakan Pembelian" rows="5"></textarea>
            </div>
            <div class="form-group w-25 mt-2 p-2">
                <input type="submit" name="action" value="Konfirmasi" class="btn btn-outline-primary">
                <input type="submit" name="action" value="Ditolak" class="btn btn-outline-danger">
            </div>
        </form>
    </div>
</div>
@endsection
