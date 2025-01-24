<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new message instance.
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Booking Details')
                    ->view('backend.personel.meeting_room.booking_notification')
                    ->with([
                        'name' => $this->booking->Name,
                        'department' => $this->booking->Department,
                        'rooms' => $this->booking->meetingroom, // Kirim semua meeting rooms
                        'date' => $this->booking->Date_booking,
                        'start_time' => $this->booking->Start_time,
                        'end_time' => $this->booking->End_time,
                        'description' => $this->booking->Description,
                        'status' => $this->booking->Status_booking,
                    ]);
    }
}
