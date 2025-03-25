<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ExitRequestSubmitted extends Notification
{
    use Queueable;

    protected $exitRequest;

    public function __construct($exitRequest)
    {
        $this->exitRequest = $exitRequest;
    }

    // Send via database and broadcasting (for real-time notifications)
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    // Save to database
    public function toArray($notifiable)
    {
        return [
            'teacher_name' => $this->exitRequest->teacher->name,
            'room_id' => $this->exitRequest->room_id,
            'type' => $this->exitRequest->type,
            'exit_time' => $this->exitRequest->exit_time,
            'expected_return_time' => $this->exitRequest->expected_return_time,
        ];
    }

    // Broadcast using Reverb
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => "طلب خروج جديد من {$this->exitRequest->teacher->name}",
            'exit_time' => $this->exitRequest->exit_time,
        ]);
    }
}
