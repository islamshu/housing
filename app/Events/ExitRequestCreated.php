<?php
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\Channel;

class ExitRequestCreated implements ShouldBroadcast
{
    public $exitRequest;

    public function __construct($exitRequest)
    {
        $this->exitRequest = $exitRequest;
    }

    public function broadcastOn()
    {
        return new Channel('admin-notifications'); // Broadcasting to admin-notifications channel
    }
}
