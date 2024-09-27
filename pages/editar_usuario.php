<?php
include 'conexao.php';
session_start();

$usuario_id = $_SESSION['usuario_id'] ?? null;

if ($usuario_id === null) {
    echo "Erro: Usuário não está logado ou ID de usuário não encontrado.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET nome='$nome', email='$email' WHERE id=$usuario_id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Informações atualizadas com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
} else {
    $sql = "SELECT nome, email FROM usuarios WHERE id=$usuario_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        $nome = $usuario['nome'];
        $email = $usuario['email'];
    } else {
        echo "Erro: Usuário não encontrado.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
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
        <h2>Editar Usuário</h2>
        <form action="editar_usuario.php" method="post">
            <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

            <button type="submit">Salvar Alterações</button>
        </form>
        <br><br>
        <a href="../index.php">
            <button>Retornar à Página Inicial</button>
        </a>
    </div>
</body>
</html>


