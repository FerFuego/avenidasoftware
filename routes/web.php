<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('signup', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('forgot', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::get('forgot/{token}', 'Auth\ResetPasswordController@showResetForm');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', 'UsersController')->middleware('role:superadmin,admin,gerente');
    Route::resource('roles', 'RolesController')->middleware('can:isSuper');
    Route::resource('sucursals', 'SucursalController')->middleware('role:superadmin,admin,gerente');
    Route::get('sucursal/user/{user}', [App\Http\Controllers\SucursalController::class, 'get']);
    Route::resource('tasks', 'TaskController');
    Route::post('tasks/check', [App\Http\Controllers\TaskController::class,'check']);
    Route::post('tasks/change-state', [App\Http\Controllers\TaskController::class,'change_state']);
    Route::post('tasks/complete', [App\Http\Controllers\TaskController::class,'complete']);
    Route::patch('tasks/observations/{task}', [App\Http\Controllers\TaskController::class,'observations']);
    Route::resource('notifications', 'NotificationController');
    Route::post('photos/store/{task}', [App\Http\Controllers\PhotoController::class, 'store']);
    Route::get('download/{file}', function ($file) {
        return Response::download( public_path('uploads/') . $file);
    });
    Route::delete('photos/{photo}', [App\Http\Controllers\PhotoController::class, 'delete']);
});


if (Auth::id()) {
    return $next($request);
}

return Response::make('Forbidden', 403);