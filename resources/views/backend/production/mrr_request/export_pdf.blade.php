{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Repair Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            padding-left: 5px;
            padding-right: 5px;
            border: 2px solid black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px solid black;
            /* border-right: none; */
            /* border-left: none; */
        }

        td, th {
            padding: 8px;
            text-align: left;
        }

        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .signature {
            margin-top: 20px;
        }

        .signature td {
            height: 20px;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .no-border {
            border: none !important;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>PT. SIMATELEX MANUFACTORY BATAM</h2>
        <h3>Maintenance Repair Request</h3>
    </div>

    <table>
        <tr>
            <td>REQUEST (Dept)</td>
            <td>{{ $data->Request_dept }}</td>
            <td>SHIFT</td>
            <td>{{ $data->shift->shift }}</td>
        </tr>
        <tr>
            <td>NAME</td>
            <td>{{ $data->Name }}</td>
            <td>DATE</td>
            <td>{{ $data->Date_pd }}</td>
        </tr>
        <tr>
            <td>PROCESS / Equip. No</td>
            <td>{{ $data->equipmentNo->Equipment_Name }}</td>
            <td>BREAKDOWN TIME</td>
            <td>{{ $data->Breakdown_time }}</td>
        </tr>
        <tr>
            <td>DESCRIPTION</td>
            <td colspan="3">{{ $data->Description }}</td>
        </tr>
        <tr>
            <td>JUDGEMENT</td>
            <td colspan="3">{{ $data->Judgement }}</td>
        </tr>
        <tr>
            <td>RESULT</td>
            <td colspan="3">Issue: {{ $data->Issue }} &nbsp; Root Cause: {{ $data->Root_cause }} &nbsp; Action: {{ $data->Action }}</td>
        </tr>
        <tr>
            <td>REPAIR BY</td>
            <td>{{ $data->Repair_by }}</td>
            <td>RESPONSE TIME</td>
            <td>{{ $data->Response_time }}</td>
        </tr>
        <tr>
            <td>REPAIR START TIME</td>
            <td>{{ $data->Repair_start_time }}</td>
            <td>REPAIR END TIME</td>
            <td>{{ $data->Repair_end_time }}</td>
        </tr>
        <tr>
            <td>QC START TIME</td>
            <td>{{ $data->Qc_start_time }}</td>
            <td>QC END TIME</td>
            <td>{{ $data->Qc_end_time }}</td>
        </tr>
    </table>

    <table class="signature">
        <tr>
            <td>FINAL ACCEPTED BY: Aing Maung</td>
            <td></td>
        </tr>
        <tr>
            <td>QC SIGN: {{ $data->Qc_name_sign }}</td>
            <td>DATE/TIME: {{ $data->Date_pd }}</td>
        </tr>
        <tr>
            <td>PD SIGN: {{ $data->Name }}</td>
            <td>DATE/TIME: {{ $data->Date_pd }}</td>
        </tr>
    </table>

    <p class="text-right">SB-MT-014 (2)</p>
</div>

</body>
</html> --}}



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Repair Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            /* border: 2px solid black; */
        }

        .container {
            width: 100%;
            padding: 0px;
            border: 2px solid black;
        }

        table {
            width: 100%;
            table-layout: fixed;
            /* margin-left: 20px; */
            border-collapse: collapse;
            margin-bottom: 0px;
            word-wrap: break-word;
            
        }

        table, th,td {
            /* border: 1px solid black; */
            max-width: 150px; /* Maksimum lebar kolom */
            word-wrap: break-word; /* Memaksa kata panjang berpindah ke baris berikutnya */
            /* overflow: hidden; */
            text-overflow: ellipsis; /* Menambahkan ... pada teks panjang */
            padding: 5px;
        }


        th, td {
            padding: 5px;
            word-wrap: break-word; /* Memaksa kata panjang berpindah ke baris berikutnya */
            text-align: left;
            vertical-align: top;
            white-space: nowrap; /* Mencegah teks pindah ke baris berikutnya */
        }

        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            background-color: #c4bfbff3;
            text-align: center;
        }

        .signature {
            margin-top: 0px;
        }

        .text-center {
            text-align: center;
        }

        .no-border {
            border: none;
        }

        .text-right {
            text-align: right;
            margin-top: 7px;
        }
        .border1 {
            border-bottom: 1px solid black;
        }
        .border2{
            border-bottom: 1px solid black !important;
        }
        .titikdua {
            margin-left: 70px;
        }
        textarea {
            width: 505px; /* Mengatur lebar tetap */
            height: 35px; /* Mengatur tinggi tetap */
            padding: 5px; /* Menambahkan padding di dalam textarea */
            font-size: 12px; /* Ukuran font di dalam textarea */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>PT. SIMATELEX MANUFACTORY BATAM</h2>
        <h3 style="font-size: 17px; margin-top: -7px;">MAINTENANCE REPAIR REQUEST</h3>
    </div>

    <table>
        <tr>
            <td><strong>REQUEST (Dept) <strong style="text-align: right; margin-left: 59px;">:</strong></strong></td>
            <td class="border1">{{ $data->Request_dept }}</td>
            <td><strong>MODEL<strong style="text-align: right; margin-left: 115px;">:</strong></strong></td>
            <td class="border1">{{ $data->modelBrewer->model }}</td>
        </tr>
        <tr>
            <td><strong>NAME<strong style="text-align: right; margin-left: 123px;">:</strong></strong></td>
            <td class="border1">{{ $data->Name }}</td>
            <td><strong>SHIFT<strong style="text-align: right; margin-left: 123px;">:</strong></td>
            <td class="border1">{{ $data->shift->shift }}</td>
        </tr>
        <tr>
            <td><strong>TO DEPARTMENT<strong style="text-align: right; margin-left: 55px;">:</strong></td>
            <td class="border1">{{ $data->To_department }}</td>
            <td><strong>LOT<strong style="text-align: right; margin-left: 134px;">:</strong></td>
            <td class="border1">{{ $data->lot->lot }}</td>
        </tr>
        <tr>
            <td><strong>PROCESS<strong style="text-align: right; margin-left: 100px;">:</strong></strong></td>
            <td class="border1">{{ $data->equipmentNo->Equipment_Name }}</td>
            <td><strong>LINE<strong style="text-align: right; margin-left: 131px;">:</strong></td>
            <td class="border1">{{ $data->line->line }}</td>
        </tr>
        <tr>
            <td><strong>EQUIP. NO<strong style="text-align: right; margin-left: 96px;">:</strong></td>
            <td class="border1">{{ $data->equipmentNo->Equipment_Number }}</td>
            <td><strong>DATE<strong style="text-align: right; margin-left: 126px;">:</strong></td>
            <td class="border1">{{ $data->Date_pd }}</td>
        </tr>
        <tr>
            {{-- <td><strong>Breakdown Time</strong></td>
            <td class="border1">{{ $data->Breakdown_time }}</td> --}}
            <td><strong>SIGN (SPV)<strong style="text-align: right; margin-left: 94px;">:</strong></td>
            <td class="border1">{{ $data->Note_spv_pd }}</td>
            <td><strong>REPORT TIME<strong style="text-align: right; margin-left: 77px;">:</strong></td>
            <td class="border2">{{ $data->Report_time }}</td>
        </tr>
        {{-- <tr>
            <td><strong>Description<strong style="text-align: right; margin-left: 92px;">:</strong></td>
            <textarea>{{ $data->Description }}</textarea>
        </tr> --}}
    </table>

    <table>
          <tr>
            <td><strong>DESCRIPTION<strong style="text-align: right; margin-left: 77px;">:</strong></td>
            <textarea style="margin-left: -171px;">{{ $data->Description }}</textarea>
        </tr>
    </table>

    <table>
        <tr>
            <th colspan="4" class="section-title">RESULT</th>
        </tr>
        <br>
        {{-- <tr>
            <td><strong>Judgement</strong></td>
            <td class="border1">{{ $data->Judgement }}</td>
            <td><strong>Response Time</strong></td>
            <td class="border1">{{ $data->Response_time }}</td>
        </tr> --}}
        <tr>
            <td><strong>ISSUE<strong style="text-align: right; margin-left: 123px;">:</strong></td>
            <textarea class="border1">{{ $data->Issue }}</textarea>
            {{-- <td><strong>Repair Start Time</strong></td>
            <td class="border1">{{ $data->Repair_start_time }}</td> --}}
        </tr>
        <tr>
            <td><strong>ROOT CAUSE<strong style="text-align: right; margin-left: 79px;">:</strong></td>
            <textarea class="border1">{{ $data->Root_cause }}</textarea>
            {{-- <td><strong>Repair End Time</strong></td>
            <td class="border1">{{ $data->Repair_end_time }}</td> --}}
        </tr>
        <tr>
            <td><strong>ACTION<strong style="text-align: right; margin-left: 113px;">:</strong></td>
            <textarea class="border1">{{ $data->Action }}</textarea>
            
        </tr>
        <tr>
            <td><strong>RESPONSE TIME<strong style="text-align: right; margin-left: 60px;">:</strong></td>
            <td class="border1">{{ $data->Response_time }}</td>
            <td><strong>REPAIR START TIME<strong style="text-align: right; margin-left: 38px;">:</strong></td>
            <td class="border1">{{ $data->Repair_start_time }}</td>
        </tr>
        <tr>
            <td><strong>REPAIR BY*<strong style="text-align: right; margin-left: 88px;">:</strong></td>
            <td class="border1">{{ $data->Repair_by }}</td>
            <td><strong>REPAIR END TIME<strong style="text-align: right; margin-left: 53px;">:</strong></td>
            <td class="border1">{{ $data->Repair_end_time }}</td>
        </tr>
        <tr>
            <td><strong>QC START TIME<strong style="text-align: right; margin-left: 65px;">:</strong></td>
            <td class="border1">{{ $data->Qc_start_time }}</td>
            <td><strong>QC END TIME<strong style="text-align: right; margin-left: 80px;">:</strong></td>
            <td class="border1">{{ $data->Qc_end_time }}</td>
        </tr>
    </table>

    <table class="signature">
        <tr>
            <th colspan="4" class="section-title">FINAL ACCEPTED BY</th>
        </tr>
        <tr>
            <td><strong>QC SIGN<strong style="text-align: right; margin-left: 108px;">:</strong></td>
            <td class="border1">{{ $data->Qc_name_sign }}</td>
            <td><strong>DATE / TIME<strong style="text-align: right; margin-left: 87px;">:</strong></td>
            <td class="border1">{{ $data->Date_qc }}</td>
        </tr>
        <tr>
            <td><strong>PD SIGN<strong style="text-align: right; margin-left: 109px;">:</strong></td>
            <td class="border1">{{ $data->Name }}</td>
            <td><strong>DATE / TIME<strong style="text-align: right; margin-left: 87px;">:</strong></td>
            <td class="border1">{{ $data->Date_pd }}</td>
        </tr>
        {{-- <tr>
            <td><strong>SPV NTD/MT Sign</strong></td>
            <td>{{ $$spv_ntd_sign }}</td>
            <td><strong>Date / Time</strong></td>
            <td>{{ $spv_ntd_date }}</td>
        </tr> --}}
    </table>

</div>
<p class="text-right">SB-MT-014 (2)</p>

</body>
</html>