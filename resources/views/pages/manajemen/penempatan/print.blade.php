<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Laporan Penempatan Barang</title>
        <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">

        <style>
            body {
                font-family: Arial, sans-serif;
            }
            .header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 10px;
                border-bottom: 2px solid #000;
            }
            .header .logo {
                width: 15%;
            }
            .header .logo img {
                width: 100%;
                height: auto;
            }
            .header .details {
                width: 80%;
                text-align: left;
            }
            .header .details h1 {
                margin: 0;
                color: #a52a2a;
                font-size: 25px;
                font-weight: bold;
            }
            .header .details p {
                margin: 0;
                font-size: 15px;
                line-height: 1.4;
            }
            .content {
                margin: 20px;
                font-size: 13px;
            }
            .content table {
                width: 100%;
                border-collapse: collapse;
            }
            .content table, .content th, .content td {
                border: 1px solid black;
            }
            .content th, .content td {
                padding: 10px;
                text-align: left;
            }
            .footer {
                margin-top: 30px;
                text-align: right;
                font-size: 10px;
                display: flex;
                justify-content: center;
                align-items: center;
                border-top: 1px solid black;
                padding: 10px 0;
            }
            .footer span {
                margin: 0 5px;
            }
            .footer a {
                text-decoration: none;
                color: black;
            }
            .footer a:hover {
                text-decoration: underline;
            }
            .footer .icon {
                font-family: Arial, sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="logo">
                <img src="{{ storage_path('app/public/img/logos/logobaru.png') }}" alt="Logo Bethesda">
            </div>
            <div class="details">
                <h1>RUMAH SAKIT BETHESDA</h1>
                <p>Sekretariat: 586695 &nbsp;&nbsp; Piutang: 586706</p>
                <p>Humas & Pemasaran: 586701 &nbsp;&nbsp; AKPN: 586703</p>
                <p>Pendaftaran: 521249 & 521250 &nbsp;&nbsp; P.O. BOX: 1124 YK</p>
                <p>Gawat Darurat: 586708 & 7475118 &nbsp;&nbsp; Facsimile: 563312 & 521251</p>
            </div>
        </div>

        <div class="content">
            <div class="report-title mt-2">
                <strong><center> {{$title}}</center></strong>
            </div>
            <table class="table table-hover mt-5">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center" scope="col"> No. </th>
                        <th class="text-center" scope="col"> Kode Penempatan</th>
                        <th class="text-center" scope="col"> Tanggal Penempatan</th>
                        <th class="text-center" scope="col"> Ruangan</th>
                        <th class="text-center" scope="col"> Nama Barang</th>
                        <th class="text-center" scope="col"> Kategori</th>
                        <th class="text-center" scope="col"> Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penempatan as $index => $p )
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $p->kodepenempatan}}</td>
                        <td class="text-center">{{ $p->tglpenempatan}}</td>
                        <td class="text-center">{{ $p->ruangan}}</td>
                        <td class="text-center">{{ $p->namabrg}}</td>
                        <td class="text-center">{{ $p->kategori}}</td>
                        <td class="text-center">{{ $p->jumlah}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="footer">
            <span>JL. JEND. SUDIRMAN 70</span>
            <span class="icon"><img src="{{storage_path('app/public/img/icon/telephone.png')}}" alt="Phone Icon" style="height: 10px;"></span>
            <span>(0274) 566868, 562246</span>
            <span>YOGYAKARTA 55224</span>
            <span>|</span>
            <span>Email: <a href="mailto:bethesda_yogyakarta@bethesda.or.id">bethesda_yogyakarta@bethesda.or.id</a></span>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>
        <!-- Page level plugins -->
        <script src="{{asset('assets/vendor/chart.js/Chart.min.js')}}"></script>
        <!-- Page level custom scripts -->
        <script src="{{asset('assets/js/demo/chart-area-demo.js')}}"></script>
        <script src="{{asset('assets/js/demo/chart-pie-demo.js')}}"></script>
    </body>
</html>
