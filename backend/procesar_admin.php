<?php
session_start();
require_once 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Buscamos al administrador por su email
    $sql = "SELECT * FROM administradores 
            WHERE email = :email AND activo = 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':email' => $email
    ]);

    $administrador = $stmt->fetch(PDO::FETCH_ASSOC);

    // Comprobamos que exista y que la contraseña sea correcta
    if ($administrador && password_verify($password, $administrador['password_hash'])) {

        // Guardamos los datos necesarios en la sesión
        $_SESSION['administrador_id'] = $administrador['id_administrador'];
        $_SESSION['administrador_nombre'] = $administrador['nombre'];
        $_SESSION['tipo_usuario'] = 'administrador';

        // Volvemos a la página principal
        header("Location: ../frontend/html/administrador.html");
        exit;

    } else {
        // Si los datos son incorrectos
        header("Location: login_admin.php?error=1");
        exit;
    }
}