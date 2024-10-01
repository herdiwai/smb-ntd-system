{{-- <!DOCTYPE html>
<html>
<head> --}}
    {{-- <meta charset="utf-8">
    <title>Order PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>ID Sample #{{ $sampleRequisition->id }}</h1>
    <p>Customer: {{ $sampleRequisition->series }}</p>
    @if($sampleRequisition->sampleReport == '')
        <p style="color:red">Report not completed</p>
    @else
        <form action="">{{ $sampleRequisition->sampleReport->summary_after }}</form>
    @endif</td> --}}
    {{-- <form action="">{{ $sampleRequisition->sampleReport->summary_after }}</form> --}}
    
    {{-- <div class="col-md-6 mb-3">
        <div class="form-group">
            <div class="form-row align-items-center">
                <div class="col-sm-3">
                    <label for="" class="col-form-label">Do Number</label>
                </div>
                <div class="col">
                    <input type="text" class="form-control" value="{{ $sampleRequisition->date }}" id="" placeholder="" name="do_no">
                </div>
            </div>
        </div>  
    </div> --}}
    

{{-- 
    <h3>Sample Details</h3>
    <table>
        <thead>
            <tr>
                <th>Submitted Date</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table> --}}

    {{-- <p>Total: {{ $order->total }}</p> --}}
{{-- </body>
</html> --}}


{{-- <html>
<head>
    <title> KOP SURAT </title>
    <style type= "text/css">
    body {font-family: sans-serif; background-color : #ccc }
    .rangkasurat {width : 980px;margin:0 auto;background-color : #fff;height: 500px;padding: 20px;}
    table {border-bottom : 5px solid # 000; padding: 2px}
    .tengah {text-align : center;line-height: 5px;}
    .isi {text-align : center;line-height: 10px;}
     </style >
</head>
<body>
<div class = "rangkasurat">
     <table width = "100%">
           <tr>
                 {{-- <td> <img src="dist/img/log.png" width="140px"> </td> --}}
                 {{-- <td class = "tengah">
                       <h2>PT.SIMATELEX MANUFACTORY BATAM</h2> --}}
                       {{-- <h2>DINAS PENDIDIKAN</h2> --}}
                       {{-- <h2>SAMPLE TESTINGR REQUISITION DAN SAMPLE TESTING REPORT FORM</h2>  --}}
                       {{-- <h1>SAMPLE TESTINGR REQUISITION DAN SAMPLE TESTING REPORT FORM</h1> --}}
                       {{-- <b>Jalan Tarikolot Jatinunggal Telp . ( 0262 ) 428590 Sumedang 45376</b> --}}
                 {{-- </td>
                 <td class="isi">   
                 </td>
            </tr>
     </table >
</div>
</body> --}}
{{-- </html> --}} 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Document</title>

    <style>
        @page {
            size: 8in 7.5in;
        }
        #judul{
            text-align: center;
        }
        #halaman {
            width: auto;
            height: auto;
            position: absolute;
            border: 2px solid;
            padding-top: 30px;
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 80px;
        }

    </style>

    
</head>
<body>
    <div class="halaman">
        <table>
            <tr>
                <td><center>
                    <font size="4" style="color: orange;"><b>PT SIMATELEX MANUFACTORY BATAM <b></font><br>
                    <font size="5">SAMPLE TESTING REQUISITION & SAMPLE TESTING REPORT FORM </font>
                </td>
            </tr>
            <tr>
                <td colspan="7"><hr></td>
            </tr>
        </table>
        
        {{-- <table width="470">
            <center>
                <font size="4">SAMPLE REQUISITION FORM & REPORT</font>
            </center><br>
        </table> --}}

        <table>
            <tr>
                <td><b>SAMPLE TESTING REQUISITION FORM<b></td>
            </tr><br>
        </table>

        <table width="450">
            <tr>
                <td>SAMPLE SUBMITED DATE</td>
                <td>:</td>
                <td><input type="text" value="{{ $sampleRequisition->sample_subtmitted_date }}" class="form-control" ></td>
                {{-- <td>{{ $sampleRequisition->sample_subtmitted_date }}</td> --}}
            </tr>
            {{-- <div class="form-group">
                <div class="form-row">
                    <label for="qeReview" >Check By</label>
                    <input type="text" value="{{ $sampleRequisition->process->process }}" class="form-control" id="name" placeholder=""name="check_by">
                </div>
            </div> --}}
            <tr>
                <td>PROCESS</td>
                <td>:</td>
                <td><input type="text" value="{{ $sampleRequisition->process->process }}" class="form-control" ></td>
            </tr>
            <tr>
                <td>LOT</td>
                <td>:</td>
                <td><input type="text" value="{{ $sampleRequisition->lot->lot }}" class="form-control" ></td>
                {{-- <td>{{ $sampleRequisition->lot->lot }}</td> --}}
            </tr>
            <tr>
                <td>SHIFT</td>
                <td>:</td>
                <td><input type="text" value="{{ $sampleRequisition->shift->shift }}" class="form-control" ></td>
                {{-- <td>{{ $sampleRequisition->shift->shift }}</td> --}}
            </tr>
            <tr>
                <td>MODEL</td>
                <td>:</td>
                <td><input type="text" value="{{ $sampleRequisition->modelBrewer->model }}" class="form-control" ></td>
                {{-- <td>{{ $sampleRequisition->modelBrewer->model }}</td> --}}
            </tr>
            <tr>
                <td>DO.NUMBER</td>
                <td>:</td>
                <td><input type="text" value="{{ $sampleRequisition->do_no }}" class="form-control" ></td>
                {{-- <td>{{ $sampleRequisition->do_no }}</td> --}}
            </tr>
            <tr>
                <td>SERIES</td>
                <td>:</td>
                <td><input type="text" value="{{ $sampleRequisition->series }}" class="form-control" ></td>
                {{-- <td>{{ $sampleRequisition->series }}</td> --}}
            </tr>
            <tr>
                <td>NO OF SAMPPLE</td>
                <td>:</td>
                <td><input type="text" value="{{ $sampleRequisition->no_of_sample }}" class="form-control" ></td>
                {{-- <td>{{ $sampleRequisition->no_of_sample }}</td> --}}
            </tr>
            <tr>
                <td>TEST PURPOSE</td>
                <td>:</td>
                <td><input type="text" value="{{ $sampleRequisition->testpurpose }}" class="form-control" ></td>
                {{-- <td>{{ $sampleRequisition->testpurpose }}</td> --}}
            </tr>
            <tr>
                <td>OTHER PURPOSE/REMARKS</td>
                <td>:</td>
                <td><textarea class="form-control" rows="2" >{{ $sampleRequisition->test_purpose }}</textarea></td>
                {{-- <td><input type="text" value="{{ $sampleRequisition->test_purpose }}" class="form-control" ></td> --}}
                {{-- <td>{{ $sampleRequisition->test_purpose }}</td> --}}
            </tr>
            <tr>
                <td>SUMMARY BEFORE</td>
                <td>:</td>
                <td><input type="text" value="{{ $sampleRequisition->summary }}" class="form-control" ></td>
                {{-- <td>{{ $sampleRequisition->summary }}</td> --}}
            </tr>
            <tr>
                <td>CHECK BY</td>
                <td>:</td>
                <td><input type="text" value="{{ $sampleRequisition->check_by }}" class="form-control" ></td>
                {{-- <td>{{ $sampleRequisition->check_by }}</td> --}}
            </tr>

        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

            <div class="halaman">
                <table>
                    <tr>
                        <td><center>
                            <font size="4" style="color: orange;"><b>PT SIMATELEX MANUFACTORY BATAM<b></font><br>
                            <font size="5">SAMPLE TESTING REQUISITION & SAMPLE TESTING REPORT FORM</font>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7"><hr></td>
                    </tr>
                </table>

            <table>
                <tr>
                    <td><b>SAMPLE TESTING REPORT FORM</b></td>
                </tr><br>
            </table>
    
            <table width="450">
                <tr>
                    <td>RECEIVED SAMPLE DATE</td>
                    <td>:</td>
                    <td><input type="text" value="{{ $sampleRequisition->sample_subtmitted_date }}" class="form-control" ></td>
                    {{-- <td>{{ $sampleRequisition->sample_subtmitted_date }}</td> --}}
                </tr>
                <tr>
                    <td>SUMMARY AFTER</td>
                    <td>:</td>
                    <td><textarea class="form-control" rows="2" >{{ $sampleRequisition->sampleReport->remark_test }}</textarea></td>
                    {{-- <td>{{ $sampleRequisition->process->process }}/{{ $sampleRequisition->incomming_number }}</td> --}}
                </tr>
                <tr>
                    <td>TEST RESULT</td>
                    <td>:</td>
                    <td><input type="text" value="{{ $sampleRequisition->sampleReport->result_test }}" class="form-control" ></td>
                    {{-- <td>{{ $sampleRequisition->lot->lot }}</td> --}}
                </tr>
                <tr>
                    <td>SCHEDULE OF TEST</td>
                    <td>:</td>
                    <td><input type="text" value="{{ $sampleRequisition->sampleReport->schedule_of_test }}" class="form-control" ></td>
                    {{-- <td>{{ $sampleRequisition->shift->shift }}</td> --}}
                </tr>
                <tr>
                    <td>EST OF COMPLETION DATE</td>
                    <td>:</td>
                    <td><input type="text" value="{{ $sampleRequisition->sampleReport->est_of_completion_date }}" class="form-control" ></td>
                    {{-- <td>{{ $sampleRequisition->modelBrewer->model }}</td> --}}
                </tr>
                <tr>
                    <td>INSPECTOR NAME</td>
                    <td>:</td>
                    <td><input type="text" value="{{ $sampleRequisition->sampleReport->inspector }}" class="form-control" ></td>
                    {{-- <td>{{ $sampleRequisition->do_no }}</td> --}}
                </tr>
                <tr>
                    <td>DATE CHECK</td>
                    <td>:</td>
                    <td><input type="text" value="{{ $sampleRequisition->sampleReport->date }}" class="form-control" ></td>
                    {{-- <td>{{ $sampleRequisition->series }}</td> --}}
                </tr>
                <tr>
                    <td>STATUS REPORT</td>
                    <td>:</td>
                    <td><input type="text" value="{{ $sampleRequisition->status }}" class="form-control" ></td>
                    {{-- <td>{{ $sampleRequisition->no_of_sample }}</td> --}}
                </tr>
                <tr>
                    <td>STATUS APPROVALS MANAGER</td>
                    <td>:</td>
                    <td><input type="text" value="{{ $sampleRequisition->statusApprovals->status }}" class="form-control" ></td>
                    {{-- <td>{{ $sampleRequisition->no_of_sample }}</td> --}}
                </tr>

            </table>

        {{-- </table>
            <tr>
                <td>Menyatakan dengan sebenarnya</td>
            </tr>
        </table> --}}

    {{-- <table width="260">
        @foreach ($collection as $item)
            <tr>
                <td>NTD</td>
                <td>:</td>
                <td>{{  }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{  }}</td>
            </tr>
            <tr>
                <td>Angkatan</td>
                <td>:</td>
                <td>{{  }}</td>
            </tr>
        @endforeach
    </table><br> --}}

        {{-- <table>
            <tr>
                <td>Adalah bener telah menyatakan surat ini</td>
            </tr>
        </table><br>

        <div style="width: 30%; text-align: left; float: right;">
            BANDUNG, 20 Agustus 1990 <br>
            Yang Bertanda Tangan,
        </div>
        <br><br><br><br><br>
        <div style="width: 32%; text-align: left; float: right;">Technician NTD</div> --}}



    </div>
</body>
</html>