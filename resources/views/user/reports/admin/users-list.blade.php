<style>
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
        Total usuarios: <b>{{ $users->count() }}</b>
    </span>

    <ul>

        @if ($users->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Fecha creación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->email }} </td>
                            <td> {{ $user->created_at }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="background:  red; color: white ">No se encontraron usuarios registrados en las fechas seleccionadas...</div>
        @endif
        <!-- Agrega otros campos del modelo User que desees mostrar en el PDF -->
    </ul>
</body>

</html>
