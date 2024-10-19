@extends('layouts.staf.main')
@section('tabel')
<div class="container-fluid">
    <div class="mb-3 mt-2">
        @if($isFiltered)
            <a href="{{ route('barangrusakstaf') }}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        @endif
    </div>
    <h1 class="h3 mb-4 text-gray-800 fw-bold">Daftar Laporan Barang Rusak</h1>
    <form class="form-inline d-flex w-50" method="GET" action="/staf/caribarangrusak">
        <input class="form-control me-2 w-50 mt-2" name="cari" type="text" placeholder="Pencarian">
        <button class="btn btn-outline-primary mt-2" type="submit"><i class="bi bi-search"></i></i></button>
    </form>
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if($barangrusak->isEmpty())
    <div class="alert alert-warning mt-3">
        Tidak ditemukan barang.
    </div>
    @else
    <table class="table table-hover mt-2">
        <thead class="thead-light">
            <tr>
                <th class="text-center" width="30px" scope="col"> No. </th>
                <th class="text-center" width="90px" scope="col"> Kode Laporan</th>
                <th class="text-center" width="90px" scope="col"> Tanggal Laporan</th>
                <th class="text-center" width="200px" scope="col"> Nama Barang</th>
                <th class="text-center" width="90px" scope="col"> Ruangan</th>
                <th class="text-center" width="100px" scope="col"> Penanganan</th>
                <th class="text-center" width="90px" scope="col"> Status</th>
                <th class="text-center" width="90px" scope="col"> Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangrusak as $no => $br )
            <tr>
                <th class="text-center" scope="row">{{$barangrusak-> firstItem() +$no}}</th>
                <td class="text-center">{{ $br->kodelaporan}}</td>
                <td class="text-center">{{ $br->tgllaporan}}</td>
                <td class="text-left">{{ $br->namabrg}}</td>
                <td class="text-center">{{ $br->ruangan}}</td>
                <td class="text-center">
                    @if(is_null($br->penanganan))
                        <span class= "badge badge-info">Belum diproses</span>
                    @elseif($br->penanganan)
                        <span> {{$br->penanganan}} </span>
                    @endif
                </td>
                <td class="text-center">
                    @if($br->status === 'sedang diproses')
                        <span class="badge badge-warning">Sedang diproses</span>
                    @elseif($br->status == 'selesai')
                        <span class="badge badge-success">Selesai</span>
                    @endif
                </td>
                <td class="text-center">
                    <a href="/staf/detailbarangrusak/{{$br->kodelaporan}}" class="btn btn-outline-info"><i class="bi bi-eye"></i></i></a>
                    <a href="/staf/konfirmasibarangrusak/{{$br->kodelaporan}}" class="btn btn-outline-primary"><i class="bi bi-check-lg"></i></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <span class="float-right">{{$barangrusak-> links('pagination::bootstrap-5')}}</span>
    @endif
</div>
@endsection
