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

				{{-- <div class="col-lg-3 col-6">
					<div class="small-box bg-info">
						<div class="inner">
							<h3>100</h3>
							<p>Total Clientes</p>
						</div>
						<div class="icon">
							<i class="ion ion-ios-people"></i>
						</div>
						<a href="#" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div> --}}
				
				{{-- <div class="col-lg-3 col-6">
					<div class="small-box bg-success">
						<div class="inner">                        
							<h3><sup style="font-size: 20px">$</sup>000</h3>
							<p>Total Ventas</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="#" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div> --}}
				
				{{-- <div class="col-lg-3 col-6">
					<div class="small-box bg-warning">
						<div class="inner">
							<h3>44</h3>
							<p>User Registrations</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div> --}}

				{{-- <div class="col-lg-3 col-6">
					<div class="small-box bg-danger">
						<div class="inner">
							<h3>65</h3>
							<p>Unique Visitors</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div> --}}
				
			</div>
		</div>
		
        <div class="row">
			<!-- Lista de Tareas -->
			@can('isOperario')
				<section class="col-lg-8 connectedSortable">
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
											@foreach( $sucursal->todo_lists as $k => $task )
												@if ( $task->created_at->format('d') == date('d') )
													<li class="{{ $task->is_complete ? 'done' : '' }}">
														<span class="handle">
															<i class="fas fa-ellipsis-v"></i>
															<i class="fas fa-ellipsis-v"></i>
														</span>
														<div  class="icheck-primary d-inline ml-2">
															<input type="checkbox" value="{{ $task->id }}" name="task_id" id="todoCheck{{ $j.$k }}" {{ $task->is_complete ? 'checked' : '' }}>
															<label for="todoCheck{{ $j.$k }}" title="Finalizar Tarea"></label>
														</div>
														<span class="text">{{ $task->name }}</span>
														<small class="badge badge-warning {{ $task->state == 'En Proceso' ? 'inline-block' : 'd-none' }}" id="process{{$j.$k}}"><i class="far fa-clock"></i> En Proceso</small>
														<div class="tools todo-state" data-id="{{ $task->id }}" data-state="{{ $task->state }}" data-process="{{$j.$k}}">
															<i class="fas fa-edit" title="En Proceso"></i>
														</div>
													</li>
												@endif
											@endforeach
										</ul>
									</div>
									<div class="card-footer">
										<strong>Dirección:</strong> {{ $sucursal->address }} |  <strong>Horario:</strong> {{ $sucursal->schedule }}
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

