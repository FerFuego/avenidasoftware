<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\Notification;
use Illuminate\Http\Request;

class TaskObserver
{
    /**
     * Handle the todo list "created" event.
     *
     * @param  \App\Models\Task  $Task
     * @return void
     */
    public function created(Task $Task)
    {
        //
    }

    /**
     * Handle the todo list "updated" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {
        $notification = Notification::create([
            'type'      => 'Tarea',
            'title'     => 'Tarea ' . $task->state,
            'detail'    => $task->name,
            'state'     => 0,
            'user_id'       => auth()->user()->id,
            'sucursal_id'   => $task->sucursals[0]->id
        ]);
    }

    /**
     * Handle the todo list "deleted" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {
        //
    }

    /**
     * Handle the todo list "restored" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function restored(Task $task)
    {
        //
    }

    /**
     * Handle the todo list "force deleted" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function forceDeleted(Task $task)
    {
        //
    }
}
