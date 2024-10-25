<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Task;
use App\Models\Todo;

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
        $sucursals = auth()->user()->sucursals;

        $notifications = Notification::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();

        $todos = Task::orderBy('id', 'asc')->get();
        
        return view('home', [
            'sucursals' => $sucursals,
            'notifications' => $notifications,
            'todos' => $todos
        ]);
    }

}
