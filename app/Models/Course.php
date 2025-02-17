<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'duration'];

    public function enrollments()
{
    return $this->hasMany(Enrollment::class, 'course_id');
}

public function students()
{
    return $this->hasManyThrough(Student::class, Enrollment::class, 'course_id', 'id', 'id', 'student_id');
}
}
