
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
    padding: 15px;
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
    margin-bottom: 25px;
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
.test_item {
    margin-right: 125px;
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

.inspector {
    width: 25%;
    margin-right: 40px;
}
.review {
    width: 25%;
    margin-right: 55px;
}
.result {
    width: 25%;
    margin-right: 60px;
}
.approved {
    width: 25%;
    margin-right: 40px;
}
.date {
    width: 25%;
    margin-right: 45px;
    margin-left: 30px;
}
.remark {
    width: 25%;
    margin-right: 20px;
    margin-left: 30px;
}


.test_result {
    font-size: 13px;
    width: 20%;
    margin-right: 40px;
}
.check_by {
    font-size: 13px;
    width: 20%;
    margin-right: 50px;
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
    padding: 3px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    margin-bottom: 15px;
}

input {
    width: 25%;
    padding: 5px;
    border: 1px solid #585454;
    border-radius: 2px;
    font-size: 14px;
    position: absolute;
}

textarea {
    height: 90px;
    border: 1px solid #585454;
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
    /* border: 5px solid black; */
    pointer-events: none;
    z-index: -1;
}

.modelreport {
    font-size: 15px;
}
.doc-number {
    text-align: right;
    font-size: 13px;
    margin-bottom: 5px;
}


</style>

</head>
<body>
        <h1>PT SIMATELEX MANUFACTORY BATAM</h1>
        <h2>SAMPLE TESTING REQUISITION</h2>
        <div class="doc-number">
            <strong>Doc No: </strong> {{ $sampleRequisition->process->process }}/
            {{ $sampleRequisition->lot->lot }}/
            {{ $sampleRequisition->modelBrewer->model }}/
            {{ $sampleRequisition->sample_subtmitted_date }}/
            {{ $sampleRequisition->do_no }}/
            {{ $sampleRequisition->incomming_number }}
        </div>
    <div class="pdf-container">
        
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

        <div class="form-row">
            <div class="form-group">
                <label class="check_by" for="name">Check By</label>
                <input class="check_by" type="text" value="{{ $sampleRequisition->check_by }}">
            </div>
        </div>
        <br>
        <hr>

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
        <div class="form-row">
            <div class="form-group">
                <label class="test_result" for="name">Test Result:</label>
                <input class="test_result" type="text" value="{{ $sampleRequisition->sampleReport->result_test }}">
            </div>
        </div>


    </div>
<br>
<br>


    {{-- SAMPLE TESTING REPORT --}}

    <h1>PT SIMATELEX MANUFACTORY BATAM</h1>
    <h2>SAMPLE TESTING REPORT</h2>
    {{-- <div class="doc-number">
        <strong>Doc No: </strong> {{ $sampleRequisition->process->process }}/
        {{ $sampleRequisition->lot->lot }}/
        {{ $sampleRequisition->modelBrewer->model }}/
        {{ $sampleRequisition->sample_subtmitted_date }}/
        {{ $sampleRequisition->do_no }}/
        {{ $sampleRequisition->incomming_number }}
    </div> --}}
<div class="pdf-container">
    
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

    {{-- <div class="form-row">
        <div class="form-group">
            <label class="completiondate" for="name">Completion Date</label>
            <input class="purposesize" type="text" id="name" name="name" value="{{ $sampleRequisition->completion_date }}">
        </div>
    </div> --}}
    <hr>

    <div class="form-row">
        <div class="form-group">
            <label class="testpurpose" for="name">Test Purpose</label>
            <input class="purposesize" type="text" id="name" name="name" value="{{ $sampleRequisition->testpurpose }}">
        </div>
    </div>
    <br>
    <div class="form-row">
        <div class="form-group">
            <label class="test_item" for="name">Test Item</label>
            <input class="purposesize" type="text" id="name" name="name" value="{{ $sampleRequisition->test_purpose }}">
        </div>
    </div>
    <br>
    <div class="form-group">
        <label for="address">Summary</label>
        <textarea id="address" name="address">Before : {{ $sampleRequisition->test_purpose }}</textarea>
    </div>
    <br>
    <div class="form-group">
        <label for="address">Summary</label>
        <textarea id="address" name="address">After : {{ $sampleRequisition->sampleReport->summary_after }}</textarea>
    </div>

    {{-- <div class="form-row">
        <div class="form-group">
            <label class="check_by" for="name">Check By</label>
            <input class="check_by" type="text" value="{{ $sampleRequisition->check_by }}">
        </div>
    </div> --}}
    <br>
    <br>


    {{-- <div class="form-row">
        <div class="form-group">
            <label class="model" for="name">Result</label>
            <input type="text" id="name" name="name" value="{{ $sampleRequisition->sampleReport->result_test }}">
        </div>
        <div class="form-group">
            <label class="noofsample" for="name">Remark</label>
            <input type="text" id="name" name="name" value="{{ $sampleRequisition->sampleReport->remark_test }}">
        </div> --}}
        {{-- <div class="form-group">
            <label class="email" for="email">Series</label>
            <input type="email" id="email" name="email">
        </div> --}}
        {{-- <div class="form-group">
            <label for="address">Alamat</label>
            <textarea id="address" name="address"></textarea>
        </div> --}}
    {{-- </div>
    <br> --}}

    {{-- <div class="form-row">
        <div class="form-group">
            <label class="series" for="name">Inspector</label>
            <input type="text" id="name" name="name" value="{{ $sampleRequisition->sampleReport->inspector }}">
        </div>
        <div class="form-group">
            <label class="process" for="name">Date</label>
            <input type="text" id="name" name="name" value="{{ $sampleRequisition->sampleReport->date }}">
        </div>
    </div>

    <br>

    <div class="form-row">
        <div class="form-group">
            <label for="name">Review</label>
            <input type="text" id="name" name="name" value="{{ $sampleRequisition->sampleReport->date }}">
        </div>
        <div class="form-group">
            <label class="mfg" for="name">Date</label>
            <input type="text" id="name" name="name" value="{{ $sampleRequisition->sampleReport->date }}">
        </div>
    </div>

    <br>

    <div class="form-row">
        <div class="form-group">
            <label for="name">Approved</label>
            <input type="text" id="name" name="name" value="{{ $sampleRequisition->statusApprovals->status }}">
        </div>
        <div class="form-group">
            <label class="mfg" for="name">Date</label>
            <input type="text" id="name" name="name" value="{{ $sampleRequisition->sampleReport->date }}">
        </div>
    </div>



<br> --}}





    <div class="form-row">
        <div class="form-group">
            <label class="result" for="name">Result</label>
                <input class="result" type="text" id="name" name="name" value="{{ $sampleRequisition->sampleReport->result_test }}">
        </div>
        <div class="form-group">
            <label class="remark" for="name">Remark</label>
            <input class="remark" type="text" id="name" name="name" value="{{ $sampleRequisition->sampleReport->remark_test }}">
        </div>
    </div>

    <br>

    <div class="form-row">
        <div class="form-group">
            <label class="inspector" for="name">Inspector</label>
            <input class="inspector" type="text" id="name" name="name" value="{{ $sampleRequisition->sampleReport->inspector }}">
        </div>
        <div class="form-group">
            <label class="date" for="name">Date</label>
            <input class="date" type="text" id="name" name="name" value="{{ $sampleRequisition->sampleReport->date }}">
        </div>
    </div>
    <br>
    <div class="form-row">
        <div class="form-group">
            <label class="review" for="name">Review</label>
            <input class="review" type="text" id="name" name="name" value="Dian">
        </div>
        <div class="form-group">
            <label class="date" for="name">Date</label>
            <input class="date" type="text" id="name" name="name" value="{{ $sampleRequisition->sampleReport->date }}">
        </div>
    </div>
<br>
    <div class="form-row">
        <div class="form-group">
            <label class="approved" for="name">Approved</label>
            <input class="approved" type="text" id="name" name="name" value="Andri">
        </div>
        <div class="form-group">
            <label class="date" for="name">Date</label>
            <input class="date" type="text" id="name" name="name" value="{{ $sampleRequisition->sampleReport->date }}">
        </div>
    </div>


</div>


    
    
</body>
</html>