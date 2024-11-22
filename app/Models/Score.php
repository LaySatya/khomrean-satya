<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'score';
    protected $primaryKey = 'score_id';
    protected $fillable = ['attendance', 'book', 'homework', 'activity', 'quiz', 'exam', 'student_id'];
}
