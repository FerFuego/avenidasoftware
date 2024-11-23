<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="../../img/logo-xs.webp"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        @guest
            {{-- Nothing --}}
        @else
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>
        @endguest

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                @cannot('isOperario')    
                    {{-- Nothing --}}
                @endcannot

                @can('isSuper')
                    <li class="nav-item">
                        <a href="{{ url('/roles') }}" class="nav-link">
                            <i class="nav-icon fas fa-unlock-alt"></i>
                            <p>Roles</p>
                        </a>
                    </li>
                @endcan

                @canany(['isSuper','isAdmin','isGerente'])
                    <li class="nav-item">
                        <a href="{{ url('/users') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/sucursals') }}" class="nav-link">
                            <i class="nav-icon fas fa-store"></i>
                            <p>Inmuebles</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/notifications') }}" class="nav-link">
                            <i class="nav-icon fas fa-bell"></i>
                            <p>Notificaciones</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/tasks') }}" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Tareas</p>
                        </a>
                    </li>
                @endcanany

                @can('isEncargado')
                    <li class="nav-item">
                        <a href="{{ url('/todos/check') }}" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Tareas</p>
                        </a>
                    </li>
                @endcan

                @can('isOperario')
                    <li class="nav-item has-treeview">
                        <a href="{{ url('/') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @endcan

                <li class="nav-item has-treeview">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        Cerrar Sesión
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>