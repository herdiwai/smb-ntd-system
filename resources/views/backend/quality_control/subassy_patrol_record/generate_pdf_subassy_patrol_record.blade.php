<!DOCTYPE html>
<html>
<head>
    <title>SUBASSY IN-PROCESS PATROL AND MATERIAL INSPECTION RECORD</title>
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
</head>
<body>
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
                                    <h1 class="title">IN-PROCESS PATROL AND MATERIAL INSPECTION RECORD</h1>
                                    <h2 class="title">SIMATELEX MANUFACTORY COMPANY LIMITED</h2>
                                </div>
    
                                <table cellpadding="5" cellspacing="0" width="100%" style="margin-bottom: 20px;">
                                    <tr>
                                        <td><strong>Model</strong></td>
                                        <td>{{ $inspection->modelBrewer->model ?? 'N/A' }}</td>
                                        <td><strong>Frequency of Inspection</strong></td>
                                        <td>{{ $inspection->frequency_of_inspection ?? 'N/A' }}</td>
                                        <td><strong>Date</strong></td>
                                        <td>{{ $inspection->date ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Product Name</strong></td>
                                        <td>{{ $inspection->product_name ?? 'N/A' }}</td>
                                        <td><strong>Inspection Standard</strong></td>
                                        <td>{{ $inspection->inspection_standard ?? 'N/A' }}</td>
                                        <td><strong>Inspected By</strong></td>
                                        <td>{{ $inspection->inspected_by ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Production Unit</strong></td>
                                        <td>{{ $inspection->production_unit ?? 'N/A' }}</td>
                                        <td><strong>Shift</strong></td>
                                        <td>{{ $inspection->shift ?? 'N/A' }}</td>
                                        <td><strong>Reviewed By</strong></td>
                                        <td>{{ $inspection->reviewed_by ?? 'N/A' }}</td>
                                    </tr>
                                </table>
                                
                                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th colspan="8" style="text-align: center;">Inspection Checking Result</th>
                                            <th colspan="3" style="text-align: center;">Check Material Specification Record</th>
                                        </tr>
                                        <tr>
                                            <th rowspan="2" style="text-align: center;">Inspection Item</th>
                                            <th rowspan="2" style="text-align: center;">Defect Grade (PCS)</th>
                                            <th rowspan="2" style="text-align: center;">Sample No. (PCS)</th>
                                            <th colspan="4" style="text-align: center;">Inspection Time and Results</th>
                                            <th rowspan="2" style="text-align: center;">Remark</th>
                                            <th rowspan="2" style="text-align: center;">Material Name</th>
                                            <th rowspan="2" style="text-align: center;">Test Result</th>
                                            <th rowspan="2" style="text-align: center;">Decision</th>
                                        </tr>
                                        <tr>
                                            @foreach ($timeSlots as $timeSlot)
                                                <th>{{ $timeSlot }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
    
                                        @foreach ($groupedItems as $category => $items)
                                        <tr>
                                            <td colspan="11"><strong>{{ $category }}</strong></td>
                                        </tr>

                                        @foreach ($items as $item)
                                        <tr>
                                            {{-- <td>{{ $item->inspectionItem->inspection_item === 'FTH' ? 'N/A' : $item->inspetion_item }}</td> --}}
                                            <td>
                                                {{ in_array($item->inspectionItem->inspection_item, ['FTH', 'Pivot Plate']) ? 'N/A' : $item->inspectionItem->inspection_item }}
                                            </td>
                                            {{-- <td>{{ $item->inspectionItem->inspection_item ?? 'N/A' }}</td> --}}
                                            {{-- <td>{{ $item->defect_grade ?? 'N/A' }}</td>
                                            <td>{{ $item->sample_no_pcs ?? 'N/A' }}</td> --}}

                                            <td>
                                                {{ ($item->defect_grade == '20' || $item->defect_grade == '21') ? 'N/A' : $item->defect_grade ?? 'N/A' }}
                                            </td>
                                            <td>
                                                {{ ($item->sample_no_pcs == '20' || $item->sample_no_pcs == '21') ? 'N/A' : $item->sample_no_pcs ?? 'N/A' }}
                                            </td>

                                            <!-- Tampilkan result dan remark berdasarkan waktu patrol -->
                                            @foreach ($timeSlots as $timeSlot)
                                                <td>
                                                    @php
                                                        // Mengambil result berdasarkan time slot
                                                        $resultData = $groupedDetails[$timeSlot][$item->inspection_item] ?? null;
                                                        $result = $resultData['result'] ?? 'N/A'; // Ambil result jika ada
                                                        $remark = $resultData['remark_ddca'] ?? 'N/A'; // Ambil remark jika ada
                                                    @endphp
                                                    {{ $result }} <!-- Tampilkan hasil -->
                                                </td>
                                            @endforeach

                                            <!-- Tampilkan remark terakhir berdasarkan data terkini -->
                                            <td>
                                                @php
                                                    // Mengambil remark terakhir berdasarkan time slot dan item
                                                    $latestRemark = '';
                                                    foreach ($timeSlots as $timeSlot) {
                                                        $resultData = $groupedDetails[$timeSlot][$item->inspection_item] ?? null;
                                                        if ($resultData) {
                                                            $latestRemark = $resultData['remark_ddca'] ?? 'N/A'; // Ambil remark jika ada
                                                        }
                                                    }
                                                @endphp
                                                {{ $latestRemark ?? 'N/A' }} <!-- Tampilkan remark terakhir -->
                                            </td>
                                            
                                            <td>{{ $item->material_name ?? 'N/A' }}</td>
                                            <td>{{ $item->test_result ?? 'N/A' }}</td>
                                            <td>{{ $item->decision ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>