<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // tasks with users
        return view('tasks.index', [
            'tasks' => Task::with('users')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create', [
            'users' => User::orderBy('name', 'asc')->get(),
            'sucursals' => Sucursal::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create($request->all());

         // attach new users
        foreach ($request->gerents as $user_id) {
            $user = User::where('id', $user_id)->first();
            $user->tasks()->attach($task->id);
        }

        // attach new sucursals
        foreach ($request->sucursals as $sucursal_id) {
            $sucursal = Sucursal::where('id', $sucursal_id)->first();
            $sucursal->todo_tasks()->attach($task->id);
        }
        
        session()->flash('success', 'Tarea Creada Correctamente!');

        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show ', [
            'task' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'users' => User::orderBy('name', 'asc')->get(),
            'sucursals' => Sucursal::orderBy('name', 'asc')->get(),
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->fill($request->all())->update();

        // detach all users and sucursals
        $task->users()->detach();
        $task->sucursals()->detach();

        // attach new users
        foreach ($request->gerents as $user_id) {
            $user = User::where('id', $user_id)->first();
            $user->tasks()->attach($task->id);
        }

        // attach new sucursals
        foreach ($request->sucursals as $sucursal_id) {
            $sucursal = Sucursal::where('id', $sucursal_id)->first();
            $sucursal->todo_tasks()->attach($task->id);
        }

        session()->flash('success','Tarea Actualizada Correctamente!');

        return view('tasks.edit', [
            'task' => $task,
            'users' => User::orderBy('name', 'asc')->get(),
            'sucursals' => Sucursal::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        session()->flash('success','Tarea Eliminada Correctamente!');

        return redirect('/tasks');
    }
}
