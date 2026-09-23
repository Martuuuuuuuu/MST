<?php
// Permite consultar y actualizar los datos del usuario que inició sesión.
session_start();
require_once 'conexion.php';
header('Content-Type: application/json; charset=utf-8');

// Responde en JSON y termina el script para evitar salida HTML inesperada.
function responder_perfil(array $datos, int $codigo = 200): void
{
    http_response_code($codigo);
    echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    exit;
}

// Solo los usuarios comunes pueden editar un perfil desde este formulario.
if (($_SESSION['tipo'] ?? '') !== 'usuario' || empty($_SESSION['id_usuario'])) {
    responder_perfil(['ok' => false, 'mensaje' => 'Necesitás iniciar sesión para editar tu perfil.'], 401);
}

$idUsuario = (int) $_SESSION['id_usuario'];

// Una petición GET devuelve los datos actuales para rellenar el formulario.
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->prepare(
        'SELECT id_usuario, nombre, apellido, dni, telefono, email
        FROM usuarios
        WHERE id_usuario = :id AND activo = 1'
    );
    $stmt->execute([':id' => $idUsuario]);
    $usuario = $stmt->fetch();

    if (!$usuario) {
        responder_perfil(['ok' => false, 'mensaje' => 'No se encontró el perfil.'], 404);
    }

    responder_perfil(['ok' => true, 'usuario' => $usuario]);
}

// Rechazamos cualquier método que no sea POST para proteger la actualización.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    responder_perfil(['ok' => false, 'mensaje' => 'Método no permitido.'], 405);
}

// Leemos y limpiamos los campos enviados por el formulario de configuración.
$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$dni = trim($_POST['dni'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validamos los campos obligatorios antes de escribir en la base de datos.
if ($nombre === '' || $apellido === '' || $dni === '' || $telefono === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    responder_perfil(['ok' => false, 'mensaje' => 'Completá todos los datos con valores válidos.'], 422);
}

try {
    // Actualizamos la información básica del perfil.
    $stmt = $pdo->prepare(
        'UPDATE usuarios
        SET nombre = :nombre, apellido = :apellido, dni = :dni,
            telefono = :telefono, email = :email
        WHERE id_usuario = :id'
    );
    $stmt->execute([
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':dni' => $dni,
        ':telefono' => $telefono,
        ':email' => $email,
        ':id' => $idUsuario
    ]);

    // Solo reemplazamos la contraseña si la persona escribió una nueva.
    if ($password !== '') {
        if (strlen($password) < 6) {
            responder_perfil(['ok' => false, 'mensaje' => 'La nueva contraseña debe tener al menos 6 caracteres.'], 422);
        }

        $stmt = $pdo->prepare('UPDATE usuarios SET password_hash = :password WHERE id_usuario = :id');
        $stmt->execute([
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':id' => $idUsuario
        ]);
    }

    // Actualizamos la sesión para que el menú muestre el nombre nuevo inmediatamente.
    $_SESSION['nombre'] = $nombre;
    $_SESSION['apellido'] = $apellido;
    $_SESSION['email'] = $email;

    responder_perfil([
        'ok' => true,
        'mensaje' => 'Tu perfil fue actualizado correctamente.'
    ]);
} 

catch (PDOException $error) {
    // El DNI y el email son únicos; mostramos un mensaje entendible si se repiten.
    if ((int) $error->errorInfo[1] === 1062) {
        responder_perfil(['ok' => false, 'mensaje' => 'El DNI o el email ya están registrados.'], 409);
    }

    responder_perfil(['ok' => false, 'mensaje' => 'No se pudo actualizar el perfil.'], 500);
}
