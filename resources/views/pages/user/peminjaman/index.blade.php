@extends('layouts.user.main')
@section('tabel')
<div class="container-fluid">
    <div class="mb-3 mt-2">
        @if($isFiltered)
            <a href="{{ route('pinjambarangugd') }}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        @endif
    </div>
    <h1 class="h3 mb-4 text-gray-800 fw-bold"> Daftar Peminjaman Barang {{Auth::user()->name}}</h1>
    <div class="d-flex justify-content-between">
        <a href="/user/tambahpeminjaman" class="btn btn-outline-primary mt-2"><i class="bi bi-plus-square-fill"></i> Tambah Data </a>
    </div>
    <form class="form-inline d-flex w-50" method="GET" action="/user/caripeminjaman">
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
                <th class="text-center" width="200px" scope="col"> Nama Barang</th>
                <th class="text-center" width="40px" scope="col"> Jumlah</th>
                <th class="text-center" width="80px" scope="col"> Tanggal Terima</th>
                <th class="text-center" width="90px" scope="col"> Status</th>
                <th class="text-center" width="90px" scope="col"> Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $no => $p )
            <tr>
                <th class="text-center" scope="row">{{$peminjaman-> firstItem() +$no}}</th>
                <td class="text-center">{{ $p->kodepeminjaman}}</td>
                <td class="text-center">{{ $p->tglpinjam}}</td>
                <td class="text-left">{{ $p->barangpinjam}}</td>
                <td class="text-center">{{ $p->jumlah}}</td>
                <td class="text-center">
                    @if(is_null($p->tglterima) && $p->status != 'Ditolak')
                        <span class="badge badge-info">Belum diterima </span>
                    @elseif($p->status == 'sedang diproses')
                        <span class="badge badge-warning">Sedang diproses</span>
                    @elseif($p->status == 'selesai')
                        <span>{{$p->tglterima}}</span>
                    @elseif($p->status == 'ditolak')
                        <span class="badge badge-danger"> Peminjaman ditolak </span>
                    @endif
                </td>
                <td class="text-center">
                    @if (is_null($p->status))
                        <span class="badge badge-info">Menunggu dikonfirmasi</span>
                    @elseif ($p->status == 'sedang diproses')
                        <span class="badge badge-warning">Sedang diproses</span>
                    @elseif ($p->status == 'Ditolak')
                        <span class="badge badge-danger">Peminjaman Ditolak</span>
                    @elseif ($p->status == 'ceklis')
                        <span class="badge badge-warning">Sedang diproses</span>
                    @elseif ($p->status == 'selesai')
                        <span class="badge badge-success">Selesai</span>
                    @endif
                </td>
                <td class="text-center">
                    <div class="action-buttons">
                        <a href="/user/detailpeminjaman/{{$p->kodepeminjaman}}" class="btn btn-outline-info"><i class="bi bi-eye"></i></a>
                        <a href="/user/editpeminjaman/{{$p->kodepeminjaman}}" class="btn btn-outline-success"><i class="bi bi-pencil-square"></i></a>
                        <a href="/user/hapuspeminjaman/{{$p->kodepeminjaman}}" onclick="return confirm('Apakah anda yakin ingin menghapus data?')" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></a>
                        <a href="/user/konfirmpeminjaman/{{$p->kodepeminjaman}}" class="btn btn-outline-primary"><i class="bi bi-check-lg"></i></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <span class="float-right">{{$peminjaman-> links('pagination::bootstrap-5')}}</span>
    @endif
</div>
@endsection
