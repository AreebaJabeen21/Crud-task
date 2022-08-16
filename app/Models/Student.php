<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Student extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'cnic',
        'dob',
        'age',
        'gender'
     ];
     public function courses()
  {
    return $this->belongsToMany(Course::class,'course_student');
  }
}
