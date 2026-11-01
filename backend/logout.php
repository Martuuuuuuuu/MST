<?php
session_start();
session_destroy();
header("Location: ../frontend/php/inicio.php");
exit;
?>