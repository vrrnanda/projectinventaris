@extends('layouts.user.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
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
            <div class="col">
            <label> Ruangan</label>
                <input type="text" name="ruangan" class="form-control" value="{{$barangrusak->ruangan}}" readonly>
            </div>
            <div class="col">
            <label>Nama Barang</label>
                <input type="text" name="namabrg" class="form-control" value="{{$barangrusak->namabrg}}" readonly>
            </div>
        </div>
        <div class="mb-3 mt-2">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" rows="5" readonly>{{$barangrusak->deskripsi}}</textarea>
        </div>
    </form>
</div>
</div>
@endsection
