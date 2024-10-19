@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <div class="mb-3 mt-2">
            <a href="{{route('barangterbuangadmin')}}" class="btn btn-outline-primary"><i class="bi bi-chevron-left"></i>Kembali</a>
        </div>
        <h2> Detail Penghapusan Barang</h2>
        @method('PUT')
            <div class="mb-3 mt-1">
                <label>Kode Hapus</label>
                <input type="text" name="kodehapus" class="form-control" value="{{$barangterbuang->kodehapus}}" readonly>
            </div>
            <div class="row">
                <div class="col">
                    <label> Nama Barang</label>
                    <input type="text" name="namabrg" class="form-control" value="{{$barangterbuang->namabrg}}" readonly>
                </div>
                <div class="col">
                <label>jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{$barangterbuang->jumlah}}" readonly>
                </div>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Status</label>
                <input type="text" name="status" class="form-control" value="{{$barangterbuang->status}}" readonly>
            </div>
        </form>
    </div>
</div>
@endsection
