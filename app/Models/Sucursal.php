<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'schedule'
    ];

    /**
     * Relationships
     * @return collection
     */
    public function users () {
        return $this->belongsToMany(User::class, 'users_sucursals');
    }

    public function todo_tasks () {
        return $this->belongsToMany(Task::class, 'sucursals_todo_tasks');
    }

}
