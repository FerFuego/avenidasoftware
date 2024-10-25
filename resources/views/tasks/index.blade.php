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
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                          <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('tasks.create') }}" class="btn btn-info mb-2"><i class="fas fa-plus"></i> Agregar Nueva Tarea</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tableSucursals" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
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
                                    <th>Fecha</th>
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
                                        <td>{{ $task->created_at != null ? $task->created_at->format('j F, Y') : $task->created_at }}</td>
                                        <td>
                                            @foreach($task->sucursals as $sucursal)
                                                <span class="badge badge-info">
                                                    {{ $sucursal->name }}
                                                </span>
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
                                            @if ($task->state == 'Completado')
                                                <span class="badge badge-success">{{ $task->state }}</span>
                                            @elseif ($task->state == 'Proceso')
                                                <span class="badge badge-warning">{{ $task->state }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $task->state }}</span>
                                            @endif
                                        </td>
                                        <td class="d-flex">
                                            <a class="btn btn-primary btn-sm align-self-center mr-2" href="{{ url('/tasks/'. $task->id ) }}">
                                                <i class="fas fa-eye"></i> Ver
                                            </a>
                                            <a class="btn btn-info btn-sm align-self-center mr-2" href="{{ url('/tasks/'. $task->id .'/edit') }}">
                                                <i class="fas fa-pencil-alt"></i> Editar
                                            </a>
                                            <a class="btn btn-danger btn-sm align-self-center" href="#" data-toggle="modal" data-target="#deleteTaskModal" data-taskid="{{ $task->id }}">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </a>
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