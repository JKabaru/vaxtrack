<?php

namespace App\Console\Commands;

use App\Models\InfantVaccine;
use Illuminate\Console\Command;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;
use App\Models\User;
use App\Models\Infant;
use App\Models\VaccineType;
use App\Notifications\VaccineReminderNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\VaccineReminderMail;



class SendVaccineReminders extends Command
{
    protected $signature = 'vaccines:reminders';
 
    protected $description = 'Send reminders for upcoming vaccinations';
 
    public function handle()
    {

        // $infants = Infant::all();

        //     foreach ($infants as $infant) {
        //         $vaccines = $infant->infantVaccines()->where('administration_date', '>=', now()->toDateString())->get();

        //         foreach ($vaccines as $vaccine) {
                   
        //             $parents  = User::where('role', 'parent')->get();
                    
        //             foreach ($parents as $parent) {
        //                 $parent->notify(new VaccineReminderNotification($infant, $vaccine));
        //             }
        //         }
        //     }

        $infants = Infant::all();

foreach ($infants as $infant) {
    $parentPhone = $infant->parent_phone;
    $parentEmail = $infant->parent_email;

    $vaccines = InfantVaccine::where('infant_id', $infant->id)
        ->where('completed', false)
        ->whereNotNull('next_due_date')
        ->whereDate('next_due_date', '>=', now()->subDays(3))
        ->whereDate('next_due_date', '<=', now()->addDays(1))
        ->get();

    foreach ($vaccines as $vaccine) {
        $notificationData = [
            'infant' => $infant,
            'vaccine' => $vaccine,
        ];

        // Send SMS notification to parent's phone number
        // Replace the following code with your SMS notification implementation
        // Assuming you have a "VaccineReminderNotification" class for SMS notifications
        // Replace the "notify" method call with the appropriate implementation
        $infant->parent->notify(new VaccineReminderNotification($infant, $vaccine));

        // Send verification email to the specific user
        // Assuming you have a "VaccineReminderMail" class for email notifications
        // Replace the "to" and "send" method calls with the appropriate implementation
        Mail::to($infant->parent_email)->send(new VaccineReminderMail($infant, $vaccine));

        // Notify parent through the application
        // Assuming you have a "VaccineReminderNotification" class for application notifications
        // Replace the "notify" method call with the appropriate implementation
        $infant->parent->notify(new VaccineReminderNotification($infant, $vaccine));
    }
}

        
            



    //     $vaccines = InfantVaccine::where('completed', false)
    //         ->whereNotNull('next_due_date')
    //         ->whereDate('next_due_date', '>=', now()->subDays(3))
    //         ->whereDate('next_due_date', '<=', now()->addDays(1))
    //         ->get();
            

    //     $basic = new Basic("e02e10d4", "n7rIOm80IjZKngWP");
    //     $client = new Client($basic);
       
    //     $infants = Infant::where(function ($query) {
                // $query->whereNotNull('parent_phone')
                // ->orWhereNotNull('parent_email');
                // })->get();

    //     $vaccines_t = VaccineType::all();
    //     foreach ($vaccines as $vaccine) {
    //         $infant = $infants->firstWhere('id', $vaccine->infant_id);
    //         $vaccine_t= $vaccines_t->firstWhere('id', $vaccine->vaccine_id);
    //         
    //         $phoneNumber1 = $infants->parent_phone;
            

    //         // Remove the leading 0
    //         $phoneNumber = ltrim($phoneNumber1, "0");

    //         // Add 254 to the beginning of the phone number
    //         $phoneNumber = "254" . $phoneNumber;
    //         $message = 'Reminder: The vaccination for ' . $infant->name . ' is due on ' . $vaccine->administration_date . ' The vaccine to be 
    //                     administered is '  .$vaccine_t->name . ' of ' . $vaccine_t->recommended_age .  ' months ';

    //         $messageData = [
    //             'to' => $phoneNumber,
    //             'from' => 'vaxTrack',
    //             'text' => $message,
    //             'type' => 'text',
    //             'date' => $vaccine->administration_date,
    //             'status-report-req' => true
    //         ];

    //         $response = $client->message()->send($messageData);
           

            

    //         if ($response['messages'][0]['status'] == 0) {
    //             $this->info("Message sent successfully to $phoneNumber");
    //         } else {
    //             $this->error("Failed to send message to $phoneNumber");
    //         }
    //     }
     }

    


}


