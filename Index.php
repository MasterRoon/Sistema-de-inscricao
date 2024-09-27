<?php
session_start();

// Verifica se o usuário está logado
$logado = isset($_SESSION['usuario_nome']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Control System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #007BFF;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .nav {
            display: flex;
            justify-content: center;
            background-color: #333;
        }
        .nav a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
        }
        .nav a:hover {
            background-color: #575757;
        }
        .container {
            padding: 20px;
        }
        .container h2 {
            text-align: center;
            color: #333;
        }
        .card {
            background-color: white;
            padding: 20px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }
        .card h3 {
            margin: 0 0 10px;
            color: #007BFF;
        }
        .card p {
            color: #666;
        }
        .login-card {
            text-align: center;
            margin-top: 20px;
        }
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Sistema de Controle de Eventos Acadêmicos</h1>
</div>

<div class="nav">
    <a href="index.php">Página Principal</a>
    <a href="pages/sobre.php">Sobre</a>
    <a href="pages/ranking.php">Ranking de Participação</a>
    <a href="pages/editar_usuario.php">Editar Usuário</a>
    <a href="pages/gerencia_eventos.php">Gerenciar Eventos e Cursos</a>
    <a href="pages/modulo_inscricao.php">Inscrições</a>
    <a href="pages/relatorios.php">Relatórios</a>
    <?php if ($logado): ?>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
    <?php endif; ?>
</div>

<div class="container">
    <h2>Bem-vindo ao Sistema de Controle de Eventos Acadêmicos</h2>

    <?php if ($logado): ?>
        <div class="card">
            <h3>Olá, <?php echo $_SESSION['usuario_nome']; ?>!</h3>
            <p>Você está logado. Aproveite todas as funcionalidades do sistema.</p>
        </div>
    <?php else: ?>
        <div class="card login-card">
            <h3>Você não está logado</h3>
            <p><a href="login.php">Clique aqui para fazer login</a> ou continue navegando.</p>
        </div>
        <div class="card login-card">
            <h3>Cadastre-se</h3>
            <p><a href="pages/cadastro.php">Clique aqui para se cadastrar</a> e comece a utilizar o sistema.</p>
        </div>
    <?php endif; ?>

    <div class="card">
        <h3>Eventos Disponíveis</h3>
        <p>Aqui você pode visualizar e gerenciar todos os eventos e cursos disponíveis.</p>
    </div>
    <div class="card">
        <h3>Gerencie seu Perfil</h3>
        <p>Edite suas informações pessoais e mantenha seu perfil atualizado.</p>
    </div>
</div>

<div class="footer">
    <p>&copy; 2024 Sistema de Controle de Eventos Acadêmicos</p>
</div>

</body>
</html>

