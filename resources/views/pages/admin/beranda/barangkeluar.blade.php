@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Barang Keluar</h1>
    <div class="mb-3 mt-2">
        <a href="{{route('berandaadmin')}}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
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
                <th class="text-center" width="40px">Tanggal</th>
                <th class="text-center" width="40px">Sumber</th>
                <th class="text-center" width="40px">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangKeluar as $no => $bk)
            <tr>
                <th class="text-center" scope="row">{{ $barangKeluar ->firstItem() + $no }}</th>
                <td class="text-center">{{ $bk['kode'] }}</td>
                <td class="text-center">{{ $bk['nama'] }}</td>
                <td class="text-center">{{ $bk['tanggal'] }}</td>
                <td class="text-center">{{ $bk['sumber'] }}</td>
                <td class="text-center">{{ $bk['jumlah'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <span class="float-right">{{ $barangKeluar ->links('pagination::bootstrap-5')}}</span>
</div>
@endsection
