@extends('layouts.user.main')
@section('tabel')
<div class="container-fluid">
    <div class="mb-3 mt-2">
        @if($isFiltered)
            <a href="{{ route('pengembalianuser') }}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        @endif
    </div>
    <h1 class="h3 mb-4 text-gray-800 fw-bold"> Daftar Pengembalian Barang {{Auth::user()->name}}</h1>
    <form class="form-inline d-flex w-50" method="GET" action="/user/caripengembalian">
        <input class="form-control me-2 w-50 mt-2" name="cari" type="text" placeholder="Pencarian">
        <button class="btn btn-outline-primary mt-2" type="submit"><i class="bi bi-search"></i></i></button>
    </form>
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if($peminjaman->isEmpty())
    <div class="alert alert-warning mt-3">
        Tidak ditemukan barang.
    </div>
    @else
    <table class="table table-hover mt-2">
        <thead class="thead-light">
            <tr>
                <th class="text-center" width="40px" scope="col"> No. </th>
                <th class="text-center" width="70px" scope="col"> Kode Peminjaman</th>
                <th class="text-center" width="70px" scope="col"> Tanggal Peminjaman</th>
                <th class="text-center" width="70px" scope="col"> Tanggal Pengembalian</th>
                <th class="text-center" width="200px" scope="col"> Nama Barang</th>
                <th class="text-center" width="40px" scope="col"> Jumlah</th>
                <th class="text-center" width="100px" scope="col"> Tanggal Barang Kembali</th>
                <th class="text-center" width="70px" scope="col"> Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $no => $p )
            <tr>
                <th class="text-center" scope="row">{{$peminjaman-> firstItem() +$no}}</th>
                <td class="text-center">{{ $p->kodepeminjaman}}</td>
                <td class="text-center">{{ $p->tglpinjam}}</td>
                <td class="text-center">{{ $p->tglpengembalian}}</td>
                <td class="text-left">{{ $p->namabrg}}</td>
                <td class="text-center">{{ $p->jumlah}}</td>
                <td class="text-center">
                    @if(is_null($p->tglkembali))
                        <span class="badge badge-info">Belum dikembalikan</span>
                    @elseif($p->tglkembali)
                        <span>{{$p->tglkembali}}</span>
                    @endif
                </td>
                <td class="text-center">
                    @if (is_null($p->statuskembali))
                        <span class="badge badge-info">Belum dikembalikan</span>
                    @elseif ($p->statuskembali == 'selesai')
                        <span class="badge badge-success">Selesai</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <span class="float-right">{{$peminjaman-> links('pagination::bootstrap-5')}}</span>
    @endif
    </div>
@endsection
