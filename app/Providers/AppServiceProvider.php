<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use App\Observers\TaskObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /* $this->app->bind('path.public', function() {
            return '../public_html';
        });    */
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Configuración para fechas en español
        Carbon::setUTF8(true);
        Carbon::setLocale(config('app.locale'));
        setlocale(LC_TIME, config('app.locale'));

        // Observers
        Task::observe(TaskObserver::class);

        // Paginator
        Paginator::useBootstrap();

        // Compartir informacion a todas las vistas
        if ( Schema::hasTable('notifications')) {
            $global_notifications = Notification::where('state','0')->get();
            view()->share('global_notifications', $global_notifications);
        }
    }
}
