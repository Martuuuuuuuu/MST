<?php
/**
 * Componente: Footer / Pie de Página
 * 
 * Variables opcionales configurables antes de incluir este componente:
 * - $current_page: Nombre del archivo actual (ej: 'inicio.php')
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
$current_page = $current_page ?? basename($_SERVER['PHP_SELF']);

$ruta_img = $ruta_img ?? '../img/';
$ruta_vistas = $ruta_vistas ?? '';
$ruta_html = $ruta_html ?? '../html/';
$ruta_backend = $ruta_backend ?? '../../backend/';
?>
<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-brand">
            <a class="footer-logo" href="<?= ($current_page === 'inicio.php') ? '#inicio' : $ruta_vistas . 'inicio.php' ?>">Cooperadora <small>Escolar</small></a>
            <span>Trabajamos para acompañar y fortalecer a nuestra comunidad educativa.</span>
            <a class="footer-action" href="<?= $ruta_html ?>tienda.html">Conocé nuestros productos <span aria-hidden="true">→</span></a>
        </div>
        <div class="footer-column">
            <h2><span class="footer-heading-icon icon-clock" aria-hidden="true"></span> Atención</h2>
            <p>Lunes a viernes<br><strong>12:00 a 17:00 hs</strong></p>
        </div>
        <div class="footer-column">
            <h2><span class="fa fa-user-circle-o" aria-hidden="true"></span> Contacto</h2>
            <div class="footer-socials">
                <a href="https://www.instagram.com/cooperadoraetuno/" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><img src="<?= $ruta_img ?>logos/instagram.png" alt=""><span>@cooperadoraetuno</span></a>
                <a href="https://www.facebook.com/cooperadoraetuno" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><img src="<?= $ruta_img ?>logos/facebook.png" alt=""><span>@Asoc.Cooperadora Tecnica 1. VL</span></a>
                <a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox?compose=CllgCJNvwPHwtNwfVxHcxbZHlqFLBWMBVCcSrnmMbrhGnzsMdmbMWwWgLNNGBmxVJHKDWVHbWGq" target="_blank" rel="noopener noreferrer" aria-label="Gmail"><img src="<?= $ruta_img ?>logos/gmail.png" alt=""><span>cooperadoraet1@gmail.com</span></a>
                <a href="https://t.me/s/eest1?before=265" target="_blank" rel="noopener noreferrer" aria-label="Telegram"><img src="<?= $ruta_img ?>logos/telegram.png" alt=""><span>EESTN°1</span></a>
            </div>
        </div>
        <div class="footer-column footer-links">
            <h2><span class="footer-heading-icon icon-explore" aria-hidden="true"></span> Explorar</h2>
            <a href="<?= $ruta_vistas ?>inicio.php">Inicio</a>
            <a href="<?= ($current_page === 'inicio.php') ? '#equipo' : $ruta_vistas . 'inicio.php#equipo' ?>">Equipo</a>
            <a href="https://eest.tecnica1vl.org/" target="_blank" rel="noopener noreferrer">Pagina principal</a>
            <a href="<?= $ruta_html ?>tienda.html">Productos</a>
            <a href="<?= ($current_page === 'inicio.php') ? '#opiniones' : $ruta_vistas . 'inicio.php#opiniones' ?>">Opiniones</a>
            <?php if (!$is_authenticated): ?>
                <a href="<?= $ruta_vistas ?>login.php">Iniciar sesión</a>
                <a href="<?= $ruta_vistas ?>registro.php">Registrarse</a>
            <?php else: ?>
                <a href="<?= $ruta_backend ?>logout.php">Cerrar sesión</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="footer-bottom">
        <span>© <?= date('Y'); ?> Cooperadora EEST N°1. Todos los derechos reservados.</span>
        <span>Proyecto MST · Sitio web institucional</span>
    </div>
</footer>