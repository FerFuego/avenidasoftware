<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Sucursal;
use App\Models\Task;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->roles->first()->slug == "superadmin" || auth()->user()->roles->first()->slug == "admin" || auth()->user()->roles->first()->slug == "gerente") {
            $sucursals = Sucursal::with('users')->orderBy('id', 'asc')->get();
            $tasks   = Task::with('users')->where('state', '!=', 'Completado')->orderBy('id', 'desc')->get();
            $clients = User::whereHas('roles', function ($query) {
                $query->where('slug', 'cliente');
            })->count();
        } else {
            $sucursals = Sucursal::with('todo_tasks.users')
                ->whereHas('todo_tasks', function ($query) {
                    $query->whereHas('users', function ($query) {
                        $query->where('id', auth()->id());
                    });
                })
                ->get();

            $tasks = auth()->user()->tasks;
            $clients = 0;
        }

        $notifications = Notification::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        
        return view('home', [
            'sucursals' => $sucursals,
            'notifications' => $notifications,
            'tasks' => $tasks,
            'clients' => $clients
        ]);
    }

}
