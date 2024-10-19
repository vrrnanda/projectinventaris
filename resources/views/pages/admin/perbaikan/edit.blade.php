@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Edit Perbaikan Barang</h2>
        <form action="/admin/updateperbaikan/{{$perbaikan->kodeperbaikan}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <label>Kode Perbaikan</label>
                    <input type="text" name="kodepergantian" class="form-control" value="{{$perbaikan->kodeperbaikan}}" readonly>
                </div>
                <div class="col">
                <label>Nama Barang</label>
                    <input type="text" name="namabrg" class="form-control" value="{{$perbaikan->namabrg}}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label> Tanggal Perbaikan</label>
                    <input type="date" name="tglperbaikan" class="form-control" value="{{$perbaikan->tglperbaikan}}">
                </div>
                <div class="col">
                    <label> Vendor </label>
                    <select class="form-select" name="vendor">
                        @foreach ($vendor as $item)
                        <option value="{{$item->namavendor}}">{{$item->namavendor}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 mt-2">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" placeholder="Deskripsikan Kerusakan Barang" rows="5">{{$perbaikan->deskripsi}}</textarea>
                </div>
                <div class="form-group w-25 mt-2 p-2">
                    <input type="submit" value="Simpan" class="btn btn-outline-primary">
                </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
