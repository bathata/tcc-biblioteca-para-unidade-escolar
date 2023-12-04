<?php
// Encerrar a sessão
session_start();
session_unset();
session_destroy();
header("Location: login_admin.php"); // mudar para index.php
?>