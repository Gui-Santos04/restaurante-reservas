
<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/sessao.php';

// Só permite acesso a usuários autenticados
if (empty($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

// Escapa o nome antes de exibi-lo no HTML
$nomeUsuario = htmlspecialchars(
    (string) ($_SESSION['usuario_nome'] ?? 'Cliente'),
    ENT_QUOTES,
    'UTF-8'
);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aurora Restaurante</title>

    <style>
        :root {
            --branco: #fffdf9;
            --dourado: #e6b84c;
            --laranja: #c65d2e;
            --texto: #292622;
            --bege: #f7efe3;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: var(--texto);
            background: var(--branco);
        }

        header {
            position: sticky;
            top: 0;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 18px 7%;
            background: white;
            box-shadow: 0 2px 12px #00000010;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
        }

        .logo span {
            color: var(--laranja);
        }

        nav {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        nav a:hover {
            color: var(--laranja);
        }

        .botao {
            display: inline-block;
            padding: 13px 20px;
            border: 0;
            border-radius: 7px;
            color: white;
            background: var(--laranja);
            cursor: pointer;
            font-weight: bold;
        }

        .hero {
            min-height: 460px;
            display: flex;
            align-items: center;
            padding: 70px 9%;
            background: linear-gradient(120deg, #fff5df, #f7dfaa);
        }

        .hero-conteudo {
            max-width: 650px;
        }

        .hero h1 {
            margin: 0 0 20px;
            font-family: Georgia, serif;
            font-size: clamp(38px, 6vw, 64px);
        }

        .hero p {
            font-size: 18px;
            line-height: 1.7;
        }

        section.conteudo {
            padding: 65px 9%;
            text-align: center;
        }

        .bege {
            background: var(--bege);
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
            margin-top: 30px;
        }

        .card {
            padding: 28px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 5px 20px #00000008;
        }

        footer {
            padding: 30px 7%;
            color: white;
            background: #292622;
            text-align: center;
        }

        @media (max-width: 700px) {
            header {
                align-items: flex-start;
                flex-direction: column;
            }

            nav {
                flex-wrap: wrap;
                gap: 14px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .hero {
                min-height: 380px;
                padding: 50px 7%;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }
        }
    </style>
</head>
<body>

<header>
    <a class="logo" href="#inicio">✦ Aurora <span>Restaurante</span></a>

    <nav aria-label="Navegação principal">
        <a href="#inicio">Menu</a>
        <a href="#reserva">Reserva</a>
        <a href="#cardapio">Cardápio</a>
        <a href="#sobre">Sobre nós</a>
        <a class="botao" href="reservar.php">Fazer reserva</a>
    </nav>
</header>

<main>
    <section class="hero" id="inicio">
        <div class="hero-conteudo">
            <p>UMA EXPERIÊNCIA PARA SABOREAR</p>
            <h1>Sabores que tornam momentos especiais.</h1>
            <p>
                Bem-vindo ao Aurora Restaurante, onde ingredientes
                selecionados e cuidado em cada detalhe se encontram.
            </p>
            <a class="botao" href="#cardapio">Conheça nosso cardápio</a>
        </div>
    </section>

    <section class="conteudo" id="cardapio">
        <h2>Nosso cardápio</h2>
        <p>Algumas sugestões do nosso restaurante.</p>

        <div class="cards">
            <article class="card">
                <h3>Bruschetta artesanal</h3>
                <p>Pão tostado, tomate fresco e ervas.</p>
                <strong>R$ 24,90</strong>
            </article>

            <article class="card">
                <h3>Massa da casa</h3>
                <p>Massa preparada com molho especial.</p>
                <strong>R$ 42,90</strong>
            </article>

            <article class="card">
                <h3 sobremesa="true">Sobremesa especial</h3>
                <p>Uma opção doce para finalizar sua experiência.</p>
                <strong>R$ 19,90</strong>
            </article>
        </div>

        <p><small>Preços ilustrativos: altere conforme seu cardápio.</small></p>
    </section>

    <section class="conteudo bege" id="reserva">
        <h2>Sua mesa está esperando por você</h2>
        <p>Planeje sua visita e venha viver essa experiência.</p>
        <a class="botao" href="reservar.php">Reservar agora</a>
    </section>

    <section class="conteudo" id="sobre">
        <h2>Sobre o Aurora</h2>
        <p>
            Um restaurante fictício criado para valorizar a boa gastronomia,
            o atendimento acolhedor e os momentos compartilhados à mesa.
        </p>
        <p>Olá, <?= $nomeUsuario ?>! Seja bem-vindo.</p>
    </section>
</main>

<footer>
    <h3>Aurora Restaurante</h3>
    <p>Endereço, telefone e horários: personalize estes dados.</p>
    <p>&copy; <?= date('Y') ?> Aurora Restaurante. Todos os direitos reservados.</p>
</footer>

</body>
</html>
