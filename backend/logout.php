<?php
session_start();
session_destroy();
header("Location: ../frontend/html/formulario.html");
exit;
?>