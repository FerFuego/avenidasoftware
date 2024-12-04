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
    public function index(Request $request)
    {
        // Tasks
        $tasks = Task::with('users');

        if ($request->all() && $request->state != 'all') {
            $tasks = $tasks->where('state', $request->state);
        } else if ($request->all() && $request->state == 'all') {
            // all
        }else {
            $tasks = $tasks->where('state', '!=', 'Completada');
        }

        if ($request->all()) {
            $tasks = $tasks->whereHas('sucursals', function ($query) use ($request) {

                if ($request->sucursal != 'all') {
                    $query->where('id', $request->sucursal);
                }
       
                if ($request->all() && $request->client != 'all') {
                    $query->whereHas('users', function ($query) use ($request) {
                        $query->where('id', $request->client);
                    });
                }
            });
        }


        $tasks = $tasks->orderBy('created_at', 'desc')->get();
                
        // Clients
        $clients = User::whereHas('roles', function ($query) {
            $query->where('slug', 'cliente');
        })->get();

        // Sucursals
        $sucursals = Sucursal::orderBy('name', 'asc')->get();

        return view('tasks.index', [
            'tasks' => $tasks,
            'clients' => $clients,
            'sucursals' => $sucursals
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereHas('roles', function ($query) { 
            $query->where('slug', 'operario'); 
        })->orderBy('name', 'asc')->get();
        
        $sucursals = Sucursal::orderBy('name', 'asc')->get();

        return view('tasks.create', [
            'users' => $users,
            'sucursals' => $sucursals
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request, Task $task)
    {
        $t = Task::find($request->task_id);
        $t->fill($request->only('state', 'is_complete'))->update();
        
        return response()->json( $request->all() ); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function change_state(Request $request)
    {
        $t = Task::find($request->task_id);
        $t->fill($request->only('state', 'is_complete'))->update();
        
        return response()->json( $request->all() ); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function observations(Request $request, Task $task) {
        $task->fill($request->only('obser_operario', 'obser_cliente'));
        $task->update();
        
        return view('tasks.show ', [
            'task' => $task
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
