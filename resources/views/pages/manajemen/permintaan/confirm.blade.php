@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Konfirmasi Permintaan Barang</h2>
        <form action="/manajemen/updatekonfirmasipermintaan/{{$permintaan->kodepermintaan}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Kode Permintaan</label>
                <input type="text" name="kodepermintaan" class="form-control" value="{{$permintaan->kodepermintaan}}" readonly>
            </div>
            <div class="row">
                <div class="col">
                    <label>Tanggal Permintaan</label>
                        <input type="date" name="tglpermintaan" class="form-control" value="{{$permintaan->tglpermintaan}}" readonly>
                </div>
                <div class="col">
                    <label> Ruangan</label>
                    <input type="date" name="ruangan" class="form-control" value="{{$permintaan->ruangan}}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label> Nama Barang </label>
                    <input type="text" name="namabrg" class="form-control" value="{{$permintaan->namabrg}}" readonly>
                </div>
                <div class="col">
                    <label> Jumlah </label>
                    <input type="number" name="jumlah" class="form-control" value="{{$permintaan->jumlah}}" readonly>
                </div>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Keterangan</label>
                <textarea class="form-control" name="keterangan" rows="5" readonly>{{$permintaan->keterangan}}</textarea>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Catatan</label>
                <textarea class="form-control" name="catatan" rows="5" placeholder="Catatan"></textarea>
            </div>
            <div class="form-group w-25 mt-2 p-2">
                <input type="submit" name="action" value="Konfirmasi" class="btn btn-outline-primary">
                <input type="submit" name="action" value="Ditolak" class="btn btn-outline-danger">
            </div>
        </form>
    </div>
</div>
@endsection
