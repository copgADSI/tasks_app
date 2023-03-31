<!DOCTYPE html>
<html>

<head>
    <title>Bienvenido al gestor de tareas</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            margin-top: 40px;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 40px;
        }

        .text {
            font-size: 24px;
            margin: 40px 0;
            text-align: center;
            color: #333;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
        }

        .primary {
            background-color: #007bff;
            color: #fff;
        }

        .secondary {
            background-color: #6c757d;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bienvenido al gestor de tareas</h1>
        <img src="{{ asset('/images/tasks-list.png') }}" alt="Ilustración de una persona con una lista de tareas"
            style="max-width: 10rem">
        <p class="text">Estamos encantados de tenerte aquí. Continúa con tu trabajo y no dudes en ponerte en contacto
            si necesitas ayuda o tienes alguna pregunta.</p>
        <a href=" {{ route('login') }} " class="btn primary">Inicia sesión</a>
        <a href=" {{ route('register') }} " class="btn secondary ">Regístrate</a>
    </div>
</body>

</html>
