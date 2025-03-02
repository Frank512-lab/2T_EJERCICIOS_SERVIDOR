<!-- functions.php -->
<?php
/*Función tipo regex para validar el formato de un correo electrónico común pero que en PHP se llama filter_val. Le pasamos la variable $email y luego filtramos con la filter_validate_email (filtro predefinido de php)*/
function validar_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
