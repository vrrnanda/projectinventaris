@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
<h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Barang</h1>
<div class="d-flex justify-content-between">
    <a href="" class="btn btn-outline-primary mt-2"><i class="bi bi-printer"></i> Cetak </a>
</div>
<form class="form-inline d-flex w-50" method="GET" action="">
    <input class="form-control me-2 w-50 mt-2" name="cari" type="text" placeholder="Pencarian">
    <button class="btn btn-outline-primary mt-2" type="submit"><i class="bi bi-search"></i></i></button>
</form>
<table class="table table-hover mt-2">
    <thead class="thead-light">
        <tr>
            <th class="text-center" width="30px" scope="col"> No. </th>
            <th class="text-center" width="90px" scope="col"> Kode Barang</th>
            <th class="text-center" width="200px" scope="col"> Nama Barang</th>
            <th class="text-center" width="90px" scope="col"> Kategori</th>
            <th class="text-center" width="30px" scope="col"> Jumlah</th>
            <th class="text-center" width="90px" scope="col"> Aksi</th>
        </tr>
    </thead>
    @foreach ($barang as $no => $b )
    <tr>
        <th class="text-center" scope="row">{{$barang-> firstItem() +$no}}</th>
        <td class="text-center">{{ $b->kodebrg}}</td>
        <td class="text-justify">{{ $b->namabrg}}</td>
        <td class="text-center">{{ $b->kategori}}</td>
        <td class="text-center">{{ $b->jumlah}}</td>
        <td class="text-center">
            <a href="/staf/detailbarang/{{$b->kodebrg}}" class="btn btn-outline-info"><i class="bi bi-eye"></i></i></a>
        </td>
    </tr>
    @endforeach
</table>
<span class="float-right">{{$barang-> links('pagination::bootstrap-5')}}</span>
</div>
@endsection
