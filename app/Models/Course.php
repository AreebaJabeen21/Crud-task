<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
       'course_code',
       'course_title',
       'course_hours'
    ];

    public function students()
  {
    return $this->belongsToMany(Student::class,'course_student');
  }
}
