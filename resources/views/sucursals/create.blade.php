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
			<li class="breadcrumb-item"><a href="{{ url('/sucursals') }}">Inmuebles</a></li>
			<li class="breadcrumb-item active">Nueva Inmueble</li>
		  </ol>
		</div>
	  </div>
	</div><!-- /.container-fluid -->
</section>

<section class="content">
	<div class="row">
	  <div class="col-md-6">
		<div class="card">
		  <div class="card-header">
			<h3 class="card-title">Agregar Inmueble</h3>

			<div class="card-tools">
			  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fas fa-minus"></i></button>
			</div>
		  </div>
		  <div class="card-body">
			<form action="{{ route('sucursals.store') }}" method="POST">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="name">Nombre</label>
					<input type="text" name="name" id="name" class="form-control" placeholder="Nombre" value="{{ old('name') }}" required>
					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="form-group">
					<label for="address">Direccion</label>
					<input type="address" name="address" id="address" class="form-control" placeholder="Direccion" value="{{ old('address') }}">
					@error('address')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
                </div>
                <div class="form-group">
					<label for="phone">Telefono</label>
					<input type="phone" name="phone" id="phone" class="form-control" placeholder="Telefono" value="{{ old('phone') }}">
					@error('phone')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
                </div>
                <div class="form-group">
					<label for="schedule">Horario</label>
					<input type="schedule" name="schedule" id="schedule" class="form-control" placeholder="Abierto de 08:00 a 20:00hs" value="{{ old('schedule') }}">
					@error('schedule')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
                </div>
                <div class="form-group">
					<label for="gerents">Asignado</label>
					<select name="gerents[]" id="select_gerent" class="form-control selectpicker" data-live-search="true">
						<option>Seleccione Asignado</option>
						@foreach ( $users as $user )
							<option value="{{ $user->id }}">{{ $user->name }}</option>
						@endforeach
					</select>
				</div>
				<input type="submit" value="Guardar Cambios" class="btn btn-success float-right">
			</form> 
		  </div>
		  <!-- /.card-body -->
		</div>
		<!-- /.card -->
	  </div>
	</div>
	<div class="row">
	  <div class="col-12">
	  	<a href="{{ url()->previous() }}" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Volver</a>
	  </div>
	</div>
  </section>

@endsection