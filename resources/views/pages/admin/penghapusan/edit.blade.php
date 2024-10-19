@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Edit Penghapusan Barang</h2>
        <form action="/admin/updatepenghapusan/{{$barangterbuang->kodehapus}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3 mt-1">
                <label>Kode Hapus</label>
                <input type="text" name="kodehapus" class="form-control" value="{{$barangterbuang->kodehapus}}" readonly>
            </div>
            <div class="row">
                <div class="col">
                    <label> Nama Barang</label>
                    <select class="form-select single-select-field" name="namabrg" value="{{$barangterbuang->namabrg}}">
                        @foreach ($barang as $item)
                        <option value="{{$item->namabrg}}"> {{$item->namabrg}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                <label>jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{$barangterbuang->jumlah}}">
                </div>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Status</label>
                <select class="form-select " name="status" value="{{$barangterbuang->status}}">
                    <option value="Dihibahkan">Dihibahkan</option>
                    <option value="Dijual">Dijual</option>
                    <option value="Dibuang">Dibuang</option>
                </select>
            </div>
            <div class="form-group w-25 mt-2 p-2">
                <input type="submit" value="Simpan" class="btn btn-outline-primary">
            </div>
        </form>
    </div>
</div>
@endsection
