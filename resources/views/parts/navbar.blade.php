<nav class="main-header navbar navbar-expand navbar-dark navbar-primary bg-orange">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link toggle-menu" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('/') }}" class="nav-link">Inicio</a>
        </li>
    </ul>
    
    <ul class="navbar-nav ml-auto">
        @canany(['isSuper','isAdmin','isGerente'])
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">{{ $global_notifications->count() }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">{{ $global_notifications->count() }} Notificaciones</span>
                    <div class="dropdown-divider"></div>
                    <a href="{{ url('/notifications') }}" class="dropdown-item dropdown-footer">Ver todas las Notificaciones</a>
                </div>
            </li>
        @endcanany
        @if ( Auth::user()->roles->isNotEmpty() ) 
            <li class="nav-item d-none d-sm-inline-block">
                <span class="nav-link">
                    <i class="fa fa-user-circle"></i>
                    {{ Auth::user()->name }}
                </span>
            </li>
        @endif
    </ul>
</nav>