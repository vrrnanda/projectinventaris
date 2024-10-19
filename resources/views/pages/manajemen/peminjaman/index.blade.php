@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
<h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Laporan Peminjaman Barang</h1>
<div class="d-flex justify-content-between">
    <a href="/manajemen/cetakpeminjaman" class="btn btn-outline-primary mt-2"><i class="bi bi-printer"></i> Cetak </a>
</div>
<form class="form-inline d-flex w-50" method="GET" action="/admin/caribarang">
    <input class="form-control me-2 w-50 mt-2" name="cari" type="text" placeholder="Pencarian">
    <button class="btn btn-outline-primary mt-2" type="submit"><i class="bi bi-search"></i></i></button>
</form>
<table class="table table-hover mt-2">
    <thead class="thead-light">
        <tr>
            <th class="text-center" width="40px" scope="col"> No. </th>
            <th class="text-center" width="100px" scope="col"> Kode Peminjaman</th>
            <th class="text-center" width="100px" scope="col"> Tanggal Peminjaman</th>
            <th class="text-center" width="100px" scope="col"> Tanggal Pengembalian</th>
            <th class="text-center" width="200px" scope="col"> Nama Barang</th>
            <th class="text-center" width="100px" scope="col"> Ruangan</th>
            <th class="text-center" width="100px" scope="col"> Tanggal Kembali</th>
            <th class="text-center" width="50px" scope="col"> Status</th>
            <th class="text-center" width="90px" scope="col"> Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($peminjaman as $no => $p)
        <tr>
            <th class="text-center" scope="row">{{$peminjaman-> firstItem() +$no}}</th>
            <td class="text-center">{{ $p->kodepeminjaman}}</td>
            <td class="text-center">{{ $p->tglpinjam}}</td>
            <td class="text-center">{{ $p->tglpengembilan}}</td>
            <td class="text-left">{{ $p->namabrg}}</td>
            <td class="text-center">{{ $p->ruangan}}</td>
            <td class="text-center">
                @if(is_null($p->tglkembali))
                    <span class="badge badge-info">Belum diterima </span>
                @elseif($p->statuskembali == 'selesai')
                    <span>{{$p->tglkembali}}</span>
                @endif
            </td>
            <td class="text-center">
                @if (is_null($p->statuskembali))
                    <span class="badge badge-warning">Belum dikembalikan</span>
                @elseif ($p->statuskembali == 'selesai')
                    <span class="badge badge-success">Selesai</span>
                @endif
            </td>
            <td class="text-center">
                <a href="/manajemen/detailpeminjaman/{{$p->kodepeminjaman}}" class="btn btn-outline-info"><i class="bi bi-eye"></i></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<span class="float-right">{{$peminjaman-> links('pagination::bootstrap-5')}}</span>
</div>
@endsection
