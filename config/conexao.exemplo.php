<?php
// Copie este arquivo para 'conexao.php' e preencha com as suas credenciais locais
$host = '127.0.0.1';
$banco = 'RESTAURANTE_DB';
$usuario = 'root';
$senha = 'SUA_SENHA_AQUI'; // Insira a sua senha do MySQL local aqui

try {
    $pdo = new PDO(
        "mysql:host=$host;port=3306;dbname=$banco;charset=utf8mb4",
        $usuario,
        $senha
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão realizada com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados.";
}