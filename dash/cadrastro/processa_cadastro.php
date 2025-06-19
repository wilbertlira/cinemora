<?php
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$senha = $_POST['senha'];
//$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// Salva no banco (ajuste para a sua conexão com o MySQL)
$conn = new mysqli("localhost", "root", "", "cinemora");

if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

// Cria usuário com VIP desativado por padrão
$conn->query("INSERT INTO usuarios (usuario, email, senha, vip) VALUES ('$usuario', '$email', '$senha', 0)");

// Armazena ID do usuário na sessão (você pode buscar pelo ID se precisar)
$_SESSION['usuario'] = $usuario;

// Redireciona para pagamento PIX
header("Location: pagamento.php");
exit;
