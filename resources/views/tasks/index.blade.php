@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestion de Tareas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Tareas</li>
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
                    <i class="fas fa-tasks"></i>
                    Tareas
                </div>
                <div class="card-body row">
                    <div class="col-md-4">
                        <a href="{{ route('tasks.create') }}" class="btn btn-info mb-2"><i class="fas fa-plus"></i> Agregar Nueva Tarea</a>
                    </div>
                    <div class="col-md-8 p-0">
                        <form action="{{ route('tasks.index') }}" method="GET">
                            <input type="submit" value="Filtrar" class="btn btn-primary ml-2 float-right">
                            <select name="state" id="sate" class="form-control w-25 float-right">
                                <option value="all">Estados (Todos)</option>
                                <!-- If get state is pending in url -->
                                <option value="Pendiente" {{ request()->get('state') == 'Pendiente' ? 'selected' : '' }}>Pendientes</option>
                                <option value="Cancelada" {{ request()->get('state') == 'Cancelada' ? 'selected' : '' }}>Canceladas</option>
                                <option value="Completada" {{ request()->get('state') == 'Completada' ? 'selected' : '' }}>Completas</option>
                                <option value="En Proceso" {{ request()->get('state') == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                                <option value="Incompleta" {{ request()->get('state') == 'Incompleta' ? 'selected' : '' }}>Incompleta</option>
                            </select>
                            <select name="sucursal" id="sucursal" class="form-control mr-2 w-25 float-right">
                                <option value="all">Inmuebles (Todos)</option>
                                @foreach($sucursals as $sucursal)
                                    <option value="{{ $sucursal->id }}" {{ request()->get('sucursal') == $sucursal->id ? 'selected' : '' }}>{{ $sucursal->name }}</option>
                                @endforeach
                            </select>
                            <select name="client" id="client" class="form-control mr-2 w-25 float-right">
                                <option value="all">Clientes (Todos)</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ request()->get('client') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tableSucursals" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha de Creación</th>
                                    <th>Fecha de Entrega</th>
                                    <th>Cliente</th>
                                    <th>Inmueble</th>
                                    <th>Tarea</th>
                                    <th>Responsable/s</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha de Creación</th>
                                    <th>Fecha de Entrega</th>
                                    <th>Cliente</th>
                                    <th>Inmueble</th>
                                    <th>Tarea</th>
                                    <th>Responsable/s</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $task->id }}</td>
                                        <td>{{ $task->created_at->locale('es')->translatedFormat(('j F, Y')) }}</td>
                                        <td>{{ Carbon\Carbon::parse($task->due_date)->locale('es')->translatedFormat(('j F, Y')) }}</td>
                                        <td>
                                            @foreach($sucursals as $sucursal)
                                                @if ($sucursal->id == $task->sucursals->first()->id)
                                                    <span class="badge badge-info">
                                                        {{ $sucursal->users ? $sucursal->users->first()->name : ''}}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($task->sucursals as $sucursal)
                                                {{ $sucursal->name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $task->title }}</td>
                                        <td>
                                            @foreach($task->users as $user)
                                            <span class="badge badge-success">
                                                {{ $user->name }}
                                            </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($task->state == 'Completada')
                                                <span class="badge badge-success">{{ $task->state }}</span>
                                            @elseif ($task->state == 'En Proceso')
                                                <span class="badge badge-warning">{{ $task->state }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $task->state }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-primary btn-sm align-self-center mr-2" href="{{ url('/tasks/'. $task->id ) }}">
                                                    <i class="fas fa-eye"></i> Ver
                                                </a>
                                                <a class="btn btn-info btn-sm align-self-center mr-2" href="{{ url('/tasks/'. $task->id .'/edit') }}">
                                                    <i class="fas fa-pencil-alt"></i> Editar
                                                </a>
                                                <a class="btn btn-danger btn-sm align-self-center" href="#" data-toggle="modal" data-target="#deleteTaskModal" data-taskid="{{ $task->id }}">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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