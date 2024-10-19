@extends('layouts.staf.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Konfirmasi Pergantian Barang</h2>
        <form action="/staf/updatekonfirmpergantian/{{$pergantian->kodepergantian}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <label>Kode Pergantian</label>
                    <input type="text" name="kodepergantian" class="form-control" value="{{$pergantian->kodepergantian}}" readonly>
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
            <div class="mb-3">
                <label> Tanggal Pergantian</label>
                <input type="date" name="tglpergantian" class="form-control" required>
            </div>
            <div class="form-group w-25 mt-2 p-2">
                <input type="submit" value="Konfirmasi" class="btn btn-outline-primary">
            </div>
        </form>
    </div>
</div>
@endsection
