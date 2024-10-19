@extends('layouts.staf.main')
@section('tabel')
<div class="container-fluid">
    <div class="mb-3 mt-2">
        @if($isFiltered)
            <a href="{{ route('peminjamanbarangstaf') }}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        @endif
    </div>
    <h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Peminjaman Barang</h1>
    <form class="form-inline d-flex w-50" method="GET" action="/staf/caripeminjaman">
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
                <th class="text-center" width="50px" scope="col"> Tanggal Peminjaman</th>
                <th class="text-center" width="250px" scope="col"> Nama Barang</th>
                <th class="text-center" width="100px" scope="col"> Ruangan</th>
                <th class="text-center" width="40px" scope="col"> Jumlah</th>
                <th class="text-center" width="50px" scope="col"> Status</th>
                <th class="text-center" width="100px" scope="col"> Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $no => $p )
            <tr>
                <th class="text-center" scope="row">{{$peminjaman-> firstItem() +$no}}</th>
                <td class="text-center">{{ $p->kodepeminjaman}}</td>
                <td class="text-center">{{ $p->tglpinjam}}</td>
                <td class="text-center">{{ $p->barangpinjam}}</td>
                <td class="text-center">{{ $p->ruangan}}</td>
                <td class="text-center">{{ $p->jumlah}}</td>
                <td class="text-center">
                    @if($p ->status === 'sedang diproses')
                        <span class="badge badge-warning">Sedang diproses</span>
                        @elseif($p ->status == 'ceklis')
                        <span class="badge badge-success">Selesai</span>
                    @elseif($p ->status == 'selesai')
                        <span class="badge badge-success">Selesai</span>
                    @endif
                </td>
                <td class="text-center">
                    <a href="/staf/konfirmasipeminjamanbarang/{{$p->kodepeminjaman}}" class="btn btn-outline-primary"><i class="bi bi-check-lg"></i></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <span class="float-right">{{$peminjaman-> links('pagination::bootstrap-5')}}</span>
    @endif
</div>
@endsection
