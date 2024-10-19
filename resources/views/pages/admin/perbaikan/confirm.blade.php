@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Konfirmasi Perbaikan Barang Selesai</h2>
        <form action="/admin/updatekonfirmasiperbaikan/{{$perbaikan->kodeperbaikan}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <label>Kode Laporan</label>
                    <input type="text" name="kodelaporan" class="form-control" value="{{$perbaikan->kodeperbaikan}}" readonly>
                </div>
                <div class="col">
                <label>Nama Barang</label>
                    <input type="text" name="namabrg" class="form-control" value="{{$perbaikan->namabrg}}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label> Tanggal Perbaikan</label>
                    <input type="date" name="tglperbaikan" class="form-control" value="{{$perbaikan->tglperbaikan}}" readonly>
                </div>
                <div class="col">
                    <label> Vendor </label>
                    <input type="text" name="vendor" class="form-control" value="{{$perbaikan->vendor}}" readonly>
                </div>
                <div class="mb-3 mt-2">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="5" readonly>{{$perbaikan->deskripsi}}</textarea>
                </div>
                <div class="row">
                    <div class="col">
                        <label> Tanggal Selesai Perbaikan</label>
                        <input type="date" name="tglselesai" class="form-control" required>
                    </div>
                    <div class="col">
                        <label> Biaya Perbaikan</label>
                        <input type="number" name="biaya" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label> Bukti Nota</label>
                    <input type="file" name="bukti" class="form-control" required>
                </div>
                <div class="form-group w-25 mt-2 p-2">
                    <input type="submit" value="Konfirmasi" class="btn btn-outline-primary">
                </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
