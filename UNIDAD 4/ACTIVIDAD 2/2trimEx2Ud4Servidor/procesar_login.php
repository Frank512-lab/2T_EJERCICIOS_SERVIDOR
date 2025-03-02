<!-- procesar_login.php -->
<?php
session_start();
include('functions.php'); //redirigimos a un archivo con una función para verificar el correo

// Aquí vamos a establecer un usuario ficticio para que se pueda loguear. 
//Establecemos un array con dos parámetros (correo y contraseña)
$usuario = [
    'email' => 'franciscosignes1978@gmail.com',
    'password' => '123'
];


/*Pasamos a validar el formulario. Con isset recogemos los datos introducidos en 
los campos del formulario y los guardamos en $email y $password (variables) 
para luego comprobarlas con el array que tenemos*/

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    /*En este segundo condicional anidado comprobamos que coincida lo 
    introducido el campo del formulario por el usuario con lo que 
    tenemos almacenado en las variables. Ponemos && para que ambas condiciones se cumplan*/

    if ($email === $usuario['email'] && $password === $usuario['password']) {

        // Almacenamos la sesión

        $_SESSION['usuario'] = $email;

        // Escribimos una cookie de sesión

        setcookie('galletilla', 'principal', time() + (300), '/'); // 5 minutillos

        // Damos acceso al panel, que es supuestamente la página de bienvenida o de acceso a la aplicación

        header('Location: panel.php');
        exit;

    } else {

        // Si no coincide lo que el usuario teclea con lo que tenemos almacenado en las variables, nos salta este error
        $_SESSION['error'] = 'Usuario o contraseña incorrectos';
        header('Location: login.php');
        exit;
        } 

}
