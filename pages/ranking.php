<?php
// Conexão com o banco de dados
include 'conexao.php';

// Padrão de pontuação
$pontos_por_curso = 10;

// Query para calcular o total de pontos de cada aluno
$query = "
    SELECT u.nome, u.email, COUNT(i.curso_id) AS cursos_concluidos, 
           COUNT(i.curso_id) * $pontos_por_curso AS total_pontos
    FROM usuarios u
    JOIN inscricoes i ON u.id = i.usuario_id
    GROUP BY u.id
    ORDER BY total_pontos DESC, u.nome ASC
";

$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Ranking de Participação</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 50px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Ranking de Participação dos Alunos</h2>
    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Cursos Concluídos</th>
            <th>Total de Pontos</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nome']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['cursos_concluidos']); ?></td>
                    <td><?php echo htmlspecialchars($row['total_pontos']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Nenhum aluno inscrito ou concluído cursos até o momento.</td>
            </tr>
        <?php endif; ?>
    </table>
    <br><br>
    <a href="../index.php">
        <button style="padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Retornar à Página Inicial
        </button>
    </a>
</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>
