@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
    <div class="mb-3 mt-2">
        @if($isFiltered)
            <a href="{{ route('pembelianadmin')}}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        @endif
    </div>
    <h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Pembelian Barang</h1>
    <div class="d-flex justify-content-between">
    </div>
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
                <th class="text-center" width="40px" scope="col"> No. </th>
                <th class="text-center" width="130px" scope="col"> Kode Pembelian</th>
                <th class="text-center" width="150px" scope="col"> Nama Barang</th>
                <th class="text-center" width="90px" scope="col"> Tanggal Pembelian</th>
                <th class="text-center" width="40px" scope="col"> Jumlah</th>
                <th class="text-center" width="90px" scope="col"> Status</th>
                <th class="text-center" width="85px" scope="col"> Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembelian as $no => $pb )
            <tr>
                <th class="text-left" scope="row">{{$pembelian-> firstItem() +$no}}</th>
                <td class="text-left">{{ $pb->kodepembelian}}</td>
                <td class="text-left">{{ $pb->namabrg}}</td>
                <td class="text-center">{{ $pb->tglbeli}}</td>
                <td class="text-center">{{ $pb->jumlah}}</td>
                <td class="text-center">
                    @if(is_null($pb->status))
                        <span class="badge badge-info"> Menunggu dikonfirmasi</span>
                    @elseif($pb->status == 'ceklis')
                        <span class="badge badge-success">Permintaan disetujui</span>
                    @elseif($pb->status == 'Ditolak')
                        <span class="badge badge-danger">Pembelian ditolak</span>
                    @elseif ($pb->status == 'selesai')
                        <span class="badge badge-success">Selesai</span>
                    @endif
                </td>
                <td class="text-center">
                    <a href="/manajemen/detailpembelian/{{$pb->kodepembelian}}" class="btn btn-outline-info"><i class="bi bi-eye"></i></i></a>
                    <a href="/manajemen/konfirmpembelian/{{$pb->kodepembelian}}" class="btn btn-outline-primary"><i class="bi bi-check-lg"></i></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <span class="float-right">{{$pembelian-> links('pagination::bootstrap-5')}}</span>
    </div>
@endsection
