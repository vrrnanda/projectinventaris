@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Detail Penempatan Barang</h2>
        <div class="mb-3 mt-2">
            <a href="{{route('penempatanmanajemen')}}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        </div>
        @method('PUT')
            <div class="row">
                <div class="col">
                    <label>Kode Penempatan</label>
                    <input type="text" name="kodepenempatan" class="form-control" value="{{$penempatan->kodepenempatan}}" readonly>
                </div>
                <div class="col">
                <label>Tanggal Penempatan</label>
                    <input type="text" name="tglpenempatan" class="form-control" value="{{$penempatan->tglpenempatan}}" readonly>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <label> Ruangan</label>
                    <input type="text" name="ruangan" class="form-control" value="{{$penempatan->ruangan}}" readonly>
                </div>
                <div class="col">
                    <label> Jumlah </label>
                    <input type="text" name="jumlah" class="form-control"  value="{{$penempatan->jumlah}}" readonly>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label> Nama Barang</label>
                        <input type="text" name="namabrg" class="form-control" value="{{$penempatan->namabrg}}" readonly>
                    </div>
                    <div class="col">
                        <label> Kategori</label>
                        <input type="text" name="kategori" class="form-control" value="{{$penempatan->kategori}}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
