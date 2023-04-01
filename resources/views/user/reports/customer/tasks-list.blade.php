<style>
    .completed {
        background: green;
        color: white
    }

    .uncompleted {
        background: rgb(193, 21, 21);
        color: white
    }

    table {
        border-collapse: collapse;
        width: 100%;
        max-width: 100%;
        font-size: 1rem;
        font-weight: 400;
        color: #333;
        background-color: transparent;
    }

    th,
    td {
        text-align: center;
        padding: 1rem;
        border-bottom: 1px solid #ddd;
    }

    th {
        text-align: left;
        padding: 1rem;
        border-bottom: 2px solid #ddd;
    }

    td {
        padding: 1rem;
        border-bottom: 1px solid #ddd;
    }

    tr:nth-child(even) {
        background-color: #f5f5f5;
    }

    @media (max-width: 576px) {
        table {
            font-size: 0.875rem;
        }

        th,
        td {
            padding: 0.75rem;
        }
    }
</style>

<html>

<head>
    <meta charset="utf-8">
    <title>Detalles del usuario</title>
</head>

<body>
    <h1>Registro y control </h1>
    <h3>Fecha <b>{{ $start_date }} </b> - <b> {{ $end_date }} </b> </h3>
    <span>
        Total de tareas: <b>{{ $tasks->count() }}</b>
    </span>

    <ul>

        <table>
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Fecha creación</th>
                </tr>
            </thead>
            <tbody>
                @if (count($tasks) > 0)
                    @foreach ($tasks as $task)
                        <tr>
                            <td> {{ $task->description }} </td>
                            @php
                                $class = $task->state->type === 'completado' ? 'completed' : 'uncompleted';
                            @endphp
                            <td class="{{ $class }}">
                                {{ $task->state->type }}
                            </td>
                            <td> {{ $user->created_at }} </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>No se encontraron tareas...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </ul>
</body>

</html>
