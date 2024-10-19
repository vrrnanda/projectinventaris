@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <div class="mb-3 mt-2">
            <a href="{{route('laporanpembelian')}}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        </div>
        <h2> Detail Pembelian Barang</h2>
            @method('PUT')
            <div class="row">
                <div class="col">
                    <label>Kode Pembelian</label>
                    <input type="text" name="kodepembelian" class="form-control" value="{{$pembelian->kodepembelian}}" readonly>
                </div>
                <div class="col">
                <label>Tanggal Pembelian</label>
                    <input type="date" name="tglbeli" class="form-control" value="{{$pembelian->tglbeli}}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Nama Barang</label>
                    <input type="text" name="namabrg" class="form-control" value="{{$pembelian->namabrg}}" readonly>
                </div>
                <div class="col">
                <label>jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{$pembelian->jumlah}}" readonly>
                </div>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Nama Vendor</label>
                    <input type="text" name="vendor" class="form-control" value="{{$pembelian->vendor}}" readonly>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Spesifikasi</label>
                <textarea class="form-control" name="spesifikasi" placeholder="Spesifikasi" rows="5" readonly>{{$pembelian->spesifikasi}}</textarea>
            </div>
            <div class="row">
                <div class="col">
                    <label> Tanggal Terima </label>
                    <input type="date" name="tglterima" class="form-control" value="{{$pembelian->tglterima}}" readonly>
                </div>
                <div class="col">
                    <label> Bukti Nota</label>
                    <br>
                    <img src="{{ asset('storage/nota-pembelian/' . $pembelian->bukti) }}" alt="Bukti Nota">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
