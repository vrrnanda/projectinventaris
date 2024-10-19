@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Persediaan Barang</h1>
    <div class="mb-3 mt-2">
        <a href="{{route('berandamanajemen')}}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
    </div>
    <div class="d-flex justify-content-between">
        <a href="" class="btn btn-outline-primary mt-2"><i class="bi bi-printer"></i> Cetak </a>
    </div>
    <table class="table table-hover mt-2">
        <thead class="thead-light">
            <tr>
                <th class="text-center" width="40px" scope="col"> No. </th>
                <th class="text-center" width="100px" scope="col"> Kode Barang</th>
                <th class="text-center" width="200px" scope="col"> Nama Barang</th>
                <th class="text-center" width="90px" scope="col"> Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $no => $b)
            <tr>
                <th class="text-center" scope="row">{{ $barang->firstItem() + $no }}</th>
                <td class="text-center">{{ $b->kodebrg }}</td>
                <td class="text-center">{{ $b->namabrg }}</td>
                <td class="text-center">{{ $b->stok }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <span class="float-right">{{ $barang->links('pagination::bootstrap-5')}}</span>
</div>
@endsection
