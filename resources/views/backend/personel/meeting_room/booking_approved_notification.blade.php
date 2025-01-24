<p>Dear {{ $name }},</p>

<p>Your meeting room booking has been <strong>Approved</strong>.</p>

<p><strong>Details:</strong></p>
<ul>
    <li><strong>Department:</strong> {{ $department }}</li>
    <li><strong>Meeting Room:</strong></li>
    <ul>
        @foreach ($rooms as $room)
            <li>{{ $room->Lot }} |{{ $room->Room_no }} | {{ $room->Location }} | {{ $room->Usage }}</li>
        @endforeach
    </ul>
    <li><strong>Date:</strong> {{ $date }}</li>
    <li><strong>Time:</strong> {{ $start_time }} - {{ $end_time }}</li>
    <li><strong>Description:</strong> {{ $description }}</li>
    <li><strong>Status:</strong> {{ $status }}</li>
</ul>

<p>Thank you!</p>