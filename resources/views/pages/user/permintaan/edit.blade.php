@extends('layouts.user.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Permintaan Barang</h2>
        <form action="/user/updatepermintaan/{{$permintaan->kodepermintaan}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Kode Permintaan</label>
                <input type="text" name="kodepermintaan" class="form-control" value="{{$permintaan->kodepermintaan}}" readonly>
            </div>
            <div class="row">
                <div class="col">
                    <label>Tanggal Permintaan</label>
                        <input type="date" name="tglpermintaan" class="form-control" value="{{$permintaan->tglpermintaan}}">
                </div>
                <div class="col">
                    <label> Ruangan</label>
                    <select class="form-select " name="ruangan" value="{{$permintaan->ruangan}}">
                        @foreach ($ruangan as $item)
                        <option value="{{$item->namaruang}}">{{$item->namaruang}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label> Nama Barang </label>
                    <input type="text" name="namabrg" class="form-control" value="{{$permintaan->namabrg}}">
                </div>
                <div class="col">
                    <label> Jumlah </label>
                    <input type="number" name="jumlah" class="form-control" value="{{$permintaan->jumlah}}">
                </div>
            </div>
            <div class="mb-3 mt-2">
                <label class="form-label">Keterangan</label>
                <textarea class="form-control" name="keterangan" rows="5">{{$permintaan->keterangan}}</textarea>
            </div>
            <div class="form-group w-25 mt-2 p-2">
                <input type="submit" value="Simpan" class="btn btn-outline-primary">
            </div>
        </form>
    </div>
</div>
@endsection
