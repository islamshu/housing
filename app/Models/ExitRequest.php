<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExitRequest extends Model
{
    protected $fillable = [
        'employee_id',
        'room_id',
        'type',
        'exit_time',
        'expected_return_time',
        'destination',
        'transport',
        'has_companion',
        'status',
        'taxi_number',
        'actual_return_time'
    ];
    public function companions()
    {
        return $this->belongsToMany(Teacher::class, 'exit_request_companions', 'exit_request_id', 'teacher_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'employee_id');
    }
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
