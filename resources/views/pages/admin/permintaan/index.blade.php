@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="mb-3 mt-2">
        @if($isFiltered)
            <a href="{{ route('permintaanadmin') }}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        @endif
    </div>
    <h1 class="h3 mb-4 text-gray-800 fw-bold"> Daftar Permintaan Barang </h1>
    <div class="d-flex justify-content-between mt-2">
        <form action="{{ route('filterpemintaan') }}" method="GET" class="d-flex">
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
            <a href="{{ route('printpermintaan', ['bulan' => request('bulan')]) }}" class="btn btn-outline-primary mt-2">
                <i class="bi bi-printer"></i> Cetak
            </a>
        </div>
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
    @if($permintaan->isEmpty())
    <div class="alert alert-warning mt-3">
        Tidak ditemukan barang.
    </div>
    @else
    <table class="table table-hover mt-2">
        <thead class="thead-light">
            <tr>
                <th class="text-center" width="40px" scope="col"> No. </th>
                <th class="text-center" width="150px" scope="col"> Kode Permintaan</th>
                <th class="text-center" width="80px" scope="col"> Tanggal Permintaan</th>
                <th class="text-center" width="90px" scope="col"> Ruangan</th>
                <th class="text-center" width="150px" scope="col"> Nama Barang</th>
                <th class="text-center" width="50px" scope="col"> Jumlah</th>
                <th class="text-center" width="90px" scope="col"> Status</th>
                <th class="text-center" width="150px" scope="col"> Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permintaan as $no => $pm )
            <tr>
                <th class="text-center" scope="row">{{$permintaan-> firstItem() +$no}}</th>
                <td class="text-center">{{ $pm->kodepermintaan}}</td>
                <td class="text-center">{{ $pm->tglpermintaan}}</td>
                <td class="text-center">{{ $pm->ruangan}}</td>
                <td class="text-center">{{ $pm->namabrg}}</td>
                <td class="text-center">{{ $pm->jumlah}}</td>
                <td class="text-center">
                    @if (is_null($pm->status))
                        <span class="badge badge-info">Menunggu dikonfirmasi</span>
                    @elseif ($pm->status == 'permintaan disetujui')
                        <span class="badge badge-warning">Permintaan disetujui</span>
                    @elseif ($pm->status == 'dalam proses pembelian')
                        <span class="badge badge-primary"> Pembelian Barang</span>
                    @elseif($pm->status == 'permintaan ditolak')
                        <span class="badge badge-danger">Permintaan ditolak</span>
                    @endif
                </td>
                <td class="text-center">
                    <div class="action-buttons">
                        <a href="" class="btn btn-outline-info"><i class="bi bi-eye"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <span class="float-right">{{$permintaan-> links('pagination::bootstrap-5')}}</span>
    @endif
    </div>
@endsection
