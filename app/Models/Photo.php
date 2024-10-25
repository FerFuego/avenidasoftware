<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'photo_path'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
