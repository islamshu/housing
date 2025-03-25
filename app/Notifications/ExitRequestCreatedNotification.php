<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ExitRequestCreatedNotification extends Notification
{
    protected $exitRequest;

    public function __construct($exitRequest)
    {
        $this->exitRequest = $exitRequest;
    }

    // Choose the delivery channels (e.g., database, mail)
    public function via($notifiable)
    {
        return ['database']; // Store notification in the database
    }

    // Define the content of the notification
    public function toDatabase($notifiable)
    {
        return [
            'exit_request_id' => $this->exitRequest->id,
            'exit_time' => $this->exitRequest->exit_time,
            'destination' => $this->exitRequest->destination,
        ];
    }
}
