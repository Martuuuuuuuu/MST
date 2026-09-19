<?php
session_start();
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';

    $sql = "SELECT * FROM usuarios WHERE email = :email AND activo = 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':email' => $email
    ]);

    $usuario = $stmt->fetch();

    if ($usuario && password_verify($pass, $usuario['contraseña_hash'])) {

        session_regenerate_id(true);

        $_SESSION['usuario_id'] = $usuario['id_usuario'];
        $_SESSION['username'] = $usuario['nombre'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['apellido'] = $usuario['apellido'];
        $_SESSION['email'] = $usuario['email'];

        header("Location: ../frontend/html/inicio.html");
        exit;
    }

    header("Location: ../frontend/html/formulario.html?error=" . urlencode('Email o contraseña incorrectos.'));
    exit;
}

header("Location: ../frontend/html/formulario.html");
exit;