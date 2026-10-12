<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'config/conexao.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if (!empty($nome) && !empty($email) && !empty($senha)) {
        try {
            // Verifica se o e-mail já está cadastrado
            $sqlCheck = "SELECT id FROM USUARIOS WHERE email = :email";
            $stmtCheck = $pdo->prepare($sqlCheck);
            $stmtCheck->execute(['email' => $email]);

            if ($stmtCheck->rowCount() > 0) {
                $mensagem = "<p style='color: red;'>Este e-mail já está cadastrado!</p>";
            } else {
                // Criptografa a senha para maior segurança
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                // Insere o novo usuário na tabela USUARIOS
                $sql = "INSERT INTO USUARIOS (nome, email, senha) VALUES (:nome, :email, :senha)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'nome' => $nome,
                    'email' => $email,
                    'senha' => $senhaHash
                ]);

                $mensagem = "<p style='color: green;'>Cadastro realizado com sucesso! <a href='login.php'>Entrar</a></p>";
            }
        } catch (PDOException $e) {
            $mensagem = "<p style='color: red;'>Erro ao cadastrar usuário.</p>";
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
    <title>Cadastro - Restaurante</title>
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
        input[type="text"],
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
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
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
        <h2>Criar Conta</h2>
        <?= $mensagem ?>
        <form action="cadastro.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Palavra-passe (Senha):</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn">Cadastrar</button>
        </form>
        <a href="index.php" class="back-link">Voltar à Página Inicial</a>
    </div>
</body>
</html>