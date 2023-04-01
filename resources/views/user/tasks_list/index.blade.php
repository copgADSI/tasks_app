@extends('layouts.app')
@section('content')

    <head>
        <!-- ... -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <!-- ... -->
    </head>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Busque su tarea..." aria-label="Nombre tarea"
                    aria-describedby="addon-wrapping">
            </div>
        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">
                <i class="fas fa-filter"></i> Filtrar...
            </button>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Filtrado de tareas</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <select class="form-select d-inline-block mx-2" aria-label="Default select example">
                                <option selected>Fecha de inicio</option>
                            </select>
                            <label></label>
                            <select class="form-select d-inline-block mx-2" aria-label="Default select example">
                                <option selected>Fecha de finalización</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">Filtrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            @if (session('success'))
                <div class="alert alert-info">
                    {{ session('success') }}
                </div>
            @endif

            <ul class="list-group">
                @foreach ($tasks as $task)
                    <li class="list-group-item">
                        <div
                            class="d-flex justify-content-around alert {{ $task->state->type === 'completado' ? 'alert-success' : 'alert-warning' }} ">
                            <span class="{{ $task->state->type == 'completado' ? 'text-decoration-line-through' : '' }}">
                                <b>Descripción:</b> {{ $task->description }} </span>
                            <span class="{{ $task->state->type == 'completado' ? 'text-decoration-line-through' : '' }}">
                                <b>Fecha de creación: </b> {{ $task->created_at }} </span>
                            <span> <b>Estados: </b> {{ $task->state->type }} </span>
                            <span>
                                <form action="{{ route('task.destroy', ['id' => $task->id]) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                </form>
                                <form action="{{ route('task.update_state', ['id' => $task->id]) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    @if ($task->state->type === 'completado')
                                        <button class="btn btn-danger"
                                            onclick="return confirm('¿Estás seguro de que quieres devolver el estado de la tarea?')">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    @else
                                        <button class="btn btn-success"
                                            onclick="return confirm('¿Estás seguro de que quieres aprobar esta tarea?')">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    @endif
                                </form>
                                <a href="{{ route('task.edit', ['id' => $task->id]) }}" class="btn btn-warning ">
                                    <i class="fas fa-pencil-alt"></i></a>
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
            <br>
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-plus"></i> Agregar tareas
            </button>


            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregue su tarea</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <form action=" {{ Route('task.store') }} " method="POST">
                                        @csrf
                                        <textarea name="description" id="description" class="form-control" required></textarea>
                                        <br>
                                        <button type="submit" class="btn btn-outline-success"><i
                                                class="fas fa-plus"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
