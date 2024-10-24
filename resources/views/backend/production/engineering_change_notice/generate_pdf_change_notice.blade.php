<!DOCTYPE html>
<html>
<head>

    <title>ENGINEERING CHANGE NOTICE RECORD FORM </title>
        <style>
             /* Styling khusus untuk PDF jika diperlukan */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 20px; /* Ukuran font lebih kecil */
        }
        @page {
            size: A4; /* Mengatur ukuran kertas menjadi A4 */
            margin: 20mm; /* Margin di sekitar halaman */
        }
        .inspection-sheet {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #0e0d0d;
            text-align: left; /* Menyelaraskan konten ke kiri */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #050505;
            padding: 4px; /* Padding lebih kecil */
            text-align: left; /* Teks pada header dan cell rata kiri */
            font-size: 10px; /* Ukuran font lebih kecil untuk tabel */
        }
        th {
            text-align: center; /* Teks header rata tengah */
            padding: 5px; /* Mengurangi padding untuk mengurangi spasi di sekitar teks */
            margin: 0; /* Menghapus margin ekstra jika ada */
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .title {
            margin: 0; /* Menghapus margin default */
            padding: 0; /* Menghapus padding default */
        }
        h1.title {
        font-size: 18px; /* Ukuran font untuk judul utama */
        text-align: center;
            margin-bottom: 5px; /* Mengatur jarak antara dua judul */
        }
        h2.title {
            font-size: 14px; /* Ukuran font untuk judul kedua */
            text-align: center;
            margin-top: 0; /* Menghapus margin atas */
        }
        .remark {
            margin-top: 20px;
            font-size: 10px; /* Ukuran font lebih kecil untuk remark */
        }
    </style>

        <div class="page-content">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST">
                                @method('POST')
                                @csrf
                                <div class="inspection-sheet">
                                    <div class="header">
                                        <h1 class="title">ENGINEERING CHANGE NOTICE RECORD FORM</h1>
                                    </div>
                                    <table cellpadding="5" cellspacing="0" width="100%" style="margin-bottom: 20px;">
                                        <tr>
                                            <td><strong>Model</strong></td>
                                            <td>{{ $changeNotice->modelBrewer->model ?? 'N/A' }}</td>
                                            <td><strong>Date</strong></td>
                                            <td>{{ $changeNotice->date ?? 'N/A' }}</td>
                                            <td><strong>Shift</strong></td>
                                            <td>{{ $changeNotice->shifts->shift ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Line</strong></td>
                                            <td>{{ $changeNotice->lines->line ?? 'N/A' }}</td>
                                            <td><strong>Lot</strong></td>
                                            <td>{{ $changeNotice->lots->lot ?? 'N/A' }}</td>
                                            <td><strong>PIC</strong></td>
                                            <td>{{ $changeNotice->pic ?? 'N/A' }}</td>
                                        </tr>
                                    </table>

                                    <table border="1" cellpadding="5" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Change Notice</th>
                                                <th style="text-align: center;">SO No</th>
                                                <th style="text-align: center;">CO No.</th>
                                                <th style="text-align: center;">Week</th>
                                                <th style="text-align: center;">Implement DateCode</th>
                                                <th style="text-align: center;">CON No.</th>
                                                <th style="text-align: center;">SAH Key</th>
                                                <th style="text-align: center;">CON Name</th>
                                                <th style="text-align: center;">SN First</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Row for Change Notice -->
                                            <tr>
                                                <td>{{ $changeNotice->change_notice }}<br>
                                                    Dari: {{ $changeNotice->change_from_notice }}<br>
                                                    To: {{ $changeNotice->change_to_notice }}
                                                </td>
                                                <td>{{ $changeNotice->so_no }}</td>
                                                <td>{{ $changeNotice->co_no }}</td>
                                                <td>{{ $changeNotice->week }}</td>
                                                <td>
                                                    {{ $changeNotice->implement_datecode }}<br>
                                                    Dari: {{ $changeNotice->change_from_datecode }}<br>
                                                    To: {{ $changeNotice->change_to_datecode }}
                                                </td>
                                                <td>{{ $changeNotice->con_no }}</td>
                                                <td>{{ $changeNotice->sah_key }}</td>
                                                <td>{{ $changeNotice->con_name }}</td>
                                                <td>
                                                    {{ $changeNotice->sn_awal }}<br>
                                                    {{ $changeNotice->sn_rndm }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>


</head>
</html>