@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
<h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Pergantian Barang</h1>
<div class="d-flex justify-content-between">
    <a href="/manajemen/cetakpergantian" class="btn btn-outline-primary mt-2"><i class="bi bi-printer"></i> Cetak </a>
</div>
<form class="form-inline d-flex w-50" method="GET" action="">
    <input class="form-control me-2 w-50 mt-2" name="cari" type="text" placeholder="Pencarian">
    <button class="btn btn-outline-primary mt-2" type="submit"><i class="bi bi-search"></i></i></button>
</form>
<table class="table table-hover mt-2">
    <thead class="thead-light">
        <tr>
            <th class="text-center" width="40px" scope="col"> No. </th>
            <th class="text-center" width="90px" scope="col"> Kode Pergantian</th>
            <th class="text-center" width="100px" scope="col"> Ruangan</th>
            <th class="text-center" width="150px" scope="col"> Nama Barang</th>
            <th class="text-center" width="100px" scope="col"> Jumlah</th>
            <th class="text-center" width="90px" scope="col"> Status</th>
            <th class="text-center" width="90px" scope="col"> Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pergantian as $no => $pg )
        <tr>
            <th class="text-center" scope="row">{{$pergantian -> firstItem() +$no}}</th>
            <td class="text-center">{{ $pg ->kodepergantian}}</td>
            <td class="text-center">{{ $pg ->ruangan}}</td>
            <td class="text-center">{{ $pg ->namabrg}}</td>
            <td class="text-center">{{ $pg ->jumlah}}</td>
            <td class="text-center">
                @if(is_null($pg ->status))
                    <span class="badge badge-warning"> Sedang diproses </span>
                @elseif ($pg ->status == 'sedang diproses')
                    <span class="badge badge-warning">Sedang diproses</span>
                @elseif ($pg->status == 'ceklis')
                    <span class="badge badge-warning">Sedang diproses</span>
                @elseif ($pg ->status == 'selesai')
                    <span class="badge badge-success">Selesai</span>
            @endif
            </td>
            <td class="text-center">
                <div class="action-buttons">
                    <a href="/manajemen/detailpergantian/{{$pg->kodepergantian}}" class="btn btn-outline-info"><i class="bi bi-eye"></i></a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<span class="float-right">{{$pergantian -> links('pagination::bootstrap-5')}}</span>
</div>
@endsection
