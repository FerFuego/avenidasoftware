@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Dashboard</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Inicio</a></li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

	<div class="container-fluid">
		<div class="row">
			@canany(['isSuper','isAdmin','isGerente'])
				<div class="col-lg-3 col-6">
					<div class="small-box bg-success">
						<div class="inner">
							<h3>{{ $clients }}</h3>
							<p>Total Clientes</p>
						</div>
						<div class="icon">
							<i class="ion ion-ios-people"></i>
						</div>
						<a href="{{ route('users.index', ['filter' => 'cliente']) }}" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-6">
					<div class="small-box bg-info">
						<div class="inner">
							<h3>{{ count($sucursals) }}</h3>
							<p>Cantidad de Inmuebles</p>
						</div>
						<div class="icon">
							<i class="ion ion-ios-home"></i>
						</div>
						<a href="{{ route('sucursals.index') }}" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-6">
					<div class="small-box bg-danger">
						<div class="inner">
							<h3>{{ count($tasks) }}</h3>
							<p>Tareas Pendientes</p>
						</div>
						<div class="icon">
							<i class="ion ion-wineglass"></i>
						</div>
						<a href="{{ route('tasks.index') }}" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
			@endcanany
		</div>
	</div>

	<div class="row">
		<!-- Lista de Tareas Administrativas -->
		@canany(['isSuper','isAdmin','isGerente'])
			<section class="col-lg-12 connectedSortable">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card mb-3">
								<div class="card-header">
									<i class="fas fa-tasks"></i>
									Tareas
								</div>
								<div class="card-body">
									<a href="{{ route('tasks.create') }}" class="btn btn-info mb-2"><i class="fas fa-plus"></i> Agregar Nueva Tarea</a>
									<div class="table-responsive">
										<table class="table table-bordered table-striped" id="tableSucursals" width="100%" cellspacing="0">
											<thead>
												<tr>
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
													<td>{{ $task->created_at->locale('es')->translatedFormat(('j F, Y')) }}</td>
													<td>{{ Carbon\Carbon::parse($task->due_date)->locale('es')->translatedFormat(('j F, Y')) }}</td>
													<td>
														@foreach($sucursals as $sucursal)
															@if ($sucursal->id == $task->sucursals->first()->id)
																<span class="badge badge-info">
																	<!-- user name -->
																	{{ $sucursal->users ? $sucursal->users->first()->name : ''}}
																</span>
															@endif
														@endforeach
													</td>
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
		@endcanany
		<!-- Lista de Tareas Operarios -->
		@can('isOperario')
			<section class="col-lg-9 connectedSortable">
				<div class="row">
					<div class="col-12 connectedSortable">
						@foreach( $sucursals as $j => $sucursal)
							<div class="card">
								<div class="card-header">
									<h3 class="card-title"><strong>Lista de Tareas</strong> - {{ $sucursal->name }}</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
										<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove"><i class="fas fa-times"></i></button>
									</div>
								</div>
								<div class="card-body">
									<ul class="todo-list ui-sortable" data-widget="todo-list">
										@foreach( $tasks as $k => $task )
											@if( isset($task->sucursals) && $task->sucursals->first()->id == $sucursal->id)
												<li class="{{ $task->is_complete ? 'done complete' : '' }}">
													<span class="handle">
														<i class="fas fa-ellipsis-v"></i>
														<i class="fas fa-ellipsis-v"></i>
													</span>
													<div class="icheck-primary d-inline ml-2">
														<input type="checkbox" value="{{ $task->id }}" name="task_id" id="tasks{{ $j.$k }}" {{ $task->is_complete ? 'checked' : '' }}>
														<label for="tasks{{ $j.$k }}" title="Finalizar Tarea"></label>
													</div>
													<span class="text">{{ $task->title }}</span>
													<small class="badge badge-warning {{ $task->state == 'En Proceso' ? 'inline-block' : 'd-none' }}" id="process{{$j.$k}}"><i class="far fa-clock"></i> En Proceso</small>
													<a class="tools text-white btn btn-xs btn-primary d-block" data-id="{{ $task->id }}" href="{{ url('/tasks/'.$task->id) }}" title="Ver Evidencia">
													<i class="fas fa-lg fa-edit" title="Subir Evidencia"></i> Editar
													</a>
													<div class="tools text-white btn-xs mr-2 btn btn-warning todo-state {{ $task->state == 'En Proceso' || $task->state == 'Completada' ? 'd-none' : 'd-block' }}" data-id="{{ $task->id }}" data-state="{{ $task->state }}" data-process="{{$j.$k}}">
														<i class="fas fa-lg fa-clock" title="Comenzar"></i> Comenzar
													</div>
												</li>
											@endif
										@endforeach
									</ul>
								</div>
								<div class="card-footer">
									<strong>Dirección:</strong> {{ $sucursal->address }} | <strong>Horario:</strong> {{ $sucursal->schedule }}
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</section>
		@endcan
		<!-- Lista de Tareas Cliente -->
		@can('isCliente')
			<section class="col-lg-9 connectedSortable">
				<div class="row">
					<div class="col-12 connectedSortable">
						@foreach( $sucursals as $j => $sucursal)
							<div class="card">
								<div class="card-header">
									<h3 class="card-title"><strong>Lista de Tareas</strong> - {{ $sucursal->name }}</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
										<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove"><i class="fas fa-times"></i></button>
									</div>
								</div>
								<div class="card-body">
									<ul class="todo-list ui-sortable" data-widget="todo-list">
										@foreach( $tasks as $k => $task )
											@if( isset($task->sucursals) && $task->sucursals->first()->id == $sucursal->id)
												<li class="{{ $task->is_complete ? 'done complete' : '' }}">
													<span class="text">{{ $task->title }}</span>
													<small class="badge badge-warning {{ $task->state == 'En Proceso' ? 'inline-block' : 'd-none' }}" id="process{{$j.$k}}"><i class="far fa-clock"></i> En Proceso</small>
													<a class="tools text-white btn btn-xs btn-primary d-block" data-id="{{ $task->id }}" href="{{ url('/tasks/'.$task->id) }}" title="Ver Evidencia">
														<i class="fas fa-lg fa-eye" title="Subir Evidencia"></i> Ver
													</a>
												</li>
											@endif
										@endforeach
									</ul>
								</div>
								<div class="card-footer">
									<strong>Dirección:</strong> {{ $sucursal->address }} | <strong>Horario:</strong> {{ $sucursal->schedule }}
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</section>
		@endcan
	</div>

</section>

@endsection