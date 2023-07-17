<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\VaccineType;


class NewVaccineNotification extends Notification
{
    use Queueable;

    public $vaccine;

    public function __construct(VaccineType $vaccine)
    {
        $this->vaccine = $vaccine;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toWeb($notifiable)
    {
        $vaccineName = $this->vaccine->name;

        $message = 'A new vaccine has been added: ' . $vaccineName;

        return [
            'title' => 'New Vaccine Added',
            'message' => $message,
            'url' => '/vaccines/' . $this->vaccine->id,
        ];
    }

    public function toArray($notifiable)
    {
        $vaccineName = $this->vaccine->name;

        $message = 'A new vaccine has been added: ' . $vaccineName;

        return [
            'title' => 'New Vaccine Added',
            'message' => $message,
            'url' => '/vaccines/' . $this->vaccine->id,
        ];
    }
}
