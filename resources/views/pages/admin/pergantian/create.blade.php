@extends('layouts.admin.main')
@section('tabel')
<div class="container-fluid">
    <div class="col-lg-10 vh-100 p-2">
        <h2> Form Pergantian Barang</h2>
        <form action="/admin/simpanpergantian" method="POST">
            @csrf
            <div class="mb-3">
                <label>Kode Pergantian</label>
                <input type="text" name="kodepergantian" class="form-control" value="{{$kodePergantian}}" readonly>
            </div>
            <div class="row">
                <div class="col">
                    <label>Tanggal Pergantian</label>
                    <input type="date" name="tglpergantian" class="form-control" required>
                </div>
                <div class="col">
                    <label> Ruangan</label>
                    <select class="form-select single-select-field" name="ruangan">
                        <option value="" disabled selected hidden>Pilih Ruangan</option>
                        @foreach ($ruangan as $item)
                        <option value="{{$item->namaruang}}">{{$item->namaruang}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <label> Nama Barang</label>
                    <select class="form-select single-select-field" name="namabrg">
                        <option value="" disabled selected hidden>Pilih Barang</option>
                        @foreach ($barang as $item)
                        <option value="{{$item->namabrg}}"> {{ $item->namabrg}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label> Jumlah </label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
            </div>
            <div class="mb-3 mt-2">
                <label> Keterangan</label>
                <textarea class="form-control" name="keterangan" placeholder="Keterangan" rows="5" required></textarea>
            </div>
            <div class="form-group w-25 mt-2 p-2">
                <input type="submit" value="Simpan" class="btn btn-outline-primary">
            </div>
        </form>
    </div>
</div>
@endsection
