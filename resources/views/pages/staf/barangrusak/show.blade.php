@extends('layouts.staf.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <div class="mb-3 mt-2">
            <a href="{{route('barangrusakstaf')}}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        </div>
        <h2> Detail Laporan Barang Rusak</h2>
        @method('PUT')
        <div class="row">
            <div class="col">
                <label>Kode Laporan</label>
                <input type="text" name="kodelaporan" class="form-control" value="{{$barangrusak->kodelaporan}}" readonly>
            </div>
            <div class="col">
            <label>Tanggal Laporan</label>
                <input type="text" name="tgllapor" class="form-control" value="{{$barangrusak->tgllapor}}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col mt-2">
            <label> Ruangan </label>
                <input type="text" name="ruangan" class="form-control" value="{{$barangrusak->ruangan}}" readonly>
            </div>
            <div class="col mt-2">
            <label>Nama Barang</label>
                <input type="text" name="namabrg" class="form-control" value="{{$barangrusak->namabrg}}" readonly>
            </div>
        </div>
        <div class="mb-3 mt-2">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" placeholder="Spesifikasi" rows="3" readonly>{{$barangrusak->deskripsi}}</textarea>
        </div>
    </form>
</div>
</div>
@endsection
