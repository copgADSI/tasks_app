@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <form action="{{ route('dashboard.generete-pdf') }} " method="GET" class="form-control"
                            id="downloaded_pdf_form">
                            <div class="d-flex form-container">
                                {{-- <select name="type" id="type" class="form-control">
                                    <option value="">Seleccionar un tipo de registro</option>
                                    <option value="">Usuarios</option>
                                    <option value="">Archivos subidos</option>
                                </select> --}}
                                <input required type="date" name="start_date" class="form-control"
                                    value="{{ $current_date }}">
                                <input required type="date" name="end_date" class="form-control"
                                    value="{{ $current_date }}">
                                <button type="submit" class="btn btn-danger mx-1"><i class="fas fa-file-pdf"></i></button>
                            </div>
                        </form>
                        <div class="row">
                            @if (auth()->user()->role->type === 'admin')
                                <div class="col md-4 card m-2 text-center bg-success text-white">
                                    <div class="m-auto">
                                        <main>
                                            <span>Usuarios registrados </span>
                                        </main>
                                        <i class="fas fa-user"></i>
                                        <legend>{{ $analytics['total_users'] }}</legend>
                                    </div>
                                </div>
                            @endif
                            <div class="col md-4 card m-2 text-center bg-primary text-white">
                                <div class="m-auto">
                                    <main>
                                        <span>Archivos subidos</span>
                                    </main>
                                    <i class="fas fa-file"></i>
                                    <legend>{{ $analytics['uploaded_files'] }}</legend>
                                </div>
                            </div>
                            <div class="col md-4 card m-2 text-center bg-success text-white">
                                <div class="m-auto">
                                    <main>
                                        <span>Tareas completadas</span>
                                    </main>
                                    <i class="fas fa-check"></i>
                                    <legend>{{ $analytics['completed_tasks'] }}</legend>
                                </div>
                            </div>

                            <div class="col md-4 card m-2 text-center bg-warning text-white">
                                <div class="m-auto">
                                    <main>
                                        <span>Tareas pendientes</span>
                                    </main>
                                    <i class="fas fa-moon"></i>
                                    <legend>{{ $analytics['pendenting_tasks'] }}</legend>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Estadísticas') }}</div>
                    <div class="card-body">
                        {{-- CHARTS --}}
                            

                        {{-- END CHART --}}
                    </div>
                </div>
            </div>
        </div>
        <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
            integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
        </script>
    </div>
@endsection
