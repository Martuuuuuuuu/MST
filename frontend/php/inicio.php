<?php
session_start();
$is_authenticated = isset($_SESSION['tipo']);
$tipo_rol = $_SESSION['tipo'] ?? null;
$nombre_usuario = $_SESSION['nombre'] ?? '';
$apellido_usuario = $_SESSION['apellido'] ?? '';

$inicial1 = !empty($nombre_usuario) ? strtoupper(substr(trim($nombre_usuario), 0, 1)) : '';
$inicial2 = !empty($apellido_usuario) ? strtoupper(substr(trim($apellido_usuario), 0, 1)) : '';
$iniciales = ($inicial1 || $inicial2) ? $inicial1 . $inicial2 : 'U';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooperadora EEST N°1</title> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../styles/inicio.css">
    <link rel="stylesheet" href="../styles/perfil.css">
</head>
<body id="inicio">
<?php require_once __DIR__ . '/componentes/header.php'; ?>
    <main>
        <section class="landing-hero" aria-labelledby="landing-title">
            <div class="hero-orb hero-orb-large" aria-hidden="true"></div>
            <div class="hero-orb hero-orb-small" aria-hidden="true"></div>
            <div class="hero-ring hero-ring-top" aria-hidden="true"></div>
            <div class="hero-ring hero-ring-bottom" aria-hidden="true"></div>
            <div class="landing-shell">
                <div class="landing-copy">
                    <h1 id="landing-title">Una escuela<br><em>que crece</em><br>con todos.</h1>
                    <p class="landing-description">Un espacio para estar más cerca, conocer, participar y formar parte de nuestra comunidad.</p>
                    <a class="landing-button" href="#equipo">Conocé nuestra comunidad <span aria-hidden="true">↓</span></a>
                </div>
            </div>
        </section>
        <section class="team-section" id="equipo" aria-labelledby="team-title">
            <div class="team-heading">
                <p class="team-kicker">Nuestra comunidad</p>
                <h2 id="team-title">El equipo que acompaña a la escuela</h2>
            </div>
            <div class="team-grid" >
                <article class="team-card">
                    <img src="https://i.pinimg.com/736x/32/9b/54/329b54d07444f009b0634f438db9a449.jpg" alt="Lasaneta Cristina" class="team-avatar">
                    <h3>Lasaneta Cristina</h3>
                    <p>Presidente</p>
                </article>
                <article class="team-card">
                    <img src="https://i.pinimg.com/736x/32/9b/54/329b54d07444f009b0634f438db9a449.jpg" alt="Bimenez Liliana" class="team-avatar">
                    <h3>Gimenez Liliana</h3>
                    <p>Tesorero</p>
                </article>
                <article class="team-card">
                    <img src="https://i.pinimg.com/736x/32/9b/54/329b54d07444f009b0634f438db9a449.jpg" alt="Federiconi Diana" class="team-avatar">
                    <h3>Federiconi Diana</h3>
                    <p>Secretaria</p>
                </article>
                <article class="team-card">
                    <img src="https://i.pinimg.com/736x/32/9b/54/329b54d07444f009b0634f438db9a449.jpg" alt="Duran Alejandra" class="team-avatar">
                    <h3>Duran Alejandra</h3>
                    <p>Primera vocal Titular</p>
                </article>
                <article class="team-card">
                    <img src="https://i.pinimg.com/736x/32/9b/54/329b54d07444f009b0634f438db9a449.jpg" alt="Salcedo Fernanda" class="team-avatar">
                    <h3>Salcedo Fernanda</h3>
                    <p>Segundo vocal Titular</p>
                </article>
                <article class="team-card">
                    <img src="https://i.pinimg.com/736x/32/9b/54/329b54d07444f009b0634f438db9a449.jpg" alt="Fortuna Daniel" class="team-avatar">
                    <h3>Fortuna Daniel</h3>
                    <p>Tercera vocal titular</p>
                </article>
                <article class="team-card">
                    <img src="https://i.pinimg.com/736x/32/9b/54/329b54d07444f009b0634f438db9a449.jpg" alt="Mohlingez Yanesa" class="team-avatar">
                    <h3>Mohlingez Vanesa</h3>
                    <p>Primer vocal Suplente</p>
                </article>
                <article class="team-card">
                    <img src="https://i.pinimg.com/736x/32/9b/54/329b54d07444f009b0634f438db9a449.jpg" alt="Rojas Vanesa" class="team-avatar">
                    <h3>Rojas Vanesa</h3>
                    <p>Segundo vocal Suplente</p>
                </article>
            </div>
        </section>
        <section class="opinions-section" id="opiniones" aria-labelledby="opinions-title">
            <div class="opinions-heading">
                <p class="opinions-kicker">Lo que comparte la comunidad</p>
                <h2 id="opinions-title">Opiniones que nos ayudan a crecer</h2>
                <p>Dejanos tu experiencia con la cooperadora y ayudanos a seguir mejorando.</p>
            </div>

            <div class="opinions-layout">
                <div class="opinions-list" id="opinions-list" aria-live="polite"></div>
                <form class="opinion-form" id="opinion-form">
                    <label for="opinion-message">Compartí tu opinión</label>
                    <div class="opinion-compose">
                        <textarea id="opinion-message" name="message" maxlength="500" placeholder="Contanos tu experiencia con la cooperadora..." required></textarea>
                        <button type="submit">Publicar</button>
                    </div>
                    <p class="opinion-status" id="opinion-status" role="status" aria-live="polite"></p>
                </form>
            </div>
        </section>
    </main>
<?php require_once __DIR__ . '/componentes/footer.php'; ?>
    <script src="../javascript/script.js"></script>
</body>
</html>
