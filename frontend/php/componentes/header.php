<?php
/**
 * Componente: Header / Barra de Navegación
 * 
 * Variables opcionales configurables antes de incluir este componente:
 * - $current_page: Nombre del archivo actual para marcar la pestaña activa (ej: 'inicio.php', 'login.php')
 * - $ruta_img: Ruta relativa hacia frontend/img/ (por defecto: '../img/')
 * - $ruta_vistas: Ruta relativa hacia frontend/php/ (por defecto: '')
 * - $ruta_html: Ruta relativa hacia frontend/html/ (por defecto: '../html/')
 * - $ruta_backend: Ruta relativa hacia backend/ (por defecto: '../../backend/')
 */

if (session_status() === PHP_SESSION_NONE) {
    if (!headers_sent()) {
        session_start();
    }
}

$is_authenticated = isset($_SESSION['tipo']);
$tipo_rol = $_SESSION['tipo'] ?? null;
$nombre_usuario = $_SESSION['nombre'] ?? '';
$apellido_usuario = $_SESSION['apellido'] ?? '';

$inicial1 = !empty($nombre_usuario) ? strtoupper(substr(trim($nombre_usuario), 0, 1)) : '';
$inicial2 = !empty($apellido_usuario) ? strtoupper(substr(trim($apellido_usuario), 0, 1)) : '';
$iniciales = ($inicial1 || $inicial2) ? $inicial1 . $inicial2 : 'U';

// Página actual por defecto si no fue provista
$current_page = $current_page ?? basename($_SERVER['PHP_SELF']);

// Rutas relativas por defecto para vistas ubicadas en frontend/php/
$ruta_img = $ruta_img ?? '../img/';
$ruta_vistas = $ruta_vistas ?? '';
$ruta_html = $ruta_html ?? '../html/';
$ruta_backend = $ruta_backend ?? '../../backend/';
?>
<header class="site-header"> 
    <a class="brand" href="<?= $ruta_vistas ?>inicio.php"> 
        <img class="brand-logo" src="<?= $ruta_img ?>logos/cooperadora.png" alt="Logo de la cooperadora">
        <span class="brand-text">Cooperadora <small>Escuela Técnica N°1 Eduardo Ader</small></span> 
    </a>
    <button class="menu-toggle" type="button" aria-label="Abrir menú" aria-expanded="false" aria-controls="main-navigation">
        <span></span>
        <span></span>
        <span></span>
    </button>
    <nav class="main-nav" id="main-navigation" aria-label="Navegacion principal"> 
        <a class="<?= ($current_page === 'inicio.php') ? 'current' : '' ?>" href="<?= $ruta_vistas ?>inicio.php">Inicio</a> 
        <a href="<?= ($current_page === 'inicio.php') ? '#equipo' : $ruta_vistas . 'inicio.php#equipo' ?>">Equipo</a>
        <a href="<?= ($current_page === 'inicio.php') ? '#opiniones' : $ruta_vistas . 'inicio.php#opiniones' ?>">Opiniones</a>
        <a class="<?= in_array($current_page, ['tienda.html', 'tienda.php', 'producto.php']) ? 'current' : '' ?>" href="<?= $ruta_html ?>tienda.html">Productos</a> 
        <?php if ($is_authenticated): ?>
            <div class="profile-menu">
                <button class="profile-button" type="button" aria-expanded="false" aria-controls="profile-panel" onclick="const p = document.getElementById('profile-panel'); const isOpen = p.hidden; p.hidden = !isOpen; this.setAttribute('aria-expanded', String(isOpen));">
                    <span class="profile-avatar" aria-hidden="true"><?= htmlspecialchars($iniciales); ?></span>
                    <span class="profile-name"><?= htmlspecialchars($nombre_usuario); ?></span>
                </button>
                <div class="profile-panel" id="profile-panel" hidden>
                    <?php if ($tipo_rol === 'usuario'): ?>
                        <button class="profile-option" type="button" data-profile-action="settings">Configuración</button>
                    <?php elseif ($tipo_rol === 'administrador'): ?>
                        <a class="profile-option" href="<?= $ruta_vistas ?>admin.php" style="text-decoration:none; color:inherit; display:block;">Panel Admin</a>
                        <!-- El administrador no accede a la configuración de usuario -->
                    <?php endif; ?>
                    <a class="profile-option profile-logout" href="<?= $ruta_backend ?>logout.php" style="text-decoration:none; color:inherit; display:block;">Cerrar sesión</a>
                </div>
            </div>
            <?php else: ?>
            <a class="<?= ($current_page === 'login.php') ? 'current' : '' ?>" href="<?= $ruta_vistas ?>login.php">Iniciar sesión</a>
            <a class="<?= ($current_page === 'registro.php') ? 'current' : '' ?>" href="<?= $ruta_vistas ?>registro.php">Registrarse</a>
        <?php endif; ?>
    </nav> 
</header>