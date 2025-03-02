<?php
session_start();
include('functions.php');
include('db.php');
include('UserModel.php');

// Crear el objeto del modelo
$userModel = new UserModel($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar si el email ya está registrado
    $result = $userModel->registrarUsuario($email, $password);

    if ($result) {
        $_SESSION['mensaje'] = 'Registro correcto. Ahora puedes iniciar sesión.';
        header('Location: login.php');
        exit;
    } else {
        $_SESSION['error'] = 'Hubo un problema al registrar la cuenta.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Cargar Bootstrap desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Crear Cuenta</h2>

        <!-- Mensaje de error -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Formulario para el registro -->
        <form action="registro.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>

        <!-- Enlace a la página de login -->
        <div class="mt-3">
            
            <p>¿Ya estabas registrado? <a href="login.php">Volver a Iniciar sesión</a></p>
        </div>
    </div>

    <!-- Cargar JavaScript de Bootstrap desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0+5a1LVhWqa6WnGKKL7B5L4fpmN6pZB4+kjFkszjM+dxqY4i" crossorigin="anonymous"></script>

</body>

</html>