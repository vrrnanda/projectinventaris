@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Edit Penempatan Barang</h2>
        <form action="/admin/updatepenempatan/{{$penempatan->kodepenempatan}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <label>Kode Penempatan</label>
                    <input type="text" name="kodepenempatan" class="form-control" value="{{$penempatan->kodepenempatan}}" readonly>
                </div>
                <div class="col">
                <label>Tanggal Penempatan</label>
                    <input type="date" name="tglpenempatan" class="form-control" value="{{$penempatan->tglpenempatan}}">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <label> Ruangan</label>
                        <select class="form-select " name="ruangan" value="{{$penempatan->ruangan}}">
                            @foreach ($ruangan as $item)
                            <option value="{{$item->namaruang}}">{{$item->namaruang}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="col">
                    <label> Jumlah </label>
                    <input type="number" name="jumlah" class="form-control"  value="{{$penempatan->jumlah}}">
                </div>
                <div class="mb-3 mt-2">
                    <label> Nama Barang</label>
                    <select class="form-select single-select-field" name="namabrg" value="{{$penempatan->namabrg}}">
                        @foreach ($barang as $item)
                        <option value="{{$item->namabrg}}"> {{ $item->namabrg}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group w-25 mt-2 p-2">
                    <input type="submit" value="Simpan" class="btn btn-outline-primary">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
