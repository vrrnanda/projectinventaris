@extends('layouts.staf.main')
@section('tabel')
<div class="container-fluid">
    <div class="mb-3 mt-2">
        @if($isFiltered)
            <a href="{{ route('penempatanstaff') }}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        @endif
    </div>
    <h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Penempatan Barang</h1>
    <form class="form-inline d-flex w-50" method="GET" action="/staf/caripenempatan">
        <input class="form-control me-2 w-50 mt-2" name="cari" type="text" placeholder="Pencarian">
        <button class="btn btn-outline-primary mt-2" type="submit"><i class="bi bi-search"></i></i></button>
    </form>
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if($penempatan->isEmpty())
    <div class="alert alert-warning mt-3">
        Tidak ditemukan barang.
    </div>
    @else
    <table class="table table-hover mt-2">
        <thead class="thead-light">
            <tr>
                <th class="text-center" scope="col"> No. </th>
                <th class="text-center" scope="col"> Kode Penempatan</th>
                <th class="text-center" scope="col"> Tanggal Penempatan</th>
                <th class="text-center" scope="col"> Ruangan</th>
                <th class="text-center" scope="col"> Nama Barang</th>
                <th class="text-center" scope="col"> Kategori</th>
                <th class="text-center" scope="col"> Jumlah</th>
                <th class="text-center" scope="col"> Status</th>
                <th class="text-center" scope="col"> Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penempatan as $no => $p )
            <tr>
                <th class="text-center" scope="row">{{$penempatan-> firstItem() +$no}}</th>
                <td class="text-center">{{ $p->kodepenempatan}}</td>
                <td class="text-center">
                    @if (is_null($p->tglpenempatan))
                        <span class="badge badge-info"> Belum Ditempatkan</span>
                    @elseif($p->status='selesai')
                        <span> {{$p->tglpenempatan}}</span>
                    @endif
                </td>
                <td class="text-center">{{ $p->ruangan}}</td>
                <td class="text-center">{{ $p->namabrg}}</td>
                <td class="text-center">{{ $p->kategori}}</td>
                <td class="text-center">{{ $p->jumlah}}</td>
                <td class="text-center">
                    @if (is_null($p->status))
                        <span class="badge badge-info"> Belum Ditempatkan</span>
                    @elseif($p->status=='ceklis')
                        <span class="badge badge-success"> Selesai</span>
                    @elseif($p->status=='selesai')
                        <span class="badge badge-success"> Selesai</span>
                    @endif
                </td>
                <td class="text-center">
                    <div class="action-buttons">
                        <a href="/staf/konfirmasipenempatan/{{$p->kodepenempatan}}" class="btn btn-outline-primary"><i class="bi bi-check-lg"></i></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <span class="float-right">{{$penempatan-> links('pagination::bootstrap-5')}}</span>
    @endif
</div>
@endsection
