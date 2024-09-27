<?php
include 'conexao.php'; // Conectando ao banco de dados

// Consulta SQL para obter todas as inscrições
$sql = "SELECT usuarios.nome AS aluno, cursos.titulo AS curso, eventos.titulo AS evento 
        FROM inscricoes
        JOIN usuarios ON inscricoes.usuario_id = usuarios.id
        JOIN cursos ON inscricoes.curso_id = cursos.id
        JOIN eventos ON cursos.evento_id = eventos.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Inscrições</title>
</head>
<body>
    <h2>Relatório de Inscrições</h2>
    <table border="1">
        <tr>
            <th>Aluno</th>
            <th>Curso</th>
            <th>Evento</th>
        </tr>
        <?php
        // Exibindo os resultados em uma tabela
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["aluno"] . "</td><td>" . $row["curso"] . "</td><td>" . $row["evento"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Nenhuma inscrição encontrada</td></tr>";
        }
        ?>
    </table>
</body>
</html>
