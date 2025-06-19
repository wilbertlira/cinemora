<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login - Cinemora</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #121212;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background-color: #1f1f1f;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(229, 9, 20, 0.2);
      width: 100%;
      max-width: 400px;
      box-sizing: border-box;
      text-align: center;
    }

    .login-container h2 {
      margin-bottom: 20px;
      color: #e50914;
      font-size: 28px;
    }

    .login-container form {
      display: flex;
      flex-direction: column;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      padding: 12px;
      margin-bottom: 15px;
      border: none;
      border-radius: 8px;
      background-color: #2c2c2c;
      color: #fff;
      font-size: 16px;
      transition: 0.3s;
    }

    .login-container input[type="text"]:focus,
    .login-container input[type="password"]:focus {
      background-color: #333;
      outline: none;
    }

    .login-container button {
      background-color: #e50914;
      color: #fff;
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .login-container button:hover {
      background-color: #ff0f1f;
    }

    .login-container p.error {
      color: #ff4d4d;
      margin-top: 10px;
      text-align: center;
    }

    /* Texto discreto para cadastro */
    .login-container .cadastro-discreto {
      margin-top: 15px;
      font-size: 13px;
      color: #bbb;
    }

    .login-container .cadastro-discreto a {
      color: #888;
      text-decoration: none;
      font-weight: 600;
    }

    .login-container .cadastro-discreto a:hover {
      color: #e50914;
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Entrar no Cinemora</h2>
    <form action="autenticar.php" method="post">
      <input type="text" name="usuario" placeholder="Usuário" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit">Entrar</button>
    </form>

    <?php if (isset($_GET['erro'])): ?>
      <p class="error">Usuário ou senha inválidos.</p>
    <?php endif; ?>

    <div class="cadastro-discreto">
      Ainda não tem uma conta? <a href="../dash/cadrastro/cadastro.php">Cadastre-se aqui</a>
    </div>
  </div>

</body>
</html>
