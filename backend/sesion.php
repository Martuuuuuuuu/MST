<?php
// Inicia la sesión existente para poder consultar al usuario actual.
session_start();
header('Content-Type: application/json; charset=utf-8');

// Devuelve una respuesta JSON consistente para que el frontend pueda procesarla.
function responder(array $datos, int $codigo = 200): void
{
    http_response_code($codigo);
    echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    exit;
}

// Si no hay una sesión activa, informamos al frontend que la persona no inició sesión.
if (empty($_SESSION['tipo']) || empty($_SESSION['nombre'])) {
    responder(['autenticado' => false]);
}

// La sesión de administrador no tiene los mismos datos editables que un usuario común.
if ($_SESSION['tipo'] === 'administrador') {
    responder([
        'autenticado' => true,
        'tipo' => 'administrador',
        'nombre' => $_SESSION['nombre'],
        'email' => $_SESSION['email'] ?? ''
    ]);
}

// Entregamos únicamente los datos públicos y editables del usuario autenticado.
require_once 'conexion.php';
$stmt = $pdo->prepare(
    'SELECT id_usuario, nombre, apellido, dni, telefono, email
     FROM usuarios
     WHERE id_usuario = :id AND activo = 1'
);
$stmt->execute([':id' => $_SESSION['id_usuario'] ?? 0]);
$usuario = $stmt->fetch();

// Si el usuario fue desactivado o la sesión quedó inválida, se considera cerrada.
if (!$usuario) {
    session_unset();
    session_destroy();
    responder(['autenticado' => false]);
}

responder([
    'autenticado' => true,
    'tipo' => 'usuario',
    'usuario' => $usuario
]);
