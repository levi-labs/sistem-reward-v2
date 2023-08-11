@extends('pages.report.kop')
@section('surat')
    <center>
        <h4>Laporan Hasil Penilaian Kinerja Karyawan</h4>
        <h4>Periode :
            {{ Carbon\Carbon::parse($dari)->isoFormat('D MMMM Y') . ' - ' . Carbon\Carbon::parse($sampai)->isoFormat('D MMMM Y') }}
        </h4>
    </center>

    <div class="table-print">

        <button type="button" onclick="window.print()" class="btn">&nbsp;Print</button>
        <table class="table table-bordered d-print-table" style="border-collapse: collapse; border: 2px solid black;"
            border="2">
            <thead>
                <tr>
                    <th style="background-color: rgb(251, 215, 158)" class="text-center top-th" rowspan="2">
                        No
                    </th>
                    <th style="background-color: rgb(251, 215, 158)" class="text-center top-th" rowspan="2">
                        Nama
                        Karyawan
                    </th>
                    <th style="background-color: rgb(251, 215, 158)" class="text-center top-th" rowspan="2">
                        Line
                        Produksi
                    </th>
                    <th style="background-color: rgb(251, 215, 158)" class="text-center top-th" colspan="6">
                        Kriteria
                        Penilaian Kinerja
                    </th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <style>
            .space-ttd {
                width: 1000px;
            }

            .ttd-row {
                width: 100%;
            }
        </style>
        <table class="ttd-row">
            <tr>
                <td style="text-align: center">
                    {{-- <b>Bekasi,<br>{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</b><br> --}}
                    <br>
                    <br><br><br>
                    <p>Diperiksa</p>,
                    <br><br><br>
                    <br>

                    <hr width="100px">
                </td>
                <td class="space-ttd"></td>
                <td style="text-align: center">
                    <b>Bekasi,<br><br>{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</b><br>
                    <br><br>
                    <p>Disetujui</p>,
                    <br><br><br>
                    <br>

                    <hr width="100px">
                </td>
            </tr>
        </table>


    </div>
@endsection
