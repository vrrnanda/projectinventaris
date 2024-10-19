@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Laporan Barang Rusak</h2>
        <form action="/admin/simpanbarangrusak" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <label>Kode Laporan</label>
                    <input type="text" name="kodelaporan" class="form-control" value="{{$kodeLaporan}}" readonly>
                </div>
                <div class="col">
                <label>Tanggal Laporan</label>
                    <input type="date" name="tgllaporan" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label> Ruangan</label>
                        <select class="form-select " name="ruangan">
                            <option value="" disabled selected hidden>Pilih Ruangan</option>
                            @foreach ($ruangan as $item )
                            <option value="{{$item->namaruang}}">{{$item->namaruang}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="col">
                <label>Nama Barang</label>
                <select class="form-select " name="namabrg">
                    <option value="" disabled selected hidden>Pilih Barang</option>
                    @foreach ($barang as $item)
                    <option value="{{$item->namabrg}}">{{$item->kodebrg}} - {{$item->namabrg}}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" placeholder="Deskripsikan Kerusakan Barang" rows="5" required></textarea>
            </div>
            <div class="form-group w-25 mt-2 p-2">
                <input type="submit" value="Simpan" class="btn btn-outline-primary">
            </div>
        </form>
    </div>
</div>
@endsection
