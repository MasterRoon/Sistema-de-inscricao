<?php
include 'conexao.php'; // Conectando ao banco de dados

// Consulta SQL para obter todos os eventos e cursos
$sql = "SELECT eventos.titulo AS evento, cursos.titulo AS curso, cursos.descricao, cursos.data, cursos.horario 
        FROM eventos
        JOIN cursos ON eventos.id = cursos.evento_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Eventos e Cursos</title>
</head>
<body>
    <h2>Relatório de Eventos e Cursos</h2>
    <table border="1">
        <tr>
            <th>Evento</th>
            <th>Curso</th>
            <th>Descrição</th>
            <th>Data</th>
            <th>Horário</th>
        </tr>
        <?php
        // Exibindo os resultados em uma tabela
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["evento"] . "</td><td>" . $row["curso"] . "</td><td>" . $row["descricao"] . "</td><td>" . $row["data"] . "</td><td>" . $row["horario"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum evento ou curso cadastrado</td></tr>";
        }
        ?>
    </table>
</body>
</html>

