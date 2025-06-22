<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Planos - Cinemora</title>
  <link rel="stylesheet" href="style.css"> <!-- Usa seu CSS principal -->
  <style>
    .planos-container {
      display: flex;
      justify-content: center;
      gap: 40px;
      padding: 40px;
      flex-wrap: wrap;
    }

    .plano {
      background-color: #1e1e1e;
      border-radius: 10px;
      padding: 30px;
      width: 300px;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.5);
      transition: transform 0.3s ease;
    }

    .plano:hover {
      transform: scale(1.05);
    }

    .plano h3 {
      color: #e50914;
      font-size: 24px;
      margin-bottom: 15px;
    }

    .plano p {
      font-size: 15px;
      margin: 10px 0;
      color: #ccc;
    }

    .plano strong {
      font-size: 28px;
      color: #fff;
      display: block;
      margin-top: 15px;
    }

    .btn-assinar {
      margin-top: 20px;
      padding: 10px;
      background-color: #e50914;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
      text-decoration: none;
      display: inline-block;
    }

    .btn-assinar:hover {
      background-color: #c40811;
    }
  </style>
</head>
<body>

<header>
  <h1>Cinemora</h1>
  <nav>
    <a href="index.html">Início</a>
    <a href="filmes.php">Filmes</a>
    <a href="planos.php">Planos</a>
  </nav>
</header>

<section class="section">
  <h3>Escolha seu Plano</h3>
  <div class="planos-container">
    
    <div class="plano">
      <h3>Plano Gratuito</h3>
      <p>Acesso limitado</p>
      <p>Assista com anúncios</p>
      <p>Alguns títulos bloqueados</p>
      <strong>R$ 0,00</strong>
      <a href="#" class="btn-assinar" onclick="logoutNow(event)">Criar Conta Grátis</a>

      
    </div>


    <script>
      // Evita seguir o link padrão
function logoutNow(event) {
  event.preventDefault(); 
  window.location.href = "../../dash/cadrastro/cadastro.php"; // Caminho absoluto a partir de localhost
}
</script>

    <div class="plano">
      <h3>Plano VIP</h3>
      <p>Acesso total a filmes e séries</p>
      <p>Sem anúncios</p>
      <p>Conteúdo exclusivo</p>
      <strong>R$ 9,90</strong>
      <a href="cadrastro/index.php" class="btn-assinar">Assinar Agora</a>
    </div>

  </div>
</section>

<footer>
  &copy; <?php echo date("Y"); ?> Cinemora - Todos os direitos reservados.
</footer>

</body>
</html>
