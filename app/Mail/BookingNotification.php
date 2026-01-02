<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingNotification extends Mailable
{
    use SerializesModels;

    public $bookingData;
    public $customerData;

    public function __construct($bookingData, $customerData)
    {
        $this->bookingData = $bookingData;
        $this->customerData = $customerData;
    }

    public function build()
    {
        return $this->subject('Toyota Test Drive - Booking Confirmation')
                    ->view('emails.booking-confirmation')
                    ->with([
                        'booking' => $this->bookingData,
                        'customer' => $this->customerData,
                    ]);
    }
}