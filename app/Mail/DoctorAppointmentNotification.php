<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DoctorAppointmentNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $patient_name;
    public $doc_name;
    public $appointment_date;
    public function __construct($patient_name, $appointment_date, $doc_name)
    {
        $this->patient_name = $patient_name;
        $this->doc_name = $doc_name;
        $this->appointment_date = $appointment_date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from('junaid.jalil@vaival.com', 'Junaid Jalil')
        ->subject('Appointment')
        ->view('emails.doctor_appointment_notification');

    }
}