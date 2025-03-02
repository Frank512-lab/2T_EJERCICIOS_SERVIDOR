<!-- panel.php -->
<?php
//iniciamos la sesión para poder acceder a la información del usuario. Necesario en cada archivo

session_start();

/*Aquí verificamos si la variable de sesión del usuario está establecida. Si no hemos iniciado sesión entramos en el if
por lo que nos redirige a login. No entraríamos a panel.php (página principal, digamos)*/

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Entramos en la página principal</title>
</head>
<body>
    <h2>Bienvenidos a lo que sea...</h2>
    <p>Se iniciado sesión correctamente</p>

    <!-- Redireccionamos a logout.php -->
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
