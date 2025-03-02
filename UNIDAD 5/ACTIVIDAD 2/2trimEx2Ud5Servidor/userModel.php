<?php
// UserModel.php
class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar un nuevo usuario
    public function registrarUsuario($email, $password) {
        // Hashear la contraseña antes de almacenarla
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // SQL para insertar el nuevo usuario
        $sql = "INSERT INTO usuarios (email, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $email, $hashedPassword);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para verificar si el usuario existe
    public function verificarUsuario($email, $password) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            // Verificar la contraseña
            if (password_verify($password, $usuario['password'])) {
                return $usuario;
            }
        }
        return false;
    }
}
