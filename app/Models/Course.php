<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'course';

    public function reviews()
    {
        return $this->hasMany(Review::class, 'course_id');
    }

}
