@extends('layout.master')
@section('content')
    <div class="row justify-content-center d-print-none">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-print-none">{{ $title }}</h4>
                    {{-- <p class="card-description"> Basic form elements </p> --}}
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $item)
                                <li><span>{{ $item }}</span></li>
                            @endforeach

                        </div>
                    @endif



                    <form class="forms-sample mt-5" action="{{ url('/report-print') }}" method="post" target="_blank">
                        @csrf
                        <div class="form-group">
                            <label for="npk">Dari Tanggal</label>
                            <input type="date" class="form-control" placeholder="<40" name="dari">
                        </div>
                        <div class="form-group">
                            <label for="nama">Sampai Tanggal</label>
                            <input type="date" class="form-control" id="nama" name="sampai">
                        </div>

                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                        <a href="{{ url('report-penilaian') }}"" class="btn btn-light">Cancel</a>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <style>
        .the-kop {
            display: none;
        }

        @media print {
            .the-kop {
                display: block;
                margin: auto !important;

            }

            body {


                display: inline-block;
            }

            table {
                margin: auto !important;
                width: 100% !important;
                -webkit-print-color-adjust: exact;
            }

            th,
            td {

                text-align: center
            }

            .top-th {
                background-color: rgb(251, 215, 158);
            }


        }
    </style>
    @if (isset($data))
        <div class="row justify-content-center">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-print-none">{{ $title }}</h4>

                        <button onclick="window.print()" class="btn btn-dark btn-sm my-2 d-print-none">Print</button>
                        {{-- <p class="card-description"> Basic form elements </p> --}}
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                @foreach ($errors->all() as $item)
                                    <li><span>{{ $item }}</span></li>
                                @endforeach

                            </div>
                        @endif
                        @if (session('failed'))
                            <div class="alert alert-danger d-print-none" role="alert">
                                <p> {{ session('failed') }}</p>
                            </div>
                        @endif
                        <center class="the-kop">
                            <table class="my-kop" width="580">
                                <tr>
                                    <td>
                                        <img width="90" height="90" src="{{ asset('assets/denso-craft.png') }}"
                                            alt="">
                                    </td>
                                    <td>
                                        <center>
                                            <font size="4"> <b>PT DENSO INDONESIA</b></font><br>

                                            <font size="2">Jl.Kalimantan Blok E 1-2 Kawasan Industri MM2100</font><br>
                                            <font size="3"><b>Cikarang Barat, Bekasi 17520, Indonesia</b></font><br>
                                            <font size="3"><b>Tel: (62-21) 8980303</b></font><br>
                                        </center>

                                    </td>
                                </tr>


                            </table>
                            <hr style="border-top: 2px solid black;">
                            <hr style="border-top: 2px solid black; margin-top:-7px;">
                            <br>




                        </center>

                        <table class="table table-bordered d-print-table"
                            style="border-collapse: collapse; border: 2px solid black;" border="2">
                            <thead>
                                <tr>
                                    <th style="background-color: rgb(251, 215, 158)" class="text-center top-th"
                                        rowspan="2">
                                        No</th>

                                    <th style="background-color: rgb(251, 215, 158)" class="text-center top-th"
                                        rowspan="2">
                                        Nama
                                        Karyawan
                                    </th>
                                    <th style="background-color: rgb(251, 215, 158)" class="text-center top-th"
                                        rowspan="2">
                                        Line
                                        Produksi
                                    </th>
                                    <th style="background-color: rgb(251, 215, 158)" class="text-center top-th"
                                        colspan="6">
                                        Kriteria
                                        Penilaian Kinerja</th>


                                    {{-- <th style="background-color: rgb(251, 215, 158)" rowspan="2" class="text-center">Option
                                    </th> --}}
                                </tr>
                                <tr>
                                    <th class="top-th" style="background-color: rgb(159, 202, 86)">Pengajuan</th>
                                    <th class="top-th" style="background-color: rgb(159, 202, 86)">Kehadiran</th>
                                    <th class="top-th" style="background-color: rgb(159, 202, 86)">Meeting</th>
                                    <th class="top-th" style="background-color: rgb(159, 202, 86)">Total</th>
                                    <th class="top-th" style="background-color: rgb(159, 202, 86)">Reward</th>
                                    <th class="top-th" style="background-color: rgb(159, 202, 86)">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dt)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dt->nama }}</td>
                                        <td>{{ $dt->line_produksi }}</td>
                                        <td>{{ $dt->pengajuan }}</td>
                                        <td>{{ $dt->meeting }}</td>
                                        <td>{{ $dt->kehadiran }}</td>
                                        <td>{{ $dt->total }}</td>
                                        <td>{{ $dt->reward }}</td>
                                        <td>{{ $dt->tanggal }}</td>


                                        {{-- <td>

                                            <a href="{{ url('edit-nilai/' . $dt->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <a href="{{ url('delete-nilai/' . $dt->id) }}" class="btn btn-danger btn-sm"
                                                onclick="javascript:return confirm('yakin ingin menghapus data ini?')">Hapus</a>
                                        </td> --}}

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <center class="the-kop">
                            <br>
                            <br>
                            <br>
                            <table width="690">
                                <tr>
                                    <td width="600"></td>
                                    <td style="text-align: center">
                                        <b>Bekasi,<br>{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</b><br>
                                        Diperiksa,
                                        <br><br> <br><br><br>


                                        <hr width="100px">
                                    </td>
                                    <td width="50"></td>
                                    <td style="text-align: center">
                                        <b>Bekasi,<br>{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</b><br>
                                        Disetujui,
                                        <br><br> <br><br><br>


                                        <hr width="100px">
                                    </td>
                                </tr>
                            </table>
                        </center>

                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
