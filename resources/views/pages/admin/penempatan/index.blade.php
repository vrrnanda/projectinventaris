@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="mb-3 mt-2">
        @if($isFiltered)
            <a href="{{ route('penempatanadmin') }}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        @endif
    </div>
    <h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Penempatan Barang</h1>
    <div class="d-flex justify-content-between">
        <a href="/admin/tambahpenempatanbarang" class="btn btn-outline-primary mt-2"><i class="bi bi-plus-square-fill"></i> Tambah Data </a>
    </div>
    <div class="d-flex justify-content-between mt-2">
        <form action="{{ route('filterpenempatan') }}" method="GET" class="d-flex">
            <select name="bulan" id="bulan" class="form-select" onchange="this.form.submit()">
                <option value="">Pilih Bulan </option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                    </option>
                @endfor
            </select>
        </form>
        <div class="d-flex justify-content-end mt-2">
            <a href="{{ route('printpenempatan', ['bulan' => request('bulan')]) }}" class="btn btn-outline-primary mt-2">
                <i class="bi bi-printer"></i> Cetak
            </a>
        </div>
    </div>
    <form class="form-inline d-flex w-50" method="GET" action="/admin/">
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
                <th class="text-left" scope="row">{{$penempatan-> firstItem() +$no}}</th>
                <td class="text-left">{{ $p->kodepenempatan}}</td>
                <td class="text-left">
                    @if (is_null($p->tglpenempatan))
                        <span class="badge badge-info"> Belum Ditempatkan</span>
                    @elseif($p->status='selesai')
                        <span> {{$p->tglpenempatan}}</span>
                    @endif
                </td>
                <td class="text-left">{{ $p->ruangan}}</td>
                <td class="text-left">{{ $p->namabrg}}</td>
                <td class="text-left">{{ $p->kategori}}</td>
                <td class="text-left">{{ $p->jumlah}}</td>
                <td class="text-left">
                    @if (is_null($p->status))
                        <span class="badge badge-info"> Belum Ditempatkan</span>
                    @elseif($p->status=='ceklis')
                        <span class="badge badge-warning"> Sedang diproses</span>
                    @elseif($p->status=='selesai')
                        <span class="badge badge-success"> Selesai</span>
                    @endif
                </td>
                <td class="text-center">
                    <div class="action-buttons">
                        <a href="/admin/detailpenempatan/{{ $p->kodepenempatan}}" class="btn btn-outline-info"><i class="bi bi-eye"></i></a>
                        <a href="/admin/editpenempatan/{{ $p->kodepenempatan}}" class="btn btn-outline-success"><i class="bi bi-pencil-square"></i></a>
                        <a href="/admin/hapuspenempatan/{{ $p->kodepenempatan}}" onclick="return confirm('Apakah anda yakin ingin menghapus data?')" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></a>
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
