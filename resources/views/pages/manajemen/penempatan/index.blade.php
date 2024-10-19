@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
    <div class="mb-3 mt-2">
        @if($isFiltered)
            <a href="{{ route('penempatanmanajemen') }}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        @endif
    </div>
    <h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Pembelian Barang</h1>
    <div class="d-flex justify-content-between">
        <form action="{{ route('filterpenempatanmanajemen') }}" method="GET" class="d-flex">
            <select name="bulan" id="bulan" class="form-select" onchange="this.form.submit()">
                <option value="">Pilih Bulan </option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                    </option>
                @endfor
            </select>
        </form>
        <div class="d-flex justify-content-end">
            <a href="{{ route('printpenempatanmanajemen', ['bulan' => request('bulan')]) }}" class="btn btn-outline-primary mt-2">
                <i class="bi bi-printer"></i> Cetak
            </a>
        </div>
    </div>
<form class="form-inline d-flex w-50" method="GET" action="">
    <input class="form-control me-2 w-50 mt-2" name="cari" type="text" placeholder="Pencarian">
    <button class="btn btn-outline-primary mt-2" type="submit"><i class="bi bi-search"></i></i></button>
</form>
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
            <td class="text-leftr">{{ $p->kodepenempatan}}</td>
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
                @elseif($p->status=='selesai')
                    <span class="badge badge-success"> Selesai</span>
                @endif
            </td>
            <td class="text-left">
                <div class="action-buttons">
                    <a href="/manajemen/detailpenempatan/{{ $p->kodepenempatan}}" class="btn btn-outline-info"><i class="bi bi-eye"></i></a>
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
