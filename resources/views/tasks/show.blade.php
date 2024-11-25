@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Ver Tarea</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                    @canany(['isSuper','isAdmin','isEncargado'])
                        <li class="breadcrumb-item"><a href="{{ url('/tasks') }}">Tareas</a></li>
                    @endcan
                    <li class="breadcrumb-item active">Ver Tarea</li>
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
                        <div class="row">
                            <div class="col-9">
                                <h3><b>{{ $task->title }}</b></h3>
                                <h6><b>Fecha de creación:</b> {{ $task->created_at->locale('es')->translatedFormat(('j F, Y')) }}</b></h6>
                                <h6><b>Fecha de entrega:</b> {{ Carbon\Carbon::parse($task->due_date)->locale('es')->translatedFormat(('j F, Y')) }}</b></h6>
                            </div>
                            <div class="col-3 text-right">
                                <h6>
                                    <b>Estado:</b> 
                                    @if ($task->state == 'Completada')
                                        <span class="badge badge-success">{{ $task->state }}</span>
                                    @elseif ($task->state == 'En Proceso')
                                        <span class="badge badge-warning">{{ $task->state }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $task->state }}</span>
                                    @endif
                                </h6>
                                <h6>
                                    <b>Asignado a:</b>
                                    @foreach($task->users as $user)
                                        <span class="badge badge-success">{{ $user->name }} </span>
                                    @endforeach
                                </h6>
                                @canany(['isSuper','isAdmin','isGerente','isOperario'])
                                <h6>
                                    <b>Cambiar estado:</b> 
                                    <select name="state" id="state" data-id="{{ $task->id }}" class="form-control todo-state-changer">
                                        <option value="Pendiente" {{ $task->state == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="Cancelada" {{ $task->state == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                                        <option value="Completada" {{ $task->state == 'Completada' ? 'selected' : '' }}>Completada</option>
                                        <option value="En Proceso" {{ $task->state == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                                        <option value="Incompleta" {{ $task->state == 'Incompleta' ? 'selected' : '' }}>Incompleta</option>
                                    </select>
                                </h6>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="text-muted">Datos de lugar</h6>
                        @foreach($task->sucursals as $sucursal)
                            <b>Nombre:</b> {{ $sucursal->name }}<br>
                            <b>Dirección:</b> {{ $sucursal->address }}<br>
                            <b>Teléfono:</b> {{ $sucursal->phone }}<br>
                            <b>Horario:</b> {{ $sucursal->schedule }}<br>
                        @endforeach
                        <hr>
                        <h6 class="text-muted">Detalle de la tarea a realizar:</h6>
                        <p>{!! nl2br($task->description) !!}</p>
                    </div>
                    <div class="card-footer row">
                            <div class="col-12 mb-3 mt-3">
                                <form action="{{ url('tasks/observations/'. $task->id) }}" method="POST">
                                    @method('PATCH')
                                    @csrf()
                                    @canany(['isSuper','isAdmin','isGerente','isOperario'])
                                    <div class="form-group">
                                        <label>Obsevación del operario (Opcional)</label>
                                        <!-- if user isn't a operario textarea is read only -->
                                        <textarea name="obser_operario" class="form-control" rows="4" placeholder="Escriba aquí su observación" {{ (auth()->user()->roles->first()->slug == 'operario') ? '' : 'readonly' }}>{{ $task->obser_operario }}</textarea>
                                    </div>
                                    @endcanany
                                    @canany(['isSuper','isAdmin','isGerente','isCliente'])
                                    <div class="form-group">
                                        <label>Obsevación del cliente (Opcional)</label>
                                        <!-- if user isn't a client textarea is read only -->
                                        <textarea name="obser_cliente" class="form-control" rows="4" placeholder="Escriba aquí su observación" {{ (auth()->user()->roles->first()->slug == 'cliente') ? '' : 'readonly' }}>{{ $task->obser_cliente }}</textarea>
                                    </div>
                                    @endcanany
                                    @canany(['isOperario','isCliente'])
                                    <div class="form-group">
                                        <input type="submit" value="Enviar Observación" class="btn btn-success float-right">
                                    </div>
                                    @endcanany
                                </form>
                            </div>
                            @cannot('isCliente')
                            <div class="col-12 mb-5">
                                <h6><b>Subir evidencia del trabajo realizado</b></h6>
                                <form class="dropzone" id="dropzone-mulitple" action="{{ url('photos/store/'.$task->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate>
                                    @csrf
                                    <div class="fallback">
                                        <input name="file" type="file" />
                                    </div>
                                </form>

                                <div id="previews"></div>
                                <div id="preview-template"></div>

                                <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/libs/dropzone/dist/dropzone.css" rel="stylesheet" />
                                <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/libs/dropzone/dist/dropzone-min.js"></script>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        var maxFilesizeVal = 100;
                                        var maxFilesVal = 10;
                                        new Dropzone("#dropzone-mulitple", {
                                            paramName:"file",
                                            maxFilesize: maxFilesizeVal, // MB
                                            maxFiles: maxFilesVal,
                                            resizeQuality: 1.0,
                                            acceptedFiles: ".jpeg,.jpg,.png,.webp",
                                            addRemoveLinks: false,
                                            timeout: 60000,
                                            //previewsContainer: "#previews",
                                            // previewTemplate: document.querySelector('#preview-template').innerHTML,
                                            dictDefaultMessage: "Arrastra los archivos aqui para subirlos o haga click para seleccionarlos.",
                                            dictFallbackMessage: "Su navegador no admite la carga de archivos mediante arrastrar y soltar.",
                                            dictFileTooBig: "El archivo es demasiado grande. Tamaño máximo de archivo: "+maxFilesizeVal+"MB.",
                                            dictInvalidFileType: "Tipo de archivo no válido. Solo se permiten archivos JPG, JPEG, PNG y GIF.",
                                            dictMaxFilesExceeded: "Solo puedes subir hasta "+maxFilesVal+" archivos.",
                                            maxfilesexceeded: function(file) {
                                                this.removeFile(file);
                                                // this.removeAllFiles(); 
                                            },
                                            sending: function (file, xhr, formData) {
                                                $('#message').text('Image Uploading...');
                                            },
                                            success: function (file, response) {
                                                $('#message').text(response.success);
                                                console.log(response);
                                            },
                                            error: function (file, response) {
                                                $('#message').text('Something Went Wrong! '+response);
                                                console.log(response);
                                                return false;
                                            }
                                        });
                                    })
                                </script>
                            </div>
                            @endcannot
                        <div class="col-12">
                            <h6><b>Evidencia del trabajo realizado</b></h6>
                            <div class="row">
                            @foreach($task->photos as $file)
                                <div class="col-4 mb-3">
                                    <a href="{{ asset($file->photo_path) }}" data-id="{{ $file->id }}" target="_blank">
                                        <img src="{{ asset($file->photo_path) }}" alt="" width="100%">
                                    </a>
                                    @cannot('isCliente')
                                    <button class="btn btn-danger photo-delete" onclick="deletePhoto({{ $file->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endcannot
                                </div>
                            @endforeach
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-12 mb-3 text-right">
                <a href="{{ url()->previous() }}" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Volver</a>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</section>

@endsection