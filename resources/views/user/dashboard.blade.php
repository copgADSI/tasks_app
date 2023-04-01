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
                        @if (auth()->user()->role->type === 'admin')
                            <canvas id="chart_users_container"></canvas>
                        @endif
                        {{-- END CHART --}}
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Obtener el contexto del canvas
            var ctx = document.getElementById('chart_users_container').getContext('2d');
            const chart_users = {!! json_encode($chart_users) !!}
            // Crear el gráfico de barras
            var miGrafico = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(chart_users),
                    datasets: [{
                        label: 'Registro de usuarios',
                        data: Object.values(chart_users),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

        </script>

        <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
            integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
        </script>
    </div>
@endsection
