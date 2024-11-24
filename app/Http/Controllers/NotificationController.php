<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Notification::query();
        
        if ( $request->filter == 'all' ) {
            $query->orderBy('created_at', 'desc');
        } else {
            // Admins
            if (auth()->user()->roles->first()->slug == "superadmin" || auth()->user()->roles->first()->slug == "admin") {
                $query->where('state', '0')
                    ->orderBy('created_at', 'desc');
            } else {
                // Operario
                $query->where('user_id', auth()->user()->id)
                    ->where('state', '0')
                    ->orderBy('created_at', 'desc');
            }
        }

        $notifications = $query->get();

        return view('notifications/index', [
            'notifications' => $notifications
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        $notification = Notification::find($request->notification_id);
        $notification->fill($request->only('state'))->update();

        return response()->json( 'work!' );  
    }

}
