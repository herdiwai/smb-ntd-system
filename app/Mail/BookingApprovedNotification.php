<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingApprovedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->subject('Meeting Room Booking Approved')
                    ->view('backend.personel.meeting_room.booking_approved_notification')
                    ->with([
                        'name' => $this->booking->Name,
                        'department' => $this->booking->Department,
                        'rooms' => $this->booking->meetingroom,
                        'date' => $this->booking->Date_booking,
                        'start_time' => $this->booking->Start_time,
                        'end_time' => $this->booking->End_time,
                        'description' => $this->booking->Description,
                        'status' => $this->booking->Status_booking,
                    ]);
    }
}
