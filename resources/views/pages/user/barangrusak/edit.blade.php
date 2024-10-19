@extends('layouts.user.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Edit Laporan Barang Rusak</h2>
        <form action="/user/updatebarangrusak/{{$barangrusak->kodelaporan}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <label>Kode Laporan</label>
                    <input type="text" name="kodelaporan" class="form-control" value="{{$barangrusak->kodelaporan}}" readonly>
                </div>
                <div class="col">
                <label>Tanggal Laporan</label>
                    <input type="date" name="tgllapor" class="form-control" value="{{$barangrusak->tgllapor}}">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label> Ruangan</label>
                    <select class="form-select " name="ruangan" value="{{$barangrusak->ruangan}}">
                        @foreach ($ruangan as $item)
                        <option value="{{$item->namaruang}}">{{$item->namaruang}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                <label>Nama Barang</label>
                <select class="form-select" name="namabrg" value={{$barangrusak->namabrg}}>
                    @foreach ($barang as $item)
                    <option value="{{$item->namabrg}}">{{$item->namabrg}}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" placeholder="Deskripsikan Kerusakan Barang" rows="5">{{$barangrusak->deskripsi}}</textarea>
            </div>
            <div class="form-group w-25 mt-2 p-2">
                <input type="submit" value="Simpan" class="btn btn-outline-primary">
            </div>
        </form>
    </div>
</div>
@endsection
