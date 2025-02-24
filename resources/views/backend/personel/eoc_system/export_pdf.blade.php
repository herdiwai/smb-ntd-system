<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pengalaman Kerja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #000;
        }
        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .content {
            margin-top: 20px;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Surat Pengalaman Kerja</div>
        
        <div class="content">
            <p>Yang bertanda tangan di bawah ini:</p>
            <p><strong>Nama:</strong> {{ $data->EmployeeName }}</p>
            <p><strong>Jabatan:</strong> {{ $data->Position }}</p>
            <p><strong>Tanggal Bergabung:</strong> {{ \Carbon\Carbon::parse($data->JoinDate)->format('d F Y') }}</p>
            <p><strong>Jenis Kontrak:</strong> {{ $data->ContractType }}</p>
            <p><strong>Periode Kontrak:</strong> {{ \Carbon\Carbon::parse($data->ContractStart)->format('d F Y') }} - {{ \Carbon\Carbon::parse($data->ContractEnd)->format('d F Y') }}</p>
            <p><strong>Kinerja:</strong> {{ $data->Performance }}</p>
            <p><strong>Keterangan:</strong> {{ $data->Remarks ?? '-' }}</p>

            <p>Dengan ini menyatakan bahwa karyawan tersebut telah bekerja di perusahaan kami dengan baik selama masa kontraknya.</p>
        </div>

        <div class="signature">
            <p><strong>Hormat Kami,</strong></p>
            <p>HRD Perusahaan</p>
            <p>(________________)</p>
        </div>
    </div>
</body>
</html>