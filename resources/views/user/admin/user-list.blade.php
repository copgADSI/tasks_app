<html>

<head>
    <meta charset="utf-8">
    <title>Detalles del usuario</title>
</head>

<body>
    <h1>Usuarios registrados</h1>

    <ul>
        @foreach ($users as $user)
            <li>Nombre: {{ $user->name }}</li>
            <li>Email: {{ $user->email }}</li>
        @endforeach
        <!-- Agrega otros campos del modelo User que desees mostrar en el PDF -->
    </ul>
</body>

</html>
