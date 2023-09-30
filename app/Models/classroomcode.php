<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classroomcode extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'student_id',
        'classroom_id',
        'code',
        'date_joined',
    ];
    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    
}
