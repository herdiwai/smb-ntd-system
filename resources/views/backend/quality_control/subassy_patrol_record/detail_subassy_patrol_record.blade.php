@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/vendors/jquery-ajax/jquery.min.js') }}"></script>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .inspection-sheet {
        width: 1000px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #f5f2f2;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #f1ebeb;
        padding: 8px;
        text-align: left;
    }
    .header {
        text-align: center;
        margin-bottom: 20px;
    }
    .remark {
        margin-top: 20px;
        font-size: 12px;
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
                            <div class="header" style="text-align: center; margin-bottom: 20px;">
                                <h3>IN-PROCESS PATROL AND MATERIAL INSPECTION RECORD</h3>
                                <p>SIMATELEX MANUFACTORY COMPANY LIMITED</p>
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
                                                <td>
                                                    {{ in_array($item->inspectionItem->inspection_item, ['FTH', 'Pivot Plate']) ? 'N/A' : $item->inspectionItem->inspection_item }}
                                                </td>
                                                {{-- <td>{{ $item->inspectionItem->inspection_item ?? 'N/A' }}</td> --}}
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







@endsection