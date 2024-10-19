@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <div class="mb-3 mt-2">
            <a href="{{route('barangmanajemen')}}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        </div>
        <h2> Detail Barang</h2>
            @method('PUT')
            <div class="row">
                <div class="col">
                    <label>Kode Barang</label>
                    <input type="text" name="kodebrg" class="form-control" value="{{$barang->kodebrg}}" readonly>
                </div>
                <div class="col">
                <label>Nama Barang</label>
                    <input type="text" name="namabrg" class="form-control" value="{{$barang->namabrg}}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col mt-2">
                    <label> Kategori </label>
                    <input type="text" name="namabrg" class="form-control" value="{{$barang->kategori}}" readonly>
                </div>
                <div class="col mt-2">
                <label>jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{$barang->jumlah}}" readonly>
                </div>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Spesifikasi</label>
                <textarea class="form-control" name="spesifikasi" placeholder="Spesifikasi" rows="8" readonly>{{$barang->spesifikasi}}</textarea>
            </div>
        </form>
    </div>
</div>
@endsection
