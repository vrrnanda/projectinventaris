@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Perbaikan Barang</h2>
        <form action="/admin/simpanperbaikanbarang" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <label>Kode Perbaikan</label>
                    <input type="text" name="kodeperbaikan" class="form-control" value="{{$kodePerbaikan}}" readonly>
                </div>
                <div class="col">
                    <label>Tanggal Pergantian</label>
                    <input type="date" name="tglperbaikan" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label> Nama Barang</label>
                        <select class="form-select " name="namabrg">
                            <option value="" disabled selected hidden>Pilih Barang</option>
                            @foreach ($barang as $item)
                            <option value="{{$item->namabrg}}"> {{ $item->kodebrg }} - {{ $item->namabrg}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="col">
                    <label> Jumlah </label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label> Vendor </label>
                <select class="form-select" name="vendor">
                    <option value="" disabled selected hidden> Pilih Vendor</option>
                    @foreach ($vendor as $item)
                    <option value="{{$item->namavendor}}">{{$item->namavendor}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label> Deskripsi </label>
                <textarea class="form-control" name="deskripsi" placeholder="Deskripsikan Kerusakan Barang" rows="5" required></textarea>
            </div>
            <div class="form-group w-25 mt-2 p-2">
                <input type="submit" value="Simpan" class="btn btn-outline-primary">
            </div>
        </form>
    </div>
</div>
@endsection
