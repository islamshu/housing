<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    protected $table = 'employees';
    
    public function room()
    {
        return $this->belongsToMany(Room::class, 'employee_room', 'employee_id', 'room_id')
            ->withPivot('created_at', 'updated_at') // إذا كنت تريد الوصول إلى بيانات العلاقة
            ->withTimestamps(); // إذا كنت تريد استخدام الحقول الزمنية


    }
}
