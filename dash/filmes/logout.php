<?php
session_start();
session_destroy();
header("Location: /cinemora/filmes/login.php"); // redireciona após logout
exit();
?>
