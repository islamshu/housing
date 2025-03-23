<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded=[];
    public function employess()
    {
        return $this->belongsToMany(Teacher::class, 'employee_room', 'room_id', 'employee_id')
            ->withPivot('created_at', 'updated_at')
            ->withTimestamps();
    }
    /**
     * Get the user that owns the Room
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
