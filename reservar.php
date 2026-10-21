<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'config/conexao.php';

$sql_mesas = "SELECT id, numero, capacidade FROM mesas WHERE status = 'disponivel'";
$resultado_mesas = $pdo->query($sql_mesas);

$sql_horarios = "SELECT id, horario FROM horarios";
$resultado_horarios = $pdo->query($sql_horarios);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Fazer Reserva - Restaurante</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
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
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 24px;
        }
        p {
            color: #666;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #444;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #218838;
        }
        .voltar {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }
        .voltar:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Faça a sua Reserva</h1>
        <p>Olá, <strong><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></strong>! Escolha os detalhes abaixo:</p>

        <!-- Formulário de Reserva -->
        <form action="processar_reserva.php" method="POST">
            
            <!-- Escolha da Data -->
            <label for="data_reserva">Data da Reserva:</label>
            <input type="date" id="data_reserva" name="data_reserva" required>

            <!-- Escolha da Mesa -->
            <label for="mesa_id">Escolha a Mesa:</label>
            <select id="mesa_id" name="mesa_id" required>
                <option value="">Selecione uma mesa...</option>
                <?php while ($mesa = $resultado_mesas->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?php echo $mesa['id']; ?>">
                        Mesa <?php echo $mesa['numero']; ?> (Capacidade: <?php echo $mesa['capacidade']; ?> pessoas)
                    </option>
                <?php endwhile; ?>
            </select>

            <!-- Escolha do Horário -->
            <label for="horario_id">Escolha o Horário:</label>
            <select id="horario_id" name="horario_id" required>
                <option value="">Selecione um horário...</option>
                <?php while ($horario = $resultado_horarios->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?php echo $horario['id']; ?>">
                        <?php echo date('H:i', strtotime($horario['horario'])); ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <button type="submit" class="btn">Confirmar Reserva</button>
        </form>

        <a href="index.php" class="voltar">Voltar para a Página Inicial</a>
    </div>
</body>
</html>