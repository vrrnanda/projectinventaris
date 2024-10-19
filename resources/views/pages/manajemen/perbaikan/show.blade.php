@extends('layouts.manajemen.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Detail Perbaikan Barang</h2>
        <div class="mb-3 mt-2">
            <a href="{{route('perbaikanmanajemen')}}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        </div>
            @method('PUT')
            <div class="row">
                <div class="col">
                    <label>Kode Laporan</label>
                    <input type="text" name="kodelaporan" class="form-control" value="{{$perbaikan->kodelaporan}}" readonly>
                </div>
                <div class="col">
                <label>Nama Barang</label>
                    <input type="text" name="namabrg" class="form-control" value="{{$perbaikan->namabrg}}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label> Tanggal Perbaikan</label>
                    <input type="date" name="tglperbaikan" class="form-control" value="{{$perbaikan->tglperbaikan}}" readonly>
                </div>
                <div class="col">
                    <label> Vendor </label>
                    <input type="text" name="vendor" class="form-control" value="{{$perbaikan->vendor}}" readonly>
                </div>
                <div class="mb-3 mt-2">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="5" readonly>{{$perbaikan->deskripsi}}</textarea>
                </div>
                <div class="row">
                    <div class="col">
                        <label> Tanggal Selesai Perbaikan</label>
                        <input type="date" name="tglselesai" class="form-control" value="{{$perbaikan->tglselesai}}" readonly>
                    </div>
                    <div class="col">
                        <label> Biaya Perbaikan</label>
                        <input type="number" name="biaya" class="form-control" value="{{$perbaikan->biaya}}" readonly>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <label>Bukti Nota</label>
                    <br>
                    <img src="{{ asset('storage/nota-perbaikan/' . $perbaikan->bukti) }}" alt="Bukti Nota" class="img-fluid">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
