<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            padding: 13px;
            border: 1px solid black;
        }
        .header, .section {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 14px;
        }
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
        }
        .checkbox {
            display: inline-block;
            width: 15px;
            height: 15px;
            border: 1px solid black;
            margin-right: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">PT. SIMATELEX MANUFACTORY BATAM</div>
        <div class="title">Facility Work Order</div>
    
            <!-- Table 1: Work Order Details -->
            <table class="table" style="margin-top: 10px;">
                <tr>
                    <td>No</td>
                    <td></td>
                    <td>Date</td>
                    <td>{{ $workorder->date }}</td>
                </tr>
                <tr>
                    <td>Reported by</td>
                    <td>{{ $workorder->reported_by }}</td>
                    <td>Department</td>
                    <td>{{ $workorder->request_dept }} (Shift: {{ $workorder->shifts->shift }}) </td>
                </tr>
                <tr>
                    <td>Requested by</td>
                    <td>{{ $workorder->request_by }}</td>
                    <td>Location</td>
                    <td>{{ $workorder->location }} (Line: {{ $workorder->line }} / Lot: {{ $workorder->lots->lot }}) </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td colspan="3">{{ $workorder->decription }}</td>
                </tr>
            </table>
        
            <!-- Table 2: Priority and Technician Details -->
            <table class="table" style="margin-top: 10px;">
                <tr>
                    <td>Priority:</td>
                    <td colspan="3">
                        High <input type="checkbox" {{ $workorder->priority == 'High' ? 'checked' : '' }}>
                        Medium <input type="checkbox" {{ $workorder->priority == 'Medium' ? 'checked' : '' }}>
                        Low <input type="checkbox" {{ $workorder->priority == 'Low' ? 'checked' : '' }}>
                    </td>
                </tr>
                <tr>
                    <td>Assigned to</td>
                    <td>{{ $workorder->assigned_technician }}</td>
                    <td>Time Spent (Hour/Min)</td>
                    <td>{{ $workorder->time_spent }}</td>
                </tr>
                <tr>
                    <td>Completed By</td>
                    <td>{{ $workorder->complated_by_technician }}</td>
                    <td>Date Completed</td>
                    <td>{{ $workorder->date_complated_technician }}</td>
                </tr>
            </table>
        
            <!-- Final Acceptance Section -->
            <div style="margin-top: 20px;">
                <div>FINAL ACCEPTED</div>
                <table class="table" style="width: 100%;">
                    <tr>
                        <td>Name</td>
                        <td>{{ $workorder->name_spv }}</td>
                        <td>Date/Time</td>
                        <td>{{ $workorder->date_final }} / {{ $workorder->time_accepted }}</td>
                    </tr>
                </table>
            </div>
        </div>
    

           
    </div>









    
</body>