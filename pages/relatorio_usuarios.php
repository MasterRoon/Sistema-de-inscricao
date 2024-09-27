<?php
include 'conexao.php'; // Conectando ao banco de dados

// Consulta SQL para obter todos os usuários
$sql = "SELECT matricula, nome, email FROM usuarios";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Usuários</title>
</head>
<body>
    <h2>Relatório de Usuários</h2>
    <table border="1">
        <tr>
            <th>Matrícula</th>
            <th>Nome</th>
            <th>Email</th>
        </tr>
        <?php
        // Exibindo os resultados em uma tabela
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["matricula"] . "</td><td>" . $row["nome"] . "</td><td>" . $row["email"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Nenhum usuário cadastrado</td></tr>";
        }
        ?>
    </table>
</body>
</html>
