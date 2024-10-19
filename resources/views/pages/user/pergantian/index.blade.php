@extends('layouts.user.main')
@section('tabel')
<div class="container-fluid">
    <div class="mb-3 mt-2">
        @if($isFiltered)
            <a href="{{ route('pergantianugd') }}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        @endif
    </div>
    <h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Pergantian Barang</h1>
    <div class="d-flex justify-content-between">
    </div>
    <form class="form-inline d-flex w-50" method="GET" action="/user/caripergantian">
        <input class="form-control me-2 w-50 mt-2" name="cari" type="text" placeholder="Pencarian">
        <button class="btn btn-outline-primary mt-2" type="submit"><i class="bi bi-search"></i></i></button>
    </form>
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if($pergantian->isEmpty())
    <div class="alert alert-warning mt-3">
        Tidak ditemukan barang.
    </div>
    @else
    <table class="table table-hover mt-2">
        <thead class="thead-light">
            <tr>
                <th class="text-center" width="40px" scope="col"> No. </th>
                <th class="text-center" width="90px" scope="col"> Kode Pergantian</th>
                <th class="text-center" width="100px" scope="col"> Tanggal Pergantian</th>
                <th class="text-center" width="100px" scope="col"> Ruangan</th>
                <th class="text-center" width="200px" scope="col"> Nama Barang</th>
                <th class="text-center" width="100px" scope="col"> Jumlah</th>
                <th class="text-center" width="100px" scope="col"> Tanggal Terima</th>
                <th class="text-center" width="90px" scope="col"> Status</th>
                <th class="text-center" width="90px" scope="col"> Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pergantian as $no => $pg )
            <tr>
                <th class="text-center" scope="row">{{$pergantian -> firstItem() +$no}}</th>
                <td class="text-center">{{ $pg ->kodepergantian}}</td>
                <td class="text-center">{{ $pg ->tglpergantian}}</td>
                <td class="text-center">{{ $pg ->ruangan}}</td>
                <td class="text-left">{{ $pg ->namabrg}}</td>
                <td class="text-center">{{ $pg ->jumlah}}</td>
                <td class="text-center">
                    @if($pg ->status=='ceklis')
                        <span class="badge badge-info"> Belum diterima</span>
                    @elseif ($pg->status == 'selesai')
                        <span>{{$pg->tglterima}}</span>
                    @endif
                <td class="text-center">
                    @if(is_null($pg ->status))
                        <span class="badge badge-warning"> Sedang diproses </span>
                    @elseif ($pg->status == 'ceklis')
                    <span class="badge badge-warning"> Sedang diproses </span>
                    @elseif ($pg ->status == 'selesai')
                        <span class="badge badge-success">Selesai</span>
                @endif
                </td>
                <td class="text-center">
                    <div class="action-buttons">
                        <a href="/user/konfirmasipergantian/{{$pg->kodepergantian}}" class="btn btn-outline-primary"><i class="bi bi-check-lg"></i></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <span class="float-right">{{$pergantian -> links()}}</span>
    @endif
    </div>
@endsection
