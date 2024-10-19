@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Barang Masuk</h1>
    <div class="mb-3 mt-2">
        <a href="{{route('berandamanajemen')}}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
    </div>
    <div class="d-flex justify-content-between">
        <a href="" class="btn btn-outline-primary mt-2"><i class="bi bi-printer"></i> Cetak </a>
    </div>
    <table class="table table-hover mt-2">
        <thead class="thead-light">
            <tr>
                <th class="text-center" width="40px" scope="col"> No.</th>
                <th class="text-center" width="40px">Kode</th>
                <th class="text-center" width="200px">Nama Barang</th>
                <th class="text-center" width="40px"> Tanggal</th>
                <th class="text-center" width="40px">Sumber</th>
                <th class="text-center" width="40px">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangMasuk as $no => $bm)
            <tr>
                <th class="text-center" scope="row">{{ $barangMasuk->firstItem() + $no }}</th>
                <td class="text-center">{{ $bm['kode'] }}</td>
                <td class="text-center">{{ $bm['nama'] }}</td>
                <td class="text-center">{{ $bm['tanggal'] }}</td>
                <td class="text-center">{{ $bm['sumber'] }}</td>
                <td class="text-center">{{ $bm['jumlah'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <span class="float-right">{{ $barangMasuk->links('pagination::bootstrap-5')}}</span>
</div>
@endsection
