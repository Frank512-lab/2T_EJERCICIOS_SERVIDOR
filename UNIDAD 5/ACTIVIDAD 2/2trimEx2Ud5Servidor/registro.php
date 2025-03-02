<!-- registro.php -->
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
        $_SESSION['mensaje'] = 'Registro exitoso. Ahora puedes iniciar sesión.';
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
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Crear Cuenta</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <p class="error-message"><?php echo $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="registro.php" method="POST">
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>

        <button type="submit">Registrar</button>
    </form>

</div>

</body>
</html>
