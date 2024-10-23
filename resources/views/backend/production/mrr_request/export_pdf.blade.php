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
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th,td {
            /* border: 1px solid black; */
        }
        .borderisi {
            border-right: 1px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            vertical-align: top;
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
            margin-top: 20px;
        }

        .text-center {
            text-align: center;
        }

        .no-border {
            border: none;
        }

        .text-right {
            text-align: right;
            margin-top: -10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h3>PT. SIMATELEX MANUFACTORY BATAM</h3>
        <p>Maintenance Repair Request</p>
    </div>

    <table>
        <tr>
            <td><strong>Request (Dept)</strong></td>
            <td>{{ $data->Request_dept }}</td>
            <td><strong>Model</strong></td>
            <td>{{ $data->modelBrewer->model }}</td>
        </tr>
        <tr>
            <td><strong>Name</strong></td>
            <td>{{ $data->Name_pd }}</td>
            <td><strong>Shift</strong></td>
            <td>{{ $data->shift->shift }}</td>
        </tr>
        <tr>
            <td><strong>To Department</strong></td>
            <td>{{ $data->To_department }}</td>
            <td><strong>Lot</strong></td>
            <td>{{ $data->lot->lot }}</td>
        </tr>
        <tr>
            <td><strong>Process</strong></td>
            <td class="borderisi">{{ $data->equipmentNo->Equipment_Name }}</td>
            <td><strong>Line</strong></td>
            <td>{{ $data->line->line }}</td>
        </tr>
        <tr>
            <td><strong>Equip. No</strong></td>
            <td>{{ $data->equipmentNo->Equipment_Number }}</td>
            <td><strong>Date</strong></td>
            <td>{{ $data->Date_pd }}</td>
        </tr>
        <tr>
            <td><strong>Description</strong></td>
            <td colspan="3">{{ $data->Description }}</td>
        </tr>
        <tr>
            <td><strong>Breakdown Time</strong></td>
            <td>{{ $data->Breakdown_time }}</td>
            <td><strong>Report Time</strong></td>
            <td>{{ $data->Report_time }}</td>
        </tr>
        <tr>
            <td class="signspv"><strong>Sign (SPV)</strong></td>
            <td colspan="3">Iwan</td>
        </tr>
    </table>

    <table>
        <tr>
            <th colspan="4" class="section-title">RESULT</th>
        </tr>
        <tr>
            <td><strong>Judgement</strong></td>
            <td>{{ $data->Judgement }}</td>
            <td><strong>Response Time</strong></td>
            <td>{{ $data->Response_time }}</td>
        </tr>
        <tr>
            <td><strong>Issue</strong></td>
            <td>{{ $data->Issue }}</td>
            <td><strong>Repair Start Time</strong></td>
            <td>{{ $data->Repair_start_time }}</td>
        </tr>
        <tr>
            <td><strong>Root Cause</strong></td>
            <td>{{ $data->Root_cause }}</td>
            <td><strong>Repair End Time</strong></td>
            <td>{{ $data->Repair_end_time }}</td>
        </tr>
        <tr>
            <td><strong>Action</strong></td>
            <td>{{ $data->Action }}</td>
            <td><strong>QC Start Time</strong></td>
            <td>{{ $data->Qc_start_time }}</td>
        </tr>
        <tr>
            <td><strong>Repair By*</strong></td>
            <td>{{ $data->Repair_by }}</td>
            <td><strong>QC End Time</strong></td>
            <td>{{ $data->Qc_end_time }}</td>
        </tr>
    </table>

    <table class="signature">
        <tr>
            <th colspan="4" class="section-title">FINAL ACCEPTED BY</th>
        </tr>
        <tr>
            <td><strong>QC Sign</strong></td>
            <td>{{ $data->Qc_sign }}asdasd</td>
            <td><strong>Date / Time</strong></td>
            <td class="borderisi">{{ $data->Qc_date }}sadasd</td>
        </tr>
        <tr>
            <td><strong>PD Sign</strong></td>
            <td>{{ $data->Name }}</td>
            <td><strong>Date / Time</strong></td>
            <td>{{ $data->Date_pd }}</td>
        </tr>
        {{-- <tr>
            <td><strong>SPV NTD/MT Sign</strong></td>
            <td>{{ $$spv_ntd_sign }}</td>
            <td><strong>Date / Time</strong></td>
            <td>{{ $spv_ntd_date }}</td>
        </tr> --}}
    </table>

    <p class="text-right">SB-MT-014 (2)</p>
</div>

</body>
</html>