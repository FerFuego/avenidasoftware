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
					<li class="breadcrumb-item"><a href="{{ url('/users') }}">Usuarios</a></li>
					<li class="breadcrumb-item active">Ver Usuario</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3><b>{{ $user->name }}</b></h3>
						<h4><b>{{ $user->email }}</b></h4>
					</div>
					<div class="card-body">
						<h5 class="card-title">Rol</h5>
						<p class="card-text">
							@if ( $user->roles != null )
							@foreach ( $user->roles as $role )
							<span class="badge badge-primary">
								{{ $role->name }}
							</span>
							@endforeach
							@endif
						</p>
						<h5 class="card-title">Permisos</h5>
						<p class="card-text">
							@if ( $role->permissions != null )
							@foreach ( $user->permissions as $permission )
							<span class="badge badge-success">
								{{ $permission->name }}
							</span>
							@endforeach
							@endif
						</p>
					</div>
					<div class="card-footer">
						<a href="{{ url()->previous() }}" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Volver</a>
					</div>
				</div>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
</section>

@endsection