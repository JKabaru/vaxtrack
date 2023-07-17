<?php


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\InfantVaccine;
use App\Models\User;
use App\Models\Infant;

class VaccineAdministeredNotification extends Notification
{
    use Queueable;

    public $vaccine;
    public $user;
    public $infant;

    public function __construct(Infant $infant,InfantVaccine $vaccine, User $user)
    {
        $this->infant = $infant;
        $this->vaccine = $vaccine;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toWeb($notifiable)
    {
        $vaccineName = $this->vaccine->vaccine->name;
        $userName = $this->user->name;
        $infantName = $this->infant->name;
        $message = $vaccineName . ' vaccine has been administered to ' . $infantName .'by doctor ' . $userName;

        return [
            'title' => 'Vaccine Administered',
            'message' => $message,
            'url' => '/vaccines/' . $this->vaccine->id,
        ];
    }

    public function toArray($notifiable)
    {
        $vaccineName = $this->vaccine->vaccine->name;
        $userName = $this->user->name;
        $infantName = $this->infant->name;
        $message = $vaccineName . ' vaccine has been administered to ' . $infantName .' by doctor ' . $userName;

        return [
            'title' => 'Vaccine Administered',
            'message' => $message,
            'url' => '/vaccines/' . $this->vaccine->id,
        ];
        
    }
}
