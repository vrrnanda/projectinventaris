@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <div class="mb-3 mt-2">
            <a href="{{route('pergantianadmin')}}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        </div>
        <h2> Detail Pergantian Barang</h2>
        @method('PUT')
        <div class="row">
            <div class="col">
                <label>Kode Pergantian</label>
                <input type="text" name="kodepergantian" class="form-control" value="{{$pergantian->kodepergantian}}" readonly>
            </div>
            <div class="col">
            <label>Tanggal Pergantian</label>
                <input type="text" name="tglpergantian" class="form-control" value="{{$pergantian->tglpergantian}}" readonly>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <label> Ruangan</label>
                <input type="text" name="ruangan" class="form-control" value="{{$pergantian->ruangan}}" readonly>
            </div>
            <div class="col">
                <label> Jumlah </label>
                <input type="number" name="jumlah" class="form-control" value="{{$pergantian->jumlah}}" readonly>
            </div>
        </div>
        <div class="mb-3 mt-2">
            <label> Nama Barang</label>
            <input type="text" name="namabrg" class="form-control" value="{{$pergantian->namabrg}}" readonly>
        </div>
        <div class="mb-3 mt-2">
            <label> Keterangan</label>
            <textarea class="form-control" name="keterangan" placeholder="Keterangan" rows="5" readonly>{{$pergantian->keterangan}}</textarea>
        </div>
        <div class="row">
            <div class="col">
                <label>Tanggal Terima </label>
                <input type="text" name="tglterima" class="form-control" value="{{$pergantian->tglterima}}" readonly>
            </div>
            <div class="col">
                <label> Status</label>
                <input type="text" name="status" class="form-control" value="{{$pergantian->status}}" readonly>
            </div>
        </div>
    </div>
</div>
@endsection
