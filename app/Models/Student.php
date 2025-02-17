<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }
    
    public function courses()
    {
        return $this->hasManyThrough(Course::class, Enrollment::class, 'student_id', 'id', 'id', 'course_id');
    }
}
