<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomLeaveRequest extends Model
{
    protected $fillable = [
        'employee_id', 'room_id', 'type', 'exit_time', 
        'return_time', 'destination', 'transport', 
        'taxi_number', 'status', 'notes'
    ];

    public function employee()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}