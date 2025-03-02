<?php
// db.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mi_sistema_login";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
