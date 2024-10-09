
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Form</title>
    <link rel="stylesheet" href="styles.css">

    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    margin: 50px;
}

.pdf-container {
    padding: 20px;
    border: 2px solid black; /* Garis di setiap sisi kertas */
    height: 100vh; /* Menyebar sepanjang halaman */
    position: relative;
}

h1 {
    text-align: center;
    font-size: 18px;
    margin-bottom: 5px;
}
h2 {
    text-align: center;
    font-size: 25px;
    margin-bottom: 50px;
}

.form-row {
    display: flex; /* Membuat form-group sejajar */
    justify-content: space-between; /* Jarak antar elemen */
    margin-bottom: 15px;
}

/* .form-group {
    display: flex;
    flex: 1;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 15px;
    margin-right: 10px;
} */

.form-group {
    display: inline-block;
    width: 48%; /* Lebar dari setiap input */
    margin-right: -2.5%; /* Jarak antara kedua form-group */
    vertical-align: top;
}


.form-group:last-child {
    margin-right: 0; /* Menghapus margin di elemen terakhir */
}

label {
    font-size: 16px;
    color: #333;
    margin-right: 10px;
    /* width: 30%; */
}
.model {
    margin-right: 20px;
}
.series {
    margin-right: 18px;
}

.noofsample {
    margin-right: 45px;
}
.process {
    margin-right: 85px;
}

hr {
    margin-bottom: 15px;
}


.tracebilitydatecode {
    margin-right: 25px;
}
.completiondate {
    margin-right: 70px;
}
.testpurpose {
    margin-right: 95px;
}
.regaccepted {
    margin-right: 50px;
}
.purposesize {
    width: 62%;
}
.scheduletest {
    font-size: 13px;
    width: 20%;
}
.estcompletiondate {
    font-size: 13px;
    width: 25%;
    margin-right: 19px;
}
.qereview {
    width: 20%;
    margin-right: 28px;
}
.tracebilityreport {
    font-size: 13px;
    width: 20%;
    margin-right: 20px;
}

textarea {
    width: 200%;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    margin-bottom: 15px;
}

input {
    width: 25%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 2px;
    font-size: 14px;
    position: absolute;
}

textarea {
    height: 100px;
    resize: none;
}

/* Menambahkan garis tepi yang tebal */
body::before, body::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border: 5px solid black;
    pointer-events: none;
    z-index: -1;
}

.modelreport {
    font-size: 15px;
}


</style>

</head>
<body>
    <div class="pdf-container">
        <h1>PT SIMATELEX MANUFACTORY BATAM</h1>
        <h2>SAMPLE TESTING REQUISITION</h2>
        <div class="form-row">
            <div class="form-group">
                <label class="model" for="name">Model</label>
                <input type="text" id="name" name="name" value="{{ $sampleRequisition->modelBrewer->model }}">
            </div>
            <div class="form-group">
                <label class="noofsample" for="name">No of Sample</label>
                <input type="text" id="name" name="name" value="{{ $sampleRequisition->no_of_sample }}">
            </div>
            {{-- <div class="form-group">
                <label class="email" for="email">Series</label>
                <input type="email" id="email" name="email">
            </div> --}}
            {{-- <div class="form-group">
                <label for="address">Alamat</label>
                <textarea id="address" name="address"></textarea>
            </div> --}}
        </div>
        <br>

        <div class="form-row">
            <div class="form-group">
                <label class="series" for="name">Series</label>
                <input type="text" id="name" name="name" value="{{ $sampleRequisition->series }}">
            </div>
            <div class="form-group">
                <label class="process" for="name">Process</label>
                <input type="text" id="name" name="name" value="{{ $sampleRequisition->process->process }}">
            </div>
        </div>

        <br>

        <div class="form-row">
            <div class="form-group">
                <label for="name">C/O No</label>
                <input type="text" id="name" name="name" value="{{ $sampleRequisition->co_no }}">
            </div>
            <div class="form-group">
                <label class="mfg" for="name">MFG Sample Date</label>
                <input type="text" id="name" name="name" value="{{ $sampleRequisition->mfg_sample_date }}">
            </div>
        </div>

        <br>
        <br>
        <hr>
        <br>

        <div class="form-row">
            <div class="form-group">
                <label for="name">Sample Submitted (Date)</label>
                <input class="purposesize" type="text" id="name" name="name" value="{{ $sampleRequisition->sample_subtmitted_date }}">
            </div>
        </div>

        <br>

        <div class="form-row">
            <div class="form-group">
                <label class="tracebilitydatecode" for="name">Tracebility (Date Code)</label>
                <input class="purposesize" type="text" id="name" name="name" value="{{ $sampleRequisition->tracebility_datecode }}">
            </div>
        </div>

        <br>

        <div class="form-row">
            <div class="form-group">
                <label class="completiondate" for="name">Completion Date</label>
                <input class="purposesize" type="text" id="name" name="name" value="{{ $sampleRequisition->completion_date }}">
            </div>
        </div>

        <br>
        <br>
        <hr>
        <br>

        <div class="form-row">
            <div class="form-group">
                <label class="testpurpose" for="name">Test Purpose</label>
                <input class="purposesize" type="text" id="name" name="name" value="{{ $sampleRequisition->testpurpose }}">
            </div>
        </div>

        <br>

        <div class="form-group">
            <label for="address">Other Purpose/Remarks</label>
            <textarea id="address" name="address">{{ $sampleRequisition->test_purpose }}</textarea>
        </div>
        <br>
        <br>
        <hr>
        <br>

        <div class="form-row">
            <div class="form-group">
                <label class="qereview" for="name">QE Review</label>
                @if($sampleRequisition->status_approvals_id_qe == '1')
                    <input class="qereview" type="text" id="name" name="name" value="Nel Hendri">
                @else
                    <input class="qereview" type="text" id="name" name="name" value="pending">
                @endif
            </div>
            <div class="form-group">
                <label class="regaccepted" for="name">Reg Accepted</label>
                <input type="text" id="name" name="name" value="Yes">
            </div>
        </div>

        <br>

        <div class="form-row">
            <div class="form-group">
                <label class="scheduletest" for="name">Schedule of Test</label>
                <input class="scheduletest" type="text" id="name" name="name" value="{{ $sampleRequisition->sampleReport->schedule_of_test }}">
            </div>
            <div class="form-group">
                <label class="estcompletiondate" for="name">Est of Completion Date</label>
                <input class="estcompletiondate" type="text" id="name" name="name" value="{{ $sampleRequisition->sampleReport->est_of_completion_date }}">
            </div>
        </div>

        <br>
        <br>

    </div>



    {{-- SAMPLE TESTING REPORT --}}

    <div class="pdf-container">
        <h1>PT SIMATELEX MANUFACTORY BATAM</h1>
        <h2>SAMPLE TESTING REPORT</h2>
        <div class="form-row">
            <div class="form-group">
                <label class="modelreport" for="name">Model</label>
                <input type="text" id="name" name="name" style="padding: 3px; width: 15%;" value="OPP">
            </div>
            <div class="form-group">
                <label style="margin-left: -120px;" for="name">No of Sample</label>
                <input style="width:15%; padding:3px;" type="text" id="name" name="name" value="2pcs">
            </div>
            <div class="form-group">
                <label style="margin-right: 300px;" for="name">No of Sample</label>
                <input style="width:15%; padding:3px;" type="text" id="name" name="name" value="2pcs">
            </div>
            {{-- <div class="form-group">
                <label class="email" for="email">Series</label>
                <input type="email" id="email" name="email">
            </div> --}}
            {{-- <div class="form-group">
                <label for="address">Alamat</label>
                <textarea id="address" name="address"></textarea>
            </div> --}}
        </div>
        <br>

        <div class="form-row">
            <div class="form-group">
                <label class="series" for="name">Series</label>
                <input type="text" id="name" name="name" value="RRU172337901DST">
            </div>
            <div class="form-group">
                <label class="process" for="name">Process</label>
                <input type="text" id="name" name="name" value="QCA">
            </div>
        </div>

        <br>

        <div class="form-row">
            <div class="form-group">
                <label for="name">C/O No</label>
                <input type="text" id="name" name="name" value="N/A">
            </div>
            <div class="form-group">
                <label class="mfg" for="name">MFG Sample Date</label>
                <input type="text" id="name" name="name" value="2024-10-07">
            </div>
        </div>
        <br>
        <hr>
        <br>

        <div class="form-row">
            <div class="form-group">
                <label for="name">Received Sample (Date)</label>
                <input class="purposesize" type="text" id="name" name="name" value="2024-10-07">
            </div>
        </div>

        <br>

        <div class="form-row">
            <div class="form-group">
                <label class="tracebilitydatecode" for="name">Tracebility (Date Code)</label>
                <input class="purposesize" type="text" id="name" name="name" value="2024-10-07">
            </div>
        </div>

        <br>

        <div class="form-row">
            <div class="form-group">
                <label class="completiondate" for="name">Person in Charge</label>
                <input class="purposesize" type="text" id="name" name="name" value="2024-10-07">
            </div>
        </div>
        <br>
        <hr>
        <br>

        <div class="form-row">
            <div class="form-group">
                <label class="testpurpose" for="name">Test Purpose</label>
                <input class="purposesize" type="text" id="name" name="name" value="Normal Life and Realibity Test">
            </div>
        </div>
        <br>
        <div class="form-row">
            <div class="form-group">
                <label class="testpurpose" for="name">Test Item</label>
                <input class="purposesize" type="text" id="name" name="name" value="Normal Life and Realibity Test">
            </div>
        </div>

        <br>

        <div class="form-group">
            <label for="address">Summary</label>
            <textarea id="address" name="address">Before :</textarea>
        </div>
        <hr>
        <br>

        <div class="form-row">
            <div class="form-group">
                <label class="qereview" for="name">QE Review</label>
                <input class="qereview" type="text" id="name" name="name" value="Rino">
            </div>
            <div class="form-group">
                <label class="regaccepted" for="name">Reg Accepted</label>
                <input type="text" id="name" name="name" value="Yes">
            </div>
        </div>

        <br>

        <div class="form-row">
            <div class="form-group">
                <label class="scheduletest" for="name">Schedule of Test</label>
                <input class="scheduletest" type="text" id="name" name="name" value="2024-10-07">
            </div>
            <div class="form-group">
                <label class="estcompletiondate" for="name">Est of Completion Date</label>
                <input class="estcompletiondate" type="text" id="name" name="name" value="2024-10-08">
            </div>
        </div>

        <br>
        <br>

    </div>


    
    
</body>
</html>