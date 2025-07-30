<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bienvenido a Mi Proyecto</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f0f2f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .welcome-container {
            background: white;
            padding: 3rem 4rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
            text-align: center;
            max-width: 480px;
        }
        .welcome-container h1 {
            font-weight: 700;
            margin-bottom: 1rem;
            color: #0d6efd;
        }
        .welcome-container p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            color: #555;
        }
        .btn-primary, .btn-outline-primary {
            padding: 0.6rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

    <div class="welcome-container">
        <h1>¡Bienvenido a Mi Proyecto!</h1>
        <p>Tu plataforma Laravel para gestionar usuarios y publicaciones.</p>

        @auth
            <a href="{{ route('usuarios.index') }}" class="btn btn-primary">Ver Usuarios</a>
            <a href="{{ route('publicaciones.index') }}" class="btn btn-outline-primary ms-2">Ver Publicaciones</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary ms-2">Registrarse</a>
        @endauth
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
