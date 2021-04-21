<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'author_id'
    ];

    public function lesson()
    {
        return $this->belongsTo(LessonPlan::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
