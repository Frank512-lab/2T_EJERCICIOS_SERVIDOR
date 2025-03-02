<?php
session_start();
include('db.php');
include('UserModel.php');

// Verificar si el ID del usuario es pasado por URL
if (isset($_GET['id'])) {
    $usuarioId = $_GET['id'];

    // Crear una instancia de UserModel
    $userModel = new UserModel($conn);

    // SQL para eliminar el usuario
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuarioId);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = 'Usuario eliminado correctamente.';
    } else {
        $_SESSION['error'] = 'Hubo un problema al eliminar el usuario.';
    }

    // Redirigir al panel de administración
    header('Location: panel.php');
    exit;
} else {
    // Si no se pasa el ID, redirigir a panel.php
    header('Location: panel.php');
    exit;
}
