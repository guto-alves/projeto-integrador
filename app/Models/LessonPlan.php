<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'content'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
