@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="mb-3 mt-2">
        @if($isFiltered)
            <a href="{{ route('barangadmin') }}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        @endif
    </div>
<h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Barang</h1>
<div class="d-flex justify-content-between">
    <a href="/admin/tambahbarang" class="btn btn-outline-primary mt-2"><i class="bi bi-plus-square-fill"></i> Tambah Data </a>
</div>
<div class="d-flex justify-content-between mt-2">
    <form action="{{ route('filterbarang') }}" method="GET" class="d-flex">
        <select name="kategori" id="kategori" class="form-select" onchange="this.form.submit()">
            <option value="" disabled selected hidden>Pilih Kategori</option>
            @foreach ($kategoriList as $item)
                <option value="{{ $item->kategori }}">{{ $item->kategori}}</option>
            @endforeach
        </select>
    </form>
    <div class="d-flex justify-content-end mt-2">
        <a href="{{ route('printbarang', ['kategori' => request('kategori')]) }}" class="btn btn-outline-primary mt-2">
            <i class="bi bi-printer"></i> Cetak
        </a>
    </div>
</div>
<form class="form-inline d-flex w-50" method="GET" action="/admin/caribarang">
    <input class="form-control me-2 w-50 mt-2" name="cari" type="text" placeholder="Pencarian">
    <button class="btn btn-outline-primary mt-2" type="submit"><i class="bi bi-search"></i></i></button>
</form>
@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
    {{ Session::get('success') }}
    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if($barang->isEmpty())
<div class="alert alert-warning mt-3">
    Tidak ditemukan barang.
</div>
@else
<table class="table table-hover mt-2">
    <thead class="thead-light">
        <tr>
            <th class="text-center" scope="col"> No. </th>
            <th class="text-center" scope="col"> Kode Barang</th>
            <th class="text-center" scope="col"> Nama Barang</th>
            <th class="text-center" scope="col"> Kategori</th>
            <th class="text-center" scope="col"> Jumlah</th>
            <th class="text-center" scope="col"> Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($barang as $no => $b )
        <tr>
            <th class="text-center"scope="row">{{$barang-> firstItem() +$no}}</th>
            <td class="text-center">{{ $b->kodebrg}}</td>
            <td class="text-left">{{ $b->namabrg}}</td>
            <td class="text-center">{{ $b->kategori}}</td>
            <td class="text-center">{{ $b->jumlah}}</td>
            <td class="text-center">
                <a href="/admin/detailbarang/{{$b->kodebrg}}" class="btn btn-outline-info"><i class="bi bi-eye"></i></i></a>
                <a href="/admin/editbarang/{{$b->kodebrg}}" class="btn btn-outline-success"><i class="bi bi-pencil-square"></i></a>
                <a href="/admin/hapusbarang/{{$b->kodebrg}}"  onclick="return confirm('Apakah anda yakin ingin menghapus data?')" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<span class="float-right">{{$barang-> links('pagination::bootstrap-5')}}</span>
@endif
</div>
@endsection
