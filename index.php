<?php
session_start();

// Verifica se o utilizador acabou de se autenticar ou se já tem sessão ativa
$logado = isset($_SESSION['usuario_id']);
$nomeUsuario = $logado ? $_SESSION['usuario_nome'] : '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas - Restaurante</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
        }
        p {
            color: #666;
            margin-bottom: 20px;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #28a745;
        }
        .btn-secondary:hover {
            background-color: #218838;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .welcome-msg {
            color: #28a745;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo ao Restaurante</h1>
        
        <?php if ($logado): ?>
            <p class="welcome-msg">Olá, <?= htmlspecialchars($nomeUsuario) ?>! Seja bem-vindo de volta.</p>
            <a href="reservar.php" class="btn btn-secondary">Fazer uma Reserva</a>
            <a href="logout.php" class="btn btn-danger">Terminar Sessão</a>
        <?php else: ?>
            <p>Faça sua reserva de mesa de forma rápida e prática.</p>
            <a href="cadastro.php" class="btn">Cadastrar-se</a>
            <a href="login.php" class="btn btn-secondary">Entrar</a>
        <?php endif; ?>
    </div>
</body>
</html>