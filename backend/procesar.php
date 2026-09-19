<?php
// Procesa el alta de una cuenta nueva (formulario registro.html).
session_start();
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre    = trim($_POST['nombre'] ?? '');
    $apellido  = trim($_POST['apellido'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $dni       = trim($_POST['dni'] ?? '');
    $telefono  = trim($_POST['telefono'] ?? '');
    $password  = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    $errores = [];

    if ($nombre === '' || $apellido === '' || $email === '' || $dni === '' || $telefono === '') {
        $errores[] = 'Completá todos los campos.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El email ingresado no es válido.';
    }
    if (strlen($password) < 6) {
        $errores[] = 'La contraseña debe tener al menos 6 caracteres.';
    }
    if ($password !== $password2) {
        $errores[] = 'Las contraseñas no coinciden.';
    }

    if (empty($errores)) {
try {
    $sql = "INSERT INTO usuarios 
    (nombre, apellido, dni, telefono, email, contraseña_hash)
    VALUES (:nombre, :apellido, :dni, :telefono, :email, :pass)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':dni' => $dni,
        ':telefono' => $telefono,
        ':email' => $email,
        ':pass' => password_hash($password, PASSWORD_DEFAULT)
    ]);

    session_regenerate_id(true);

    $_SESSION['usuario_id'] = $pdo->lastInsertId();
    $_SESSION['username'] = $nombre;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['apellido'] = $apellido;
    $_SESSION['email'] = $email;

    header("Location: ../frontend/html/inicio.html?bienvenida=1");
    exit;

} catch (PDOException $e) {
    die("ERROR DE MYSQL: " . $e->getMessage());
}
    }

    $msg = implode(' ', $errores);
    header("Location: ../frontend/html/registro.html?error=" . urlencode($msg));
    exit;
}