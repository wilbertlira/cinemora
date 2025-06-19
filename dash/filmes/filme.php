<?php
session_start();
include "conexao.php";

// Verifica se está logado
if (!isset($_SESSION['usuario'])) {
  header("Location: /cinemora/filmes/login.php");
  exit();
}

// Verifica se o usuário tem VIP
$usuario = $_SESSION['usuario'];
$sql = "SELECT vip FROM usuarios WHERE usuario = '$usuario' LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row['vip'] != 1) {
  echo "<h2 style='color: red; text-align:center;'>⚠️ Acesso restrito! Apenas usuários VIP podem assistir a este filme.</h2>";
  echo "<div style='text-align:center;'><a href='logout.php' style='color:#e50914;'>Sair</a></div>";
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Assistir Filme - Cinemora</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #121212;
      color: #fff;
    }

    header {
      background-color: #1f1f1f;
      padding: 20px;
      text-align: center;
    }

    header h1 {
      margin: 0;
      color: #e50914;
    }

    .container {
      max-width: 1000px;
      margin: 40px auto;
      padding: 0 20px;
    }

    .video-player {
      width: 100%;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(229, 9, 20, 0.2);
      margin-bottom: 20px;
    }

    .video-player video {
      width: 100%;
      height: 500px;
      border: none;
    }

    .movie-title {
      font-size: 32px;
      color: #e50914;
      margin-bottom: 10px;
    }

    .user-info {
      text-align: right;
      margin-top: -10px;
      margin-bottom: 20px;
    }

    .logout-link {
      color: #ccc;
      text-decoration: none;
      margin-left: 10px;
    }

    .logout-link:hover {
      color: #fff;
    }

    .movie-description {
      font-size: 18px;
      line-height: 1.6;
      color: #ccc;
      margin-bottom: 30px;
    }

    .back-button {
      background-color: #e50914;
      color: #fff;
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .back-button:hover {
      background-color: #ff1f1f;
    }

    footer {
      text-align: center;
      padding: 20px;
      background-color: #1f1f1f;
      color: #999;
      margin-top: 40px;
    }
  </style>
</head>
<body>

<header>
  <h1>Cinemora</h1>
</header>

<div class="container">
  <div class="user-info">
    Logado como: <strong><?php echo $_SESSION['usuario']; ?></strong>
    <a class="logout-link" href="logout.php">Sair</a>
  </div>

  <div class="video-player">
    <video controls>
      <source src="protected/filme1.mp4" type="video/mp4">
      Seu navegador não suporta vídeo.
    </video>
  </div>

  <h2 class="movie-title">🎬 Oppenheimer</h2>
  <p class="movie-description">Um retrato intenso da vida de J. Robert Oppenheimer, o físico por trás do projeto da bomba atômica. Uma jornada de ciência, ética e as consequências da criação de armas nucleares.</p>

  <a href="../../index.html/../.." class="back-button">← Voltar ao Início</a>
</div>

<footer>
  &copy; 2025 Cinemora. Todos os direitos reservados.
</footer>

</body>
</html>
