@extends('layout.master')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card ">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title d-print-none">{{ $title }}</h4>
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif(session('failed'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('failed') }}
                    </div>
                @endif

                {{-- <p class="card-description"> Add class <code>.table-hover</code>
                </p> --}}
                <div class="row justify-content-between">
                    <div class="col-md-7 mb-3 d-print-none">
                        <a href="{{ url('/tambah-nilai') }}" class="btn btn-primary btn-sm ">Tambah</a>

                        <button onclick="window.print()" class="btn btn-secondary btn-sm">Print</button>
                    </div>
                    <div class="col-md-5 d-print-none text-right">
                        <form action="{{ url('cetak-nilai') }}" method="POST">
                            @csrf
                            <label for="npk">Dari</label>
                            <input type="date" name="dari">


                            <label for="npk">Sampai</label>
                            <input type="date" name="sampai">
                            <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                        </form>


                    </div>
                </div>

                <style>
                    .the-kop {
                        display: none;
                    }

                    @media print {
                        .the-kop {
                            display: block;

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
                @if (isset($title2))
                    <div class="alert alert-info d-print-none">
                        <h5>{{ $title2 }}</h5>
                    </div>
                @endif

                <table class="table table-bordered" style="border-collapse: collapse; border: 1px solid black;">
                    <thead>
                        <tr>
                            <th style="background-color: rgb(251, 215, 158)" class="text-center" rowspan="2">No</th>

                            <th style="background-color: rgb(251, 215, 158)" class="text-center" rowspan="2">Nama
                                Karyawan
                            </th>
                            <th style="background-color: rgb(251, 215, 158)" class="text-center" rowspan="2">Line
                                Produksi
                            </th>
                            <th style="background-color: rgb(251, 215, 158)" class="text-center" colspan="6">Kriteria
                                Penilaian Kinerja</th>


                            <th style="background-color: rgb(251, 215, 158)" rowspan="2"
                                class="text-center d-print-none">Option</th>
                        </tr>
                        <tr>
                            <th style="background-color: rgb(159, 202, 86)">Pengajuan</th>
                            <th style="background-color: rgb(159, 202, 86)">Kehadiran</th>
                            <th style="background-color: rgb(159, 202, 86)">Meeting</th>
                            <th style="background-color: rgb(159, 202, 86)">Total</th>
                            <th style="background-color: rgb(159, 202, 86)">Reward</th>
                            <th style="background-color: rgb(159, 202, 86)">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $dt)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dt->karyawans->nama }}</td>
                                <td>{{ $dt->karyawans->line_produksi }}</td>
                                <td>{{ $dt->pengajuan }}</td>
                                <td>{{ $dt->meeting }}</td>
                                <td>{{ $dt->kehadiran }}</td>
                                <td>{{ $dt->total }}</td>
                                <td>{{ $dt->reward }}</td>
                                <td>{{ $dt->tanggal }}</td>


                                <td class="d-print-none">

                                    <a href="{{ url('edit-nilai/' . $dt->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{ url('delete-nilai/' . $dt->id) }}" class="btn btn-danger btn-sm"
                                        onclick="javascript:return confirm('yakin ingin menghapus data ini?')">Hapus</a>
                                </td>

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
@endsection
