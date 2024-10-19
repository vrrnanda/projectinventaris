@extends('layouts.user.main')
@section('tabel')
<div class="container-fluid">
<h1 class="h3 mb-4 text-gray-800 fw-bold">Barang {{Auth::user()->name}}</h1>
<form class="form-inline d-flex w-50" method="GET" action="">
    <input class="form-control me-2 w-50 mt-2" name="cari" type="text" placeholder="Pencarian">
    <button class="btn btn-outline-primary mt-2" type="submit"><i class="bi bi-search"></i></i></button>
</form>
@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
    {{ Session::get('success') }}
    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
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
        @foreach ($penempatan as $no => $p )
        <tr>
            <th class="text-center" scope="row">{{$penempatan-> firstItem() +$no}}</th>
            <td class="text-center">{{ $p->kodebrg}}</td>
            <td class="text-left">{{ $p->namabrg}}</td>
            <td class="text-center">{{ $p->kategori}}</td>
            <td class="text-center">{{ $p->jumlah}}</td>
            <td class="text-center">
                <a href="/user/detailbarang/{{$p->kodebrg}}" class="btn btn-outline-info"><i class="bi bi-eye"></i></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<span class="float-right">{{$penempatan-> links('pagination::bootstrap-5')}}</span>
@endsection
