<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conectando ao banco de dados
    require 'conexao.php';

    // Capturando os dados do formulário de login
    $email = $_POST['email'];
    $senha = $_POST['senha']; // Senha sem criptografia

    // Verificando se o email e a senha existem no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Dados corretos, loga o usuário
        $row = $result->fetch_assoc();
        $_SESSION['usuario_id'] = $row['id'];
        $_SESSION['usuario_nome'] = $row['nome'];
        header('Location:index.php');
        exit;
    } else {
        // Dados incorretos
        echo "Email ou senha incorretos.";
    }

    // Fechando a conexão com o banco de dados
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .container { max-width: 400px; margin: auto; }
        label { display: block; margin-top: 10px; }
        input[type="email"], input[type="password"] {
            width: 100%; padding: 8px; margin-top: 5px;
            border: 1px solid #ccc; border-radius: 4px;
        }
        button {
            padding: 10px 20px; background-color: #007BFF;
            color: white; border: none; border-radius: 5px;
            cursor: pointer; margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>
        </form>
        <br><br>
        <a href="../index.php">
            <button>Retornar à Página Inicial</button>
        </a>
    </div>
</body>
</html>




