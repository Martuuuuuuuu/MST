<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta - Cooperadora EEST N°1</title>
    <link rel="stylesheet" href="../styles/inicio.css">
    <link rel="stylesheet" href="../styles/sesion.css">
</head>
<body>
<?php require_once __DIR__ . '/componentes/header.php'; ?>
    <main class="sesion-main">
        <div class="sesion-card">
            <h1>Crear cuenta</h1>
            <p class="sesion-subtitulo">Completá tus datos para poder reservar productos de la cooperadora.</p>

            <?php if (isset($_GET['error'])): ?>
                <div id="sesion-error" class="sesion-error visible"><?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php else: ?>
                <div id="sesion-error" class="sesion-error"></div>
            <?php endif; ?>

            <form class="sesion-form" action="../../backend/procesar.php" method="POST">
                <div class="sesion-fila">
                    <div>
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required autocomplete="given-name">
                    </div>
                    <div>
                        <label for="apellido">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" required autocomplete="family-name">
                    </div>
                </div>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required autocomplete="email">

                <div class="sesion-fila">
                    <div>
                        <label for="dni">DNI:</label>
                        <input type="text" id="dni" name="dni" required autocomplete="off" inputmode="numeric">
                    </div>
                    <div>
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" id="telefono" name="telefono" required autocomplete="tel">
                    </div>
                </div>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required minlength="6" autocomplete="new-password">

                <label for="password2">Repetir contraseña:</label>
                <input type="password" id="password2" name="password2" required minlength="6" autocomplete="new-password">

                <button type="submit" class="sesion-enviar">Crear cuenta</button>
            </form>

            <p class="sesion-cambio">¿Ya tenés una cuenta? <a href="login.php">Iniciá sesión</a></p>
        </div>
    </main>
<?php require_once __DIR__ . '/componentes/footer.php'; ?>
    <script>
        document.querySelector('.sesion-form').addEventListener('submit', function (e) {
            const p1 = document.getElementById('password').value;
            const p2 = document.getElementById('password2').value;
            if (p1 !== p2) {
                e.preventDefault();
                const box = document.getElementById('sesion-error');
                box.textContent = 'Las contraseñas no coinciden.';
                box.classList.add('visible');
            }
        });
    </script>
    <script src="../javascript/Script.js"></script>
</body>
</html>
