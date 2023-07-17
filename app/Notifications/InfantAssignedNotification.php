<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Infant;
use App\Models\User;

class InfantAssignedNotification extends Notification
{
    use Queueable;

    public $infant;
    public $doctor;

    public function __construct(Infant $infant, User $doctor)
    {
        $this->infant = $infant;
        $this->doctor = $doctor;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toWeb($notifiable)
    {
        $infantName = $this->infant->name;
        $doctorName = $this->doctor->name;

        $message = 'You have been assigned to an infant: ' . $infantName;

        return [
            'title' => 'New Infant Assignment',
            'message' => $message,
            'url' => '/infants/' . $this->infant->id,
        ];
    }

    public function toArray($notifiable)
    {
        $infantName = $this->infant->name;
        $doctorName = $this->doctor->name;

        $message = 'You have been assigned to an infant: ' . $infantName;

        return [
            'title' => 'New Infant Assignment',
            'message' => $message,
            'url' => '/infants/' . $this->infant->id,
        ];
    }
}
