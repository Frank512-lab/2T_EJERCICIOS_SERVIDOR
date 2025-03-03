<?php
session_start();
include('db.php');
include('UserModel.php');

$userModel = new UserModel($conn);

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

// Obtener lista de usuarios
$sql = "SELECT id, email FROM usuarios";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="style.css">


    <!-- Añadimos bootstrap -->


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body class="d-flex flex-column">
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

    <section class="container mt-5 pt-5">
        <h2 class="text-center">Gestión de usuarios</h2>


        <!-- Mostrar mensaje de éxito o error -->
        <?php if (isset($_SESSION['mensaje'])): ?>
            <p class="success-message"><?php echo $_SESSION['mensaje']; ?></p>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="error-message"><?php echo $_SESSION['error']; ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <h3>Usuarios Registrados</h3>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Correo Electrónico</th>
                    <th class="d-flex justify-content-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($usuario = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                        <td class="d-flex justify-content-end">
                            <div class="">
                                <!-- Botón para modificar contraseña -->
                                <form action="modificar_contraseña.php" method="get" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                                    <button type="submit" class="btn btn-primary">Modificar Contraseña</button>
                                </form>
                            </div>

                            <div>
                                <!-- Botón para eliminar usuario -->
                                <button onclick="confirmarEliminar(<?php echo $usuario['id']; ?>)" class="btn btn-danger">Eliminar Usuario</button>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>

    <script>
        // Confirmación antes de eliminar un usuario
        function confirmarEliminar(usuarioId) {
            if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
                window.location.href = 'eliminar_usuario.php?id=' + usuarioId;
            }
        }
    </script>

</body>


</html>