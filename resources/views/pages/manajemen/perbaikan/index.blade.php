@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
<h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Perbaikan Barang</h1>
<div class="d-flex justify-content-between">
    <a href="/manajemen/cetakperbaikan" class="btn btn-outline-primary mt-2"><i class="bi bi-printer"></i> Cetak </a>
</div>
<form class="form-inline d-flex w-50" method="GET" action="">
    <input class="form-control me-2 w-50 mt-2" name="cari" type="text" placeholder="Pencarian">
    <button class="btn btn-outline-primary mt-2" type="submit"><i class="bi bi-search"></i></i></button>
</form>
<table class="table table-hover mt-2">
    <thead class="thead-light">
        <tr>
            <th class="text-center" width="40px" scope="col"> No. </th>
            <th class="text-center" width="90px" scope="col"> Kode Laporan</th>
            <th class="text-center" width="150px" scope="col"> Nama Barang</th>
            <th class="text-center" width="100px" scope="col"> Vendor</th>
            <th class="text-center" width="100px" scope="col"> Tanggal Perbaikan</th>
            <th class="text-center" width="50px" scope="col"> Status</th>
            <th class="text-center" width="90px" scope="col"> Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($perbaikan as $no => $pr )
        <tr>
            <th class="text-center" scope="row">{{$perbaikan-> firstItem() +$no}}</th>
            <td class="text-center">{{ $pr->kodelaporan}}</td>
            <td class="text-center">{{ $pr->namabrg}}</td>
            <td class="text-center">{{ $pr->vendor}}</td>
            <td class="text-center">{{ $pr->tglperbaikan}}</td>
            <td class="text-center">
                @if(is_null($pr->status))
                    <span class="badge badge-info"> Menunggu dikonfirmasi </span>
                @elseif ($pr->status == 'sedang diproses')
                    <span class="badge badge-warning">Sedang diproses</span>
                @elseif ($pr->status == 'selesai')
                    <span class="badge badge-success">Selesai</span>
            @endif
            </td>
            <td class="text-center">
                <div class="action-buttons">
                    <a href="/manajemen/detailperbaikan/{{$pr->id}}" class="btn btn-outline-info"><i class="bi bi-eye"></i></a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<span class="float-right">{{$perbaikan-> links('pagination::bootstrap-5')}}</span>
</div>
@endsection
