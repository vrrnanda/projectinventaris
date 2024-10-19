@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
    <div class="mb-3 mt-2">
        @if($isFiltered)
            <a href="{{ route('barangterbuangadmin') }}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        @endif
    </div>
    <h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Barang Terbuang</h1>
    <div class="d-flex justify-content-between">
        <a href="/manajemen/cetakpengahpusan" class="btn btn-outline-primary mt-2"><i class="bi bi-printer"></i> Cetak </a>
    </div>
    <div class="d-flex justify-content-between mt-2">
        <form action="{{ route('filterbarangterbuang') }}" method="GET" class="d-flex">
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
            <a href="{{ route('printbarangterbuang', ['bulan' => request('bulan')]) }}" class="btn btn-outline-primary mt-2">
                <i class="bi bi-printer"></i> Cetak
            </a>
        </div>
    </div>
    <form class="form-inline d-flex w-50" method="GET" action="/admin/caribarang">
        <input class="form-control me-2 w-50 mt-2" name="cari" type="text" placeholder="Pencarian">
        <button class="btn btn-outline-primary mt-2" type="submit"><i class="bi bi-search"></i></i></button>
    </form>
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if($barangterbuang->isEmpty())
    <div class="alert alert-warning mt-3">
        Tidak ditemukan barang.
    </div>
    @else
    <table class="table table-hover mt-2">
        <thead class="thead-light">
            <tr>
                <th class="text-center" width="40px" scope="col"> No. </th>
                <th class="text-center" width="100px" scope="col"> Kode Hapus</th>
                <th class="text-center" width="100px" scope="col"> Tanggal Laporan</th>
                <th class="text-center" width="200px" scope="col"> Nama Barang</th>
                <th class="text-center" width="200px" scope="col"> Jumlah</th>
                <th class="text-center" width="50px" scope="col"> Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangterbuang as $no => $bh)
            <tr>
                <th class="text-center" scope="row">{{$barangterbuang-> firstItem() +$no}}</th>
                <td class="text-center">{{ $bh->kodehapus}}</td>
                <td class="text-center">{{ $bh->tglhapus}}</td>
                <td class="text-center">{{ $bh->namabrg}}</td>
                <td class="text-center">{{ $bh->jumlah}}</td>
                <td class="text-center">{{ $bh->status}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <span class="float-right">{{$barangterbuang-> links('pagination::bootstrap-5')}}</span>
    @endif
    </div>
@endsection
