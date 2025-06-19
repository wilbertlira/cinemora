<?php
session_start();
$valor = 9.90;
$usuario = $_SESSION['usuario'] ?? null;

if (!$usuario) {
  header("Location: ../../login.php");
  exit;
}

require_once 'conexao.php'; // conexão com o banco
?>
<!DOCTYPE html>
<html>
<head>
  <title>Pagamento - PIX</title>
  <style>
    body {
      background-color: #121212;
      color: white;
      font-family: Arial, sans-serif;
      text-align: center;
      padding: 40px;
    }
    .pix-box {
      background-color: #1f1f1f;
      padding: 20px;
      border-radius: 10px;
      display: inline-block;
    }
    img {
      width: 200px;
      margin: 20px 0;
    }
    .copiar {
      background: #2b2b2b;
      color: white;
      padding: 10px;
      border-radius: 5px;
      word-break: break-word;
      font-size: 14px;
    }
    .btn-verificar {
      background-color: #e50914;
      color: white;
      border: none;
      padding: 10px 20px;
      margin-top: 15px;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
    }
    .btn-verificar:hover {
      background-color: #b2060f;
    }
  </style>
</head>
<body>
<div class="pix-box">
  <h2>Finalize o Pagamento</h2>
  <p>Use o QR Code abaixo ou copie o código Pix.</p>

<?php
$url = "http://localhost/cinemora/dash/cadrastro/gerarpix.php?valor=$valor";
$json = file_get_contents($url);
$res = json_decode($json, true);

if ($res && $res['status'] === 'success') {
    $paymentId = $res['data']['id'];

    echo "<img src='data:image/png;base64," . $res['data']['pix_qr'] . "' alt='QR Code PIX'>";
    echo "<p class='copiar'>" . $res['data']['pix_copia_e_cola'] . "</p>";
    echo "<button class='btn-verificar' onclick='verificarPagamento()'>Verificar Pagamento</button>";
    echo "<p id='status-msg'></p>";

    echo "<script>
      function verificarPagamento() {
        fetch('verificar_pagamento.php?id=$paymentId')
          .then(res => res.json())
          .then(data => {
            const msg = document.getElementById('status-msg');
            if (data.status === 'approved') {
              alert('Pagamento confirmado! VIP ativado.');
              location.href = '../../filmes.php';
            } else {
              msg.innerText = 'Pagamento ainda não confirmado. Tente novamente mais tarde.';
              msg.style.color = 'orange';
            }
          })
          .catch(err => {
            document.getElementById('status-msg').innerText = '404 - Aguardando Pagamento';
          });
      }
    </script>";
} else {
    echo "<p>Erro ao gerar o pagamento. Tente novamente.</p>";
}
?>
</div>
</body>
</html>
