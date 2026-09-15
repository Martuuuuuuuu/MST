<?php
session_start();
session_destroy();
header("Location: ../frontendnew/html/inicio.html");
exit;
?>