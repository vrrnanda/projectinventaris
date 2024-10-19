@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
<h1 class="h3 mb-4 text-gray-800 fw-bold">Beranda</h1>
<div class="row d-flex justify-content-start">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="action-buttons">
                            <a href="/manajemen/barangmasuk" class="font-weight-bold text-lg">Barang Masuk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="action-buttons">
                            <a href="/manajemen/barangkeluar" class="font-weight-bold text-lg">Barang Keluar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="action-buttons">
                            <a href="/manajemen/persedianbarang" class="font-weight-bold text-lg">Persediaan Barang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="action-buttons">
                            <a href="/manajemen/lokasibarang" class="font-weight-bold text-lg">Lokasi Barang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
