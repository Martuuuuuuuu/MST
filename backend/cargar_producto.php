<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

require_once 'conexion.php';

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $imagen = trim($_POST['imagen']);
    $descripcion = trim($_POST['descripcion']);
    $precio = floatval($_POST['precio']);
    
    if($nombre && $imagen && $descripcion && $precio > 0) {
        $sql = "INSERT INTO productos (nombre, imagen, descripcion, precio) VALUES (:nombre, :imagen, :descripcion, :precio)";
        $stmt = $pdo->prepare($sql);
        try {
            $stmt->execute([
                ':nombre' => $nombre,
                ':imagen' => $imagen,
                ':descripcion' => $descripcion,
                ':precio' => $precio
            ]);
            $mensaje = "¡Producto cargado con éxito!";
        } catch (PDOException $e) {
            $mensaje = "Error al cargar: " . $e->getMessage();
        }
    } else {
        $mensaje = "Por favor, completa todos los campos correctamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Producto - Cooperadora</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Pahawh+Hmong&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../frontendnew/styles/tienda.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            background: #FFFFFF;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(14, 20, 28, 0.14);
            font-family: 'Nunito', Arial, sans-serif;
        }
        .form-container label {
            display: block;
            margin-top: 15px;
            font-weight: 700;
            color: #191d64;
        }
        .form-container input, .form-container textarea {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #D7DCE4;
            border-radius: 8px;
            font-size: 16px;
            font-family: 'Nunito', Arial, sans-serif;
        }
        .form-container button {
            margin-top: 25px;
            width: 100%;
            padding: 14px;
            background-color: #191d64;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .form-container button:hover {
            background-color: #12154a;
        }
        .mensaje {
            text-align: center;
            font-weight: bold;
            color: #27ae60;
            margin-bottom: 20px;
            background: #eafaf1;
            padding: 10px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<nav>
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="https://eest.tecnica1vl.org/">Pagina principal</a></li>
        <li><a href="listado.php">Productos</a></li>
        <li><a href="cargar_producto.php">Cargar Producto</a></li>
        <li><a href="logout.php">Cerrar Sesión (<?= htmlspecialchars($_SESSION['username']) ?>)</a></li>
    </ul>
</nav>

<main>
    <br>
    <div>
        <h1>Cargar Nuevo Producto</h1>
        <p class="descripcion">Agrega un nuevo artículo al catálogo de la cooperadora completando los siguientes datos.</p>
    </div>

    <div class="form-container">
        <?php if($mensaje): ?>
            <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
        <?php endif; ?>

        <form action="cargar_producto.php" method="POST">
            <label for="nombre">Nombre del producto:</label>
            <input type="text" id="nombre" name="nombre" required placeholder="Ej. Remera EEST1">

            <label for="imagen">Ruta de la Imagen:</label>
            <input type="text" id="imagen" name="imagen" required placeholder="Ej. ../frontend/img/Prendas.png">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" required placeholder="Descripción breve..."></textarea>

            <label for="precio">Precio ($):</label>
            <input type="number" step="0.01" id="precio" name="precio" required placeholder="Ej. 15000">

            <button type="submit">Guardar Producto</button>
        </form>
    </div>
</main>

    <footer class="site-footer">
        <div class="footer-content">
            <div class="footer-brand">
                <a class="footer-logo" href="#inicio">Cooperadora <small>Escolar</small></a>
                <span>Trabajamos para acompañar y fortalecer a nuestra comunidad educativa.</span>
                <a class="footer-action" href="tienda.html">Conocé nuestros productos <span aria-hidden="true">→</span></a>
            </div>
            <div class="footer-column">
                <h2><span class="footer-heading-icon icon-clock" aria-hidden="true"></span> Atención</h2>
                <p>Lunes a viernes<br><strong>12:00 a 17:00 hs</strong></p>
            </div>
            <div class="footer-column">
                <h2><span class="fa fa-user-circle-o" aria-hidden="true"></span> Contacto</h2>
                <div class="footer-socials">
                    <a href="https://www.instagram.com/cooperadoraetuno/" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><img src="../img/logos/Instagram.png" alt=""><span>@cooperadoraetuno</span></a>
                    <a href="https://www.facebook.com/cooperadoraetuno" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><img src="../img/logos/facebook.png" alt=""><span>@Asoc.Cooperadora Tecnica 1. VL</span></a>
                    <a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox?compose=CllgCJNvwPHwtNwfVxHcxbZHlqFLBWMBVCcSrnmMbrhGnzsMdmbMWwWgLNNGBmxVJHKDWVHbWGq" target="_blank" rel="noopener noreferrer" aria-label="Telegram"><img src="../img/logos/Gmail.png" alt=""><span>cooperadoraet1@gmail.com</span></a>
                    <a href="https://t.me/s/eest1?before=265" target="_blank" rel="noopener noreferrer" aria-label="Telegram"><img src="../img/logos/telegram.png" alt=""><span>EESTN°1</span></a>
                </div>
            </div>
            <div class="footer-column footer-links">
                <h2><span class="footer-heading-icon icon-explore" aria-hidden="true"></span> Explorar</h2>
                <a href="inicio.html">Inicio</a>
                <a href="#equipo">Equipo</a>
                <a href="https://eest.tecnica1vl.org/" target="_blank" rel="noopener noreferrer">Pagina principal</a>
                <a href="tienda.html">Productos</a>
                <a href="#opiniones">Opiniones</a>
                <a href="formulario.html">Iniciar sesión</a>
                <a href="registro.html">Registrarse</a>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© 2026 Cooperadora EEST N°1. Todos los derechos reservados.</span>
            <span>Proyecto MST · Sitio web institucional</span>
        </div>
    </footer>
</body>
</html>