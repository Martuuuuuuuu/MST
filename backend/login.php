<?php
session_start();
require_once 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        header("Location: ../frontend/html/formulario.html?error=Completá todos los campos.");
        exit;
    }

    /* PRIMERO BUSCAMOS EN LA TABLA USUARIOS*/
    $sql = "SELECT * FROM usuarios WHERE email = :email AND activo = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);

    $usuario = $stmt->fetch();

    if ($usuario && password_verify($password, $usuario['password_hash'])) {

        $_SESSION['tipo'] = 'usuario';
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['email'] = $usuario['email'];

        // Todos vuelven a la página principal
        header("Location: ../frontend/html/inicio.html");
        exit;
    }

    /* SI NO ES USUARIO, BUSCAMOS EN ADMINISTRADORES*/
    $sql = "SELECT * FROM administradores WHERE email = :email AND activo = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);

    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password_hash'])) {

        $_SESSION['tipo'] = 'administrador';
        $_SESSION['id_administrador'] = $admin['id_administrador'];
        $_SESSION['nombre'] = $admin['nombre'];
        $_SESSION['email'] = $admin['email'];

        // IMPORTANTE:
        // El administrador NO va directamente al panel.
        // También vuelve a la página principal.
        header("Location: ../frontend/html/inicio.html");
        exit;
    }
    /* SI NO COINCIDE CON NINGUNA TABLA*/
    header("Location: ../frontend/html/formulario.html?error=Email o contraseña incorrectos.");
    exit;
}
header("Location: ../frontend/html/formulario.html");
exit;
?>