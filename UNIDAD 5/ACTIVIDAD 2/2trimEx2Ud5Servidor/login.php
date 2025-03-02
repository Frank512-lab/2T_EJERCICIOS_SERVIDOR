<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<div class="container">
    <h2>Iniciar Sesión</h2>

    <!-- Mensaje de error -->
    <?php if (isset($_SESSION['error'])): ?>
        <p class="error-message"><?php echo $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Formulario para el login -->
    <form action="procesar_login.php" method="POST">
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>

        <button type="submit">Iniciar sesión</button>
    </form>

    <!-- Enlace a la página de registro -->
    <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
</div>

</body>
</html>
