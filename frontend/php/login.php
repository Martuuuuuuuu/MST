<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Cooperadora EEST N°1</title>
    <link rel="stylesheet" href="../styles/inicio.css">
    <link rel="stylesheet" href="../styles/sesion.css">
</head>
<body>
<?php require_once __DIR__ . '/componentes/header.php'; ?>
    <main class="sesion-main">
        <div class="sesion-card">
            <h1>Iniciar sesión</h1>
            <p class="sesion-subtitulo">Ingresá con tu email y contraseña para acceder a tu cuenta.</p>

            <?php if (isset($_GET['error'])): ?>
                <div id="sesion-error" class="sesion-error visible"><?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php else: ?>
                <div id="sesion-error" class="sesion-error"></div>
            <?php endif; ?>

            <form class="sesion-form" action="../../backend/login.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required autocomplete="email">

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required autocomplete="current-password">

                <button type="submit" class="sesion-enviar">Ingresar</button>
            </form>

            <p class="sesion-cambio">¿Todavía no tenés una cuenta? <a href="registro.php">Registrate acá</a></p>
        </div>
    </main>

<?php require_once __DIR__ . '/componentes/footer.php'; ?>
    <script src="../javascript/Script.js"></script>
</body>
</html>
