    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{-- <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> --}}
        <title>Document</title>
        <style>
            @media print {
                button.btn {
                    display: none;
                    margin: 5px 5px;
                }

                @page {
                    size: F4 landscape;
                    margin: 10%;
                }
            }

            button.btn {
                margin-bottom: 5px;

            }

            body {
                font-family: Arial, sans-serif;
                width: 100%;
                -webkit-print-color-adjust: exact;
            }

            .my-logo {
                position: absolute;
                float: left;
                margin-left: 10%;
            }

            .the-kop {
                margin: auto;
                width: 100%;
            }

            table tr td {
                font-size: 11px;
            }

            table tr .text {
                text-align: right;
            }

            table.table,
            .table th,
            .table td {
                border: solid black 1px;
                border-collapse: collapse;
            }

            table.table {
                width: 100%;

            }

            .table-print {
                margin: auto;
                width: 90%;

                padding: 1px;
            }

            .isi {
                margin: auto;
                width: 100%;
            }

            .isi td {
                padding: 5px;
            }
        </style>
    </head>

    <body>
        <center>
            <table class="my-kop" width="580">
                <tr>
                    <td>
                        <img width="90" height="90" src="{{ asset('assets/denso-craft.png') }}" alt="">
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
                {{-- <tr>
                    <td colspan="2"><br></td>
                    <td class="text">
                        <font size="1">Kode Pos :17520</font>
                    </td>

                </tr> --}}

            </table>
            <hr style="border-top: 2px solid black;">
            <hr style="border-top: 2px solid black; margin-top:-7px;">
            <br>



        </center>

        <div class="isi">
            @yield('surat')
        </div>



        <!-- JavaScript Bundle with Popper -->
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script> --}}
    </body>

    </html>
