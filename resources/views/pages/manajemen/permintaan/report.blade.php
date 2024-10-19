@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
    <div class="mb-3 mt-2">
        @if($isFiltered)
            <a href="{{ route('reportpermintaanmanajemen') }}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        @endif
    </div>
    <h1 class="h3 mb-4 text-gray-800 fw-bold"> Daftar Permintaan Barang </h1>
    <div class="d-flex justify-content-between">
        <form action="{{ route('filterpermintaanmanajemen') }}" method="GET" class="d-flex">
            <select name="bulan" id="bulan" class="form-select me-2" onchange="this.form.submit()">
                <option value="">Pilih Bulan </option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                    </option>
                @endfor
            </select>
        </form>
        <div class="d-flex justify-content-end">
            <a href="{{ route('printpermintaanmanajemen', ['bulan' => request('bulan')]) }}" class="btn btn-outline-primary mt-2">
                <i class="bi bi-printer"></i> Cetak
            </a>
        </div>
    </div>
    <form class="form-inline d-flex w-50" method="GET" action="">
        <input class="form-control me-2 w-50 mt-2" name="cari" type="text" placeholder="Pencarian">
        <button class="btn btn-outline-primary mt-2" type="submit"><i class="bi bi-search"></i></i></button>
    </form>
    @if($permintaan->isEmpty())
        <div class="alert alert-warning mt-3">
            Tidak ditemukan barang.
        </div>
    @else
    <table class="table table-hover mt-2">
        <thead class="thead-light">
            <tr>
                <th class="text-center" width="40px" scope="col"> No. </th>
                <th class="text-center" width="90px" scope="col"> Kode Permintaan</th>
                <th class="text-center" width="150px" scope="col"> Nama Barang</th>
                <th class="text-center" width="60px" scope="col"> Tanggal Permintaan</th>
                <th class="text-center" width="80px" scope="col"> Ruangan</th>
                <th class="text-center" width="250px" scope="col"> Keterangan</th>
                <th class="text-center" width="50px" scope="col"> Status</th>
                <th class="text-center" width="250px" scope="col"> Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permintaan as $no => $pm )
            <tr>
                <th class="text-justify" scope="row">{{$permintaan-> firstItem() +$no}}</th>
                <td class="text-justify">{{ $pm->kodepermintaan}}</td>
                <td class="text-justify">{{ $pm->namabrg}}</td>
                <td class="text-justify">{{ $pm->tglpermintaan}}</td>
                <td class="text-justify">{{ $pm->ruangan}}</td>
                <td class="text-justify">{{ $pm->keterangan}}</td>
                <td class="text-justify">{{ $pm->status}}</td>
                <td class="text-justify">{{ $pm->catatan}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <span class="float-right">{{$permintaan-> links()}}</span>
    @endif
</div>
@endsection
