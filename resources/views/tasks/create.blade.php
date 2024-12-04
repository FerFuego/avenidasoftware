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
					<li class="breadcrumb-item"><a href="{{ url('/tasks') }}">Tareas</a></li>
					<li class="breadcrumb-item active">Nueva Tarea</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<section class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Crear Tarea</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
							<i class="fas fa-minus"></i></button>
					</div>
				</div>
				<div class="card-body">
					<form action="{{ route('tasks.store') }}" method="POST">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Inmueble</label>
									<select name="sucursals[]" id="select_inmueble" class="form-control selectpicker" data-live-search="true" required>
										@foreach ( $sucursals as $sucursal )
										<option value="{{ $sucursal->id }}">{{ $sucursal->name }}</option>
										@endforeach
									</select>
									@error('text')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Responsable</label>
									<select name="gerents[]" id="select_gerent" class="form-control selectpicker" data-live-search="true" required>
										@foreach ( $users as $user )
										<option value="{{ $user->id }}">{{ $user->name }}</option>
										@endforeach
									</select>
									@error('text')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="title">Tarea a realizar</label>
							<input type="text" name="title" id="title" class="form-control" placeholder="Ej: Abrir a horario" value="{{ old('title') }}" required>
							@error('text')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="due_date">Fecha de Entrega</label>
									<input type="date" name="due_date" id="due_date" class="form-control" placeholder="Fecha de Entrega">
									@error('due_date')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label>Detalle de la tarea (Opcional)</label>
							<textarea name="description" class="form-control" rows="10" placeholder="Detalle de la tarea">{{ old('description') }}</textarea>
						</div>
						<div class="form-group">
							<input type="hidden" name="state" value="Pendiente">
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