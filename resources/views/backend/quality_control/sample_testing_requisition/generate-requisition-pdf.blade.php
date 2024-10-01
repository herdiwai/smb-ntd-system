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
            border: 1px solid;
            padding-top: 30px;
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 80px;
        }

    </style>

    
</head>
<body>
    <div class="halamana">
        <table>
            <tr>
                <td><center>
                    <font size="4">PT SIMATELEX MANUFACTORY BATAM</font>
                    <font size="5">PT SIMATELEX MANUFACTORY BATAM</font>
                    <font size="2">PT SIMATELEX MANUFACTORY BATAM</font>
                </td>
            </tr>
            <tr>
                <td colspan="7"><hr></td>
            </tr>
        </table>
        
        <table width="470">
            <center>
                <font size="4">SAMPLE REQUISITION FORM & REPORT</font>
            </center><br>
        </table>

        <table>
            <tr>
                <td>Yang bertandangan di sini :</td>
            </tr>
        

        <table width="350">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>Mr.Simatelex</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>Technician NTD</td>
            </tr><br>
        </table>
        <tr>
            <td>Menyatakan dengan sebenarnya</td>
        </tr>
    </table>

    <table width="260">
        {{-- @foreach ($collection as $item) --}}
            <tr>
                <td>NTD</td>
                <td>:</td>
                {{-- <td>{{  }}</td> --}}
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                {{-- <td>{{  }}</td> --}}
            </tr>
            <tr>
                <td>Angkatan</td>
                <td>:</td>
                {{-- <td>{{  }}</td> --}}
            </tr>
        {{-- @endforeach --}}
    </table><br>

        <table>
            <tr>
                <td>Adalah bener telah menyatakan surat ini</td>
            </tr>
        </table><br>

        <div style="width: 30%; text-align: left; float: right;">
            BANDUNG, 20 Agustus 1990 <br>
            Yang Bertanda Tangan,
        </div>
        <br><br><br><br><br>
        <div style="width: 32%; text-align: left; float: right;">Technician NTD</div>

    </div>
</body>
</html>