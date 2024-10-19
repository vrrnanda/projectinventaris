@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Konfirmasi Pembelian Barang</h2>
        <form action="/admin/updatekonfirmpembelian/{{$pembelian->kodepembelian}}" method="POST" enctype="multipart/form-data">
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
                    <input type="text" name="namabrg" class="form-control" value="{{$pembelian->namabrg}}" readonly>
                </div>
                <div class="col">
                <label>jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{$pembelian->jumlah}}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="form-label">Nama Vendor</label>
                        <input type="text" name="vendor" class="form-control" value="{{$pembelian->vendor}}" readonly>
                </div>
                <div class="col">
                    <label class="form-label">Biaya</label>
                        <input type="text" name="harga" class="form-control" value="{{$pembelian->harga}}" readonly>
                </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Spesifikasi</label>
                <textarea class="form-control" name="spesifikasi" placeholder="Spesifikasi" rows="7" readonly>{{$pembelian->spesifikasi}}</textarea>
            </div>
            <div class="row">
                <div class="col">
                    <label> Tanggal Terima </label>
                    <input type="date" name="tglterima" class="form-control" required>
                </div>
                <div class="col">
                    <label> Bukti Nota</label>
                    <input type="file" name="bukti" class="form-control" required>
                </div>
            </div>
            <div class="form-group w-25 mt-2 p-2">
                <input type="submit" value="Konfirmasi" class="btn btn-outline-primary">
            </div>
        </form>
    </div>
</div>
@endsection
