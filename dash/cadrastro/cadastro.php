<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro - Cinemora</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background-color: #121212;
      color: white;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .cadastro-box {
      background-color: #1f1f1f;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.5);
      width: 300px;
    }
    input, button {
      width: 100%;
      margin: 10px 0;
      padding: 10px;
      border: none;
      border-radius: 5px;
    }
    input {
      background-color: #2b2b2b;
      color: white;
    }
    button {
      background-color: #e50914;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }
    button:hover {
      background-color: #c40811;
    }
  </style>
</head>
<body>
  <div class="cadastro-box">
    <h2>Cadastre-se</h2>
    <form action="processa_cadastro.php" method="post">
      <input type="text" name="usuario" placeholder="Usuário" required>
      <input type="email" name="email" placeholder="E-mail" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit">Pagar R$9,90 e Cadastrar</button>
    </form>
  </div>
</body>
</html>
