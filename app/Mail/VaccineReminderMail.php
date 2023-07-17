<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Infant;
use App\Models\VaccineType;

class VaccineReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $infant;
    public $vaccine;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Infant  $infant
     * @param  \App\Models\Vaccine  $vaccine
     * @return void
     */
    public function __construct(Infant $infant, VaccineType $vaccine)
    {
        $this->infant = $infant;
        $this->vaccine = $vaccine;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Vaccine Reminder')
                    ->view('emails.vaccine-reminder');
    }
}
