<?php
session_start();
require_once 'config/conexao.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if (!empty($email) && !empty($senha)) {
        try {
            // Busca o utilizador pelo e-mail
            $sql = "SELECT * FROM USUARIOS WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica se o utilizador existe e se a palavra-passe está correcta
            if ($usuario && password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                
                // Redireciona para uma página protegida (vamos criar depois)
                header("Location: index.php?logado=1");
                exit;
            } else {
                $mensagem = "<p style='color: red;'>E-mail ou palavra-passe incorretos!</p>";
            }
        } catch (PDOException $e) {
            $mensagem = "<p style='color: red;'>Erro ao tentar fazer login.</p>";
        }
    } else {
        $mensagem = "<p style='color: red;'>Preencha todos os campos!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Restaurante</title>
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
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #218838;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Entrar no Sistema</h2>
        <?= $mensagem ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Palavra-passe:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn">Entrar</button>
        </form>
        <a href="index.php" class="back-link">Voltar à Página Inicial</a>
    </div>
</body>
</html>