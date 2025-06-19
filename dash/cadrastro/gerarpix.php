<?php

// Configurações do Mercado Pago
$accessToken = 'APP_USR-4443887924560844-123119-afd0f30deae9c537b10e7a14727a8e86-2189208850'; // Substitua pelo seu Access Token válido

header('Content-Type: application/json');

// Verifica se o parâmetro "valor" foi enviado
if (!isset($_GET['valor']) || !is_numeric($_GET['valor'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Parâmetro "valor" é obrigatório e deve ser numérico.'
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

// Obtém o valor do pagamento
$valor = floatval($_GET['valor']);
if ($valor <= 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'O valor deve ser maior que zero.'
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

// Gera um UUID como chave de idempotência
function generateIdempotencyKey()
{
    return bin2hex(random_bytes(16)); // Gera uma string de 32 caracteres (128 bits)
}

$idempotencyKey = generateIdempotencyKey();

// Dados do pagamento
$data = [
    'transaction_amount' => $valor,
    'description' => 'Pagamento via PIX',
    'payment_method_id' => 'pix',
    'payer' => [
        'email' => 'pagador@exemplo.com',
        'first_name' => 'Usuário',
        'last_name' => 'Teste'
    ]
];

// Configura a URL da API do Mercado Pago
$url = 'https://api.mercadopago.com/v1/payments';

// Configura a requisição cURL
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $accessToken",
    "X-Idempotency-Key: $idempotencyKey"
]);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Executa a requisição
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Erro ao se conectar ao Mercado Pago.',
        'details' => curl_error($ch)
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    curl_close($ch);
    exit;
}

curl_close($ch);

// Decodifica a resposta
$responseData = json_decode($response, true);

// Verifica se a resposta contém erro
if ($httpCode >= 400 || isset($responseData['error'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Erro na criação do pagamento.',
        'details' => $responseData
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

// Retorna os dados do QR Code, Copiar e Colar e ID do pagamento
$pixData = [
    'status' => 'success',
    'message' => 'Pagamento PIX gerado com sucesso.',
    'data' => [
        'id' => $responseData['id'] ?? null,
        'pix_qr' => $responseData['point_of_interaction']['transaction_data']['qr_code_base64'] ?? null,
        'pix_copia_e_cola' => $responseData['point_of_interaction']['transaction_data']['qr_code'] ?? null
    ]
];

echo json_encode($pixData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
