<?php
session_start();
include('db.php');
include('UserModel.php');

// Nos aseguramos de que el usuario esté autenticado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Creamos el objeto del modelo de usuario
$userModel = new UserModel($conn);

// Verificamos si el formulario de cambio de contraseña ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['usuario_id']; 
    $nueva_contraseña = $_POST['nueva_contraseña'];

    // Actualizar la contraseña en la base de datos
    $resultado = $userModel->actualizarContraseña($id, $nueva_contraseña);

    if ($resultado) {
        $_SESSION['mensaje'] = 'Contraseña actualizada';
        header('Location: panel.php');
        exit;
    } else {
        $_SESSION['error'] = 'Hubo un problema al actualizar la contraseña.';
    }
}

// Obtenemos la ID del usuario desde la sesión
$userId = $_SESSION['usuario_id']; 

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Modificar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Panel de Administración</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    <a class="nav-link" href="#">Usuarios</a>
                    <a class="nav-link" href="#">Ajustes</a>
                </div>
                <div class="ms-auto">
                    <form action="logout.php" method="POST">
                        <button type="submit" class="btn btn-outline-light">Cerrar sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <section class="container mt-5 pt-5">
        <h2 class="text-center mb-4">Modificar Contraseña</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="modificar_contraseña.php" method="POST" class="bg-white p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="nueva_contraseña" class="form-label">Nueva Contraseña:</label>
                <input type="password" name="nueva_contraseña" class="form-control" id="nueva_contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
        </form>

        <div class="mt-3">
            <a href="panel.php" class="btn btn-link">Volver al Panel</a>
        </div>
    </section>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
