<?php
// UserModel.php

//definimos una clase UserModel para manejar la interacción con la base de datos
class UserModel {

    //Almacenamos la conexión en $conn
    private $conn;

    //establecemos un constructor que recibe como parámetro $db (que representa la conexión) y lo aisgnamos a $this->conn
    public function __construct($db) {
        $this->conn = $db;
    }

    // Con esta función registramos un usuario en la base de datos
    public function registrarUsuario($email, $password) {

        // he investigado esto un poco porque en los apuntes no se recomienda guardar contraseñas en texto plano

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // SQL para insertar el nuevo usuario
        //con las ? evitamos inyecciones de sql
        $sql = "INSERT INTO usuarios (email, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        //las ss indican que son dos strings
        $stmt->bind_param("ss", $email, $hashedPassword);

        //ejecutamos la consulta: true si tenemos éxito, false si no

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Necesitamos verificar de alguna manera a un usuario.
    //Se recibe el email y la password ingresados por el usuario y ejecutamos la consulta
    public function verificarUsuario($email, $password) {

        //seleccionamos toda la información del usuario cuyo email coincida con el ingresado
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        //este resultado es la fila con los datos que coincida con el email ingresado. Lo almacenamos en $result
        $result = $stmt->get_result();

        /* Si obtenemos más de un resultado, o sea una fila, significa que el usuario existe y contrastamos con la password almacenada. True si coincide, false si no*/

        if ($result->num_rows > 0) {

            //instertamos en un array los datos del usuario
            $usuario = $result->fetch_assoc();
            // Verificar la contraseña
            if (password_verify($password, $usuario['password'])) {
                return $usuario;
            }
        }
        return false;
    }

    // En UserModel.php

    public function actualizarContraseña($id, $nueva_contraseña)
    {
        $hashedPassword = password_hash($nueva_contraseña, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $hashedPassword, $id);

        return $stmt->execute();
    }


}
