@extends('layouts.app')

@section('content')

    <head>
        <!-- ... -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <!-- ... -->
    </head>
    <div>
        <form  action="{{ route('task.update', ['id' => $task->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <textarea class="form-control" name="description" required>{{$task->description}}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('task.list') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
    
@endsection
