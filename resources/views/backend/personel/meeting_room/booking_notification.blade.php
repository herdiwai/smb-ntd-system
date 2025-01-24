
<p><strong>Name:</strong> {{ $name }}</p>
<p><strong>Department:</strong> {{ $department }}</p>

<p><strong>Meeting Room:</strong></p>
<ul>
    @foreach ($rooms as $room)
        <li>{{ $room->Lot }} |{{ $room->Room_no }} | {{ $room->Location }} | {{ $room->Usage }}</li>
    @endforeach
</ul>

<p><strong>Date:</strong> {{ $date }}</p>
<p><strong>Time:</strong> {{ $start_time }} - {{ $end_time }}</p>
<p><strong>Description:</strong> {{ $description }}</p>
<p><strong>Status:</strong> {{ $status }}</p>
{{-- <p>Please check the system for more details.</p> --}}
