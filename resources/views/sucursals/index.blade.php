@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestion de Inmuebles</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Inmuebles</li>
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
                    <i class="fas fa-store"></i>
                    Inmuebles
                </div>
                <div class="card-body">
                    <a href="{{ route('sucursals.create') }}" class="btn btn-info mb-2"><i class="fas fa-plus"></i> Agregar nuevo Inmueble</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tableSucursals" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Nombre</th>
                                    <th>Direccion</th>
                                    <th>Telefono</th>
                                    <th>Horario</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Nombre</th>
                                    <th>Direccion</th>
                                    <th>Telefono</th>
                                    <th>Horario</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($sucursals as $sucursal)
                                    <tr>
                                        <td>{{ $sucursal->id }}</td>
                                        <td>
                                            @if ( $sucursal->users->isNotEmpty() )
                                                <span class="badge badge-success">
                                                    {{ $sucursal->users->first()->name }} 
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $sucursal->name }}</td>
                                        <td>{{ $sucursal->address }}</td>
                                        <td>{{ $sucursal->phone }}</td>
                                        <td>{{ $sucursal->schedule }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-primary btn-sm align-self-center mr-2" href="{{ url('/sucursals/'. $sucursal->id ) }}">
                                                    <i class="fas fa-folder"></i> Ver
                                                </a>
                                                <a class="btn btn-info btn-sm align-self-center mr-2" href="{{ url('/sucursals/'. $sucursal->id .'/edit') }}">
                                                    <i class="fas fa-pencil-alt"></i> Editar
                                                </a>
                                                <a class="btn btn-danger btn-sm align-self-center" href="#" data-toggle="modal" data-target="#deleteSucursalsModal" data-sucursalid="{{ $sucursal->id }}">
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
