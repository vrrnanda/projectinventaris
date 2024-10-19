@extends('layouts.user.main')
@section('tabel')
<div class="container-fluid">
    <div class="mb-3 mt-2">
        <a href="{{route('permintaanugd')}}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
    </div>
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Konfirmasi Permintaan Barang</h2>
        <form action="/user/updatekonfirmasipermintaan/{{$permintaan->kodepermintaan}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Kode Permintaan</label>
                <input type="text" name="kodepermintaan" class="form-control" value="{{$permintaan->kodepermintaan}}" readonly>
            </div>
            <div class="row">
                <div class="col">
                    <label>Tanggal Permintaan</label>
                        <input type="text" name="tglpermintaan" class="form-control" value="{{$permintaan->tglpermintaan}}" readonly>
                </div>
                <div class="col">
                    <label> Ruangan</label>
                    <input type="text" name="ruangan" class="form-control" value="{{$permintaan->ruangan}}" readonly>
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
                <textarea class="form-control" name="keterangan" placeholder="Keterangan barang yang dibutuhkan" rows="5" readonly>{{$permintaan->keterangan}}</textarea>
            </div>
            <div class="mb-3 mt-2">
                <label class> Tanggal Terima </label>
                <input type="text" name="tglterima" class="form-control" value="{{$permintaan->tglterima}}" readonly>
            </div>
        </form>
    </div>
</div>
@endsection
