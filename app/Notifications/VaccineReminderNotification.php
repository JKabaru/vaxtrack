<?php


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Infant;
use App\Models\InfantVaccine;

class VaccineReminderNotification extends Notification
{
    use Queueable;

    public $infant;
    public $vaccine;

    public function __construct(Infant $infant, InfantVaccine $vaccine)
    {
        $this->infant = $infant;
        $this->vaccine = $vaccine;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toWeb($notifiable)
    {
        $infantLastName = $this->infant->last_name;
        $infantOthertName = $this->infant->other_name;

        $vaccineName = $this->vaccine->vaccine->name;

        $message = 'Reminder: ' . $infantLastName . $infantOthertName . ' is due for the ' . $vaccineName . ' vaccine.';

        return [
            'title' => 'Vaccine Reminder',
            'message' => $message,
            'url' => '/infants/' . $this->infant->id,
        ];
    }

    public function toArray($notifiable)
    {
        $infantLastName = $this->infant->last_name;
        $infantOthertName = $this->infant->other_name;

        $vaccineName = $this->vaccine->vaccine->name;

        $message = 'Reminder: ' . $infantLastName . $infantOthertName . ' is due for the ' . $vaccineName . ' vaccine.';

        return [
            'title' => 'Vaccine Reminder',
            'message' => $message,
            'url' => '/infants/' . $this->infant->id,
        ];
    }
}
