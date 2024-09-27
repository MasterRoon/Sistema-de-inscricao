<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conectando ao banco de dados
    require 'conexao.php';

    // Capturando os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $matricula = $_POST['matricula'];
    $senha = $_POST['senha']; // Senha sem criptografia

    // Inserindo os dados no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, matricula, senha) VALUES ('$nome', '$email', '$matricula', '$senha')";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    // Fechando a conexão com o banco de dados
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .container { max-width: 400px; margin: auto; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="email"], input[type="password"] {
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
        <h2>Cadastro de Usuário</h2>
        <form action="cadastro.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Cadastrar</button>
        </form>
        <br><br>
        <a href="../index.php">
            <button>Retornar à Página Inicial</button>
        </a>
    </div>
</body>
</html>


