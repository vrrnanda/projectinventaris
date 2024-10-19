@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Edit Barang</h2>
        <form action="/admin/updatebarang/{{$barang->kodebrg}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <label>Kode Barang</label>
                    <input type="text" name="kodebrg" class="form-control" value="{{$barang->kodebrg}}" readonly>
                </div>
                <div class="col">
                <label>Nama Barang</label>
                    <input type="text" name="namabrg" class="form-control" value="{{$barang->namabrg}}">
                </div>
            </div>
            <div class="row">
                <div class="col mt-2">
                    <label> Kategori </label>
                    <select class="form-select " name="kategori">
                        <option value="{{$barang->kategori}}">{{$barang->kategori}}</option>
                        @foreach ($kategori as $item)
                        <option value="{{$item->kategori}}"> {{ $item->kategori}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col mt-2">
                <label>jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{$barang->jumlah}}">
                </div>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Spesifikasi</label>
                <textarea class="form-control" name="spesifikasi" placeholder="Spesifikasi" rows="3">{{$barang->spesifikasi}}</textarea>
            </div>
            <div class="form-group w-25 mt-2 p-2">
                <input type="submit" value="Simpan" class="btn btn-outline-primary">
            </div>
        </form>
    </div>
</div>
@endsection
