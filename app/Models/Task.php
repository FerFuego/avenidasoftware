<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'state',
        'is_complete',
        'due_date',
    ];

    protected $with = ['users', 'sucursals', 'photos'];

    /**
     * Relationship
     */
    public function photos()
    {
        return $this->hasMany(Photo::class, 'task_id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'users_tasks');
    }

    public function sucursals() {
        return $this->belongsToMany(Sucursal::class, 'sucursals_todo_tasks');
    }
}
