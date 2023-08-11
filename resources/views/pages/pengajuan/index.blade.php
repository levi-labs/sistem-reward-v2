@extends('layout.master')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
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
                @if (auth()->user()->akses_user == 'karyawan')
                    <div class="row justify-content-between">
                        <div class="col-md-9 mb-3 d-print-none">
                            @php
                                $appcek = \App\Models\Aktivasi::where('id', 1)->first();
                            @endphp
                            @if ($appcek->status_aktif == 'enable')
                                <a href="{{ url('/tambah-pengajuan') }}" class="btn btn-primary btn-sm">Tambah</a>
                            @endif
                            {{-- <button onclick="window.print()" class="btn btn-secondary btn-sm">Print</button> --}}
                        </div>

                        <div class="col-md-3 d-print-none text-right">
                            <style>
                                .input-group-append {
                                    cursor: pointer;
                                }
                            </style>
                            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

                            <form action="{{ url('periode-pengajuan') }}" method="POST" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm month" id="tgl"
                                            name="periode">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-gradient-primary" type="submit">Cari</button>
                                        </div>
                                    </div>
                                </div>

                            </form>


                        </div>


                    </div>
                @elseif(auth()->user()->akses_user == 'atasan')
                    <div class="row justify-content-between">
                        <div class="col-md-6 mb-3 d-print-none">


                            {{-- <button onclick="window.print()" class="btn btn-secondary btn-sm">Print</button> --}}
                        </div>
                        <div class="col-md-6 d-print-none text-right">
                            <div class="row justify-content-end">
                                <div class="col-6">
                                    <form action="{{ url('periode-pengajuan') }}" method="POST" autocomplete="off">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm month"
                                                    id="tgl" name="periode">
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-gradient-primary"
                                                        type="submit">Cari</button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>



                        </div>
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
                <style>
                    .the-kop {
                        display: none;
                    }

                    .table .table-bordered {
                        font-size: 11px !important;
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

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPK</th>
                            <th>Nama Karyawan</th>
                            <th>Status Karyawan</th>
                            <th>Judul Pengajuan</th>
                            <th>Tanggal</th>
                            {{-- <th>Kondisi Sebelum</th>
                            <th>Kondisi Sesudah</th> --}}
                            <th class="d-print-none">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $dt)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dt->npk }}</td>
                                <td>{{ $dt->nama }}</td>
                                <td>{{ $dt->status_karyawan }}</td>
                                <td>{{ $dt->judul_pengajuan }}</td>
                                <td>{{ $dt->tanggal_pengajuan }}</td>
                                {{-- <td>{{ $dt->kondisi_sebelum }}</td>
                                <td>{{ $dt->kondisi_sesudah }}</td> --}}
                                <td class="d-print-none">
                                    <a href="{{ url('detail-pengajuan/' . $dt->id) }}"
                                        class="btn btn-success btn-sm">Detail</a>
                                    <a href="{{ url('edit-pengajuan/' . $dt->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{ url('delete-pengajuan/' . $dt->id) }}" class="btn btn-danger btn-sm"
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $('document').ready(function($) {
            $(function() {
                $('#tgl').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    format: "mm-yyyy",
                    startView: "months",
                    minViewMode: "months"
                });
            });
        });
    </script>

@endsection
