<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class ExitRequest implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     public $exitrequest;

    /**
     * Create a new event instance.
     */
    public function __construct($exitrequest)
    {
        $this->exitrequest = $exitrequest;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function broadcastOn()
    {
        return new Channel('exitrequests');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function broadcastAs()
    {
        return 'create';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'message' => "[{$this->exitrequest->created_at}] New Post Received with title '{$this->exitrequest->title}'."
        ];
    }
}
