<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'course_id',
        'description',

    ];

//    public function contents(){
//       return $this->hasMany(Content::class);
//    }
}
