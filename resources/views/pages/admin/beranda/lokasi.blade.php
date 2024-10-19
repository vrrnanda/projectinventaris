@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
<h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Penempatan Barang</h1>
<div class="mb-3 mt-2">
    @if(request('ruangan') || request('bulan'))
        <a href="{{ route('lokasiadmin') }}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
    @endif
</div>
<div class="d-flex justify-content-between">
    <form action="{{route('filterlokasiadmin')}}" method="GET" class="me-2">
        <select class="form-select" name="ruangan" id="ruangan" onchange="this.form.submit()">
            <option value="" disabled selected hidden>Pilih Ruangan</option>
            @foreach ($ruanganList as $item)
                <option value="{{ $item->namaruang }}">{{ $item->namaruang }}</option>
            @endforeach
        </select>
    </form>
    <form action="{{route('filterlokasiadmin')}}" method="GET">
        <select name="bulan" id="bulan" class="form-select" onchange="this.form.submit()">
            <option value="">Pilih Bulan </option>
            @for($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                </option>
            @endfor
        </select>
    </form>
</div>
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
            <th class="text-center" scope="col"> Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($penempatan as $no => $p )
        <tr>
            <th class="text-center" scope="row">{{$penempatan-> firstItem() +$no}}</th>
            <td class="text-center">{{ $p->kodepenempatan}}</td>
            <td class="text-center">{{$p->tglpenempatan}}</td>
            <td class="text-center">{{ $p->ruangan}}</td>
            <td class="text-justify">{{ $p->namabrg}}</td>
            <td class="text-center">{{ $p->jumlah}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<span class="float-right">{{$penempatan-> links()}}</span>
@endif
</div>
@endsection
