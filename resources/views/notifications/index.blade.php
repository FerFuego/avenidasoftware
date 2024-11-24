@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestion de Notificaciones</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Notificaciones</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-bell"></i>
                    Notificaciones
                </div>
                <div class="card-body">
                    <div class="row p-0">
                        <div class="col-md-6 p-0">{{-- Actions ---}}</div>
                        <div class="col-md-6 p-0 mb-2">
                            <a href="{{ route('notifications.index', ['filter' => 'all']) }}" class="btn btn-primary ml-2 float-right">Mostrar Todos</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="tableSucursals" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fecha</th>
                                        <th>Tipo</th>
                                        <th>Titulo</th>
                                        <th>Usuario</th>
                                        <th>Inmueble</th>
                                        <th>Estado</th>
                                        <td>Acciones</td>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fecha</th>
                                        <th>Tipo</th>
                                        <th>Titulo</th>
                                        <th>Usuario</th>
                                        <th>Inmueble</th>
                                        <th>Estado</th>
                                        <td>Acciones</td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($notifications as $notification)
                                        <tr>
                                            <td>{{ $notification->id }}</td>
                                            <td>{{ $notification->created_at->format('j F, Y - H:i \h\s') }}</td>
                                            <td>{{ $notification->type }}</td>
                                            <td>{{ $notification->title }}</td>
                                            <td>
                                                @if ( $notification->user )
                                                    <span class="badge badge-info">
                                                        {{ $notification->user['name'] }} 
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ( $notification->sucursal )
                                                    <span class="badge badge-info">
                                                        {{ $notification->sucursal['name'] }} 
                                                    </span>
                                                @endif
                                            </td>
                                            <td id="js-read-{{$notification->id}}">
                                                @if ( $notification->state == 0 )
                                                    <span class="badge badge-success">Nueva</span>
                                                @else
                                                    Leida
                                                @endif
                                            <td>
                                                @if ( $notification->state == 0 )   
                                                    <a class="btn btn-primary btn-sm js-read" href="#" data-notificationid="{{ $notification->id }}">
                                                        <i class="fas fa-check mr-1"></i> Leida
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
</section>

@endsection
