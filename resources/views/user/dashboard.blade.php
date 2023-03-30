@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <form action="" class="form-control" id="downloaded_pdf_form">
                            <div class="d-flex form-container">
                                <input required type="date" class="form-control" value="{{ $current_date }}">
                                <input required type="date" class="form-control" value="{{ $current_date }}">
                                <button type="submit" class="btn btn-danger mx-1"><i class="fas fa-file-pdf"></i></button>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col md-4 card m-2 text-center bg-success text-white">
                                <div class="m-auto">
                                    <main>
                                        <span>Usuarios registrados </span>
                                    </main>
                                    <i class="fas fa-user"></i>
                                    <legend>{{ $analytics['total_users'] }}</legend>
                                </div>
                            </div>
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
        <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
            integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
        </script>
    </div>
    <script>
        const downloaded_pdf_form = document.getElementById("downloaded_pdf_form");
        downloaded_pdf_form.addEventListener('submit', (event) => {
            event.preventDefault();
            const URL = ''

            const pdf_path = './reporte.pdf';

            // Configuración de Axios para la descarga del archivo
            const axios_config = {
                responseType: 'stream'
            };

            // Descarga del archivo con Axios y guardado en disco
            axios.get(URL, axios_config)
                .then(response => {
                    response.data.pipe(fs.createWriteStream(pdf_path));
                })
                .catch(error => {
                    console.log(error);
                });
        })
    </script>
@endsection
