@extends('layouts.app')

@section('content')
    <style>
        .dropzone {
            border: 2px dashed #ccc;
            cursor: pointer;
        }

        .file-list {
            display: none;
        }

        .file-list h3 {
            margin-top: 0;
        }

        .file-list ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Listado de archivos') }}</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($files as $file)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <span> {{ $file->file_name }} </span>
                                        <div class="d-flex form-group">
                                            <a href="{{ asset('storage/' . $file->path) }}" class="btn btn-primary">--</a>
                                            <a href="" class="btn btn-danger">--</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Arrastra y suelta archivos aquí') }}</div>


                    <div class="card-body">
                        <form method="post" action="/upload-files" enctype="multipart/form-data">
                            @csrf
                            <div class="dropzone text-center py-5">
                                <h4>Haz clic o arrastra y suelta tus archivos aquí</h4>
                                <input type="file" id="file-input" multiple style="display: none;">
                            </div>
                        </form>
                        <div class="file-list mt-3">
                            <h3>Archivos cargados:</h3>
                            <ul class="list-group"></ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const dropzone = document.querySelector('.dropzone');
        const fileList = document.querySelector('.file-list');
        const fileItemList = document.querySelector('.file-list ul');
        const fileInput = document.querySelector('#file-input');

        // Mostrar la lista de archivos cargados
        function showFileList() {
            fileList.style.display = 'block';
        }

        // Agregar un elemento a la lista de archivos cargados
        function addFileItem(file) {
            const fileItem = document.createElement('li');
            fileItem.classList.add('list-group-item');
            fileItem.textContent = file.name;
            fileItemList.appendChild(fileItem);
        }

        // Enviar archivos al servidor mediante fetch
        function uploadFiles(files) {
            const formData = new FormData();
            Array.from(files).forEach(file => {
                formData.append('files[]', file);
            });

            // Agregar el token CSRF al FormData
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            fetch('/upload-files', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        alert('Los archivos se han cargado con éxito.');
                        window.location.reload()
                    } else {
                        alert('Ha ocurrido un error al cargar los archivos.');
                    }
                })
                .catch(error => {
                    console.error('Ha ocurrido un error al cargar los archivos:', error);
                });
        }


        // Manejar el evento de arrastrar y soltar
        dropzone.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropzone.classList.add('bg-light');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('bg-light');
        });

        dropzone.addEventListener('drop', (event) => {
            event.preventDefault();
            dropzone.classList.remove('bg-light');
            showFileList();
            const files = event.dataTransfer.files;
            Array.from(files).forEach(file => {
                addFileItem(file);
            });
            uploadFiles(files);
        });

        // Manejar el evento de hacer clic en la zona de arrastrar y soltar
        dropzone.addEventListener('click', () => {
            fileInput.click();
        });

        // Manejar el evento de seleccionar archivos
        fileInput.addEventListener('change', (event) => {
            showFileList();
            const files = event.target.files;
            Array.from(files).forEach(file => {
                addFileItem(file);
            });
            uploadFiles(files);
        });
    </script>
@endsection
