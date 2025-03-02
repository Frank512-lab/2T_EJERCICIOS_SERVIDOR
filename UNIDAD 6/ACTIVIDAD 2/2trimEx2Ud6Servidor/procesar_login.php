<?php
session_start();
include('functions.php');
include('db.php');
include('UserModel.php');  // Incluir el modelo de usuario

// Crear el objeto del modelo
$userModel = new UserModel($conn);

// Verificar si el formulario de login ha sido enviado
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar el usuario en la base de datos
    $usuario = $userModel->verificarUsuario($email, $password);

    if ($usuario) {
        $_SESSION['usuario'] = $usuario['email'];
        $_SESSION['usuario_id'] = $usuario['id'];
        setcookie('galletilla', 'principal', time() + 300, '/'); // 5 minutos
        header('Location: panel.php');
        exit;
    } else {
        $_SESSION['error'] = 'Usuario o contraseña incorrectos';
        header('Location: login.php');
        exit;
    }
}
?>
