@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestion de Usuarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
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
                    <i class="fas fa-users"></i>
                    Usuarios
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                          <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('users.create') }}" class="btn btn-info mb-2"><i class="fas fa-plus"></i> Agregar Nuevo Usuario</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tableUsers" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Permisos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Permisos</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($users as $key => $user)
                                    {{-- Skip superadmin --}}
                                    @if ( ! Auth::user()->hasRole('superadmin') && $user->hasRole('superadmin') ) @continue; @endif 

                                    <tr class="{{ Auth::user()->id == $user->id ? 'table-primary' : '' }}">
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ( $user->roles->isNotEmpty() )
                                                @foreach ( $user->roles as $role ) 
                                                    <span class="badge badge-primary">
                                                        {{ $role->name }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if ( $user->permissions->isNotEmpty() )
                                                @foreach ( $user->permissions as $permission ) 
                                                    <span class="badge badge-success">
                                                        {{ $permission->name }} 
                                                    </span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-info btn-sm align-self-center mr-2" href="{{ url('/users/'. $user->id .'/edit') }}">
                                                    <i class="fas fa-pencil-alt"></i> Editar
                                                </a>
                                                <a class="btn btn-danger btn-sm align-self-center" href="#" data-toggle="modal" data-target="#deleteModal" data-userid="{{ $user->id }}">
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
