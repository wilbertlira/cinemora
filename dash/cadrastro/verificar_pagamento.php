<?php
session_start();
require_once '../../conexao.php'; // conexão com o banco

$usuario = $_SESSION['usuario'] ?? null;
if (!$usuario || !isset($_GET['id'])) {
  echo json_encode(['status' => 'error']);
  exit;
}

$accessToken = 'APP_USR-4443887924560844-123119-afd0f30deae9c537b10e7a14727a8e86-2189208850';
$paymentId = $_GET['id'];

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.mercadopago.com/v1/payments/$paymentId",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "Authorization: Bearer $accessToken"
  ]
]);

$response = curl_exec($curl);
curl_close($curl);

$data = json_decode($response, true);
$status = $data['status'] ?? '';

// Se o pagamento foi aprovado, atualizar o VIP
if ($status === 'approved' || $status === 'accredited') {
  $stmt = $conn->prepare("UPDATE usuarios SET vip = 1 WHERE usuario = ?");
  $stmt->bind_param("s", $usuario);
  $stmt->execute();
  echo json_encode(['status' => 'approved']);
  exit;
}

echo json_encode(['status' => $status]);
