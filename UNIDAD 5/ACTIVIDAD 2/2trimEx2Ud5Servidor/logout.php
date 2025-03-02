<!-- logout.php -->
<?php

//iniciamos sesión para poder tener acceso a cualquier variable de sesión
session_start();
//eliminamos las variables de sesión registradas pero la sesión sigue activa ojo!!
session_unset();
//nos cargamos la sesión y la eliminamos del servidor
session_destroy();

/* Borramos al cookie al finalizar sesión. Ponemos un valor en negativo para indicar que la cookie ya ha expirado. 
De esa forma nos aseguramos que la borre. Se suele poner 1 hora (3600 segundos) pero podríamos poner cualquier valor, asegurándonos
que estemos en el "pasado"*/

setcookie('galletilla', 'principal', time() - 3600, '/'); 

// Volvemos a login 

header('Location: login.php');
exit;
