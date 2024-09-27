<?php
include 'conexao.php';
session_start();



// Mostrar os eventos disponíveis
$sql = "SELECT id, titulo, descricao FROM eventos";
$eventos = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>
</head>
<body>
    <h2>Eventos Disponíveis</h2>
    <?php
    while($evento = $eventos->fetch_assoc()) {
        echo "<h3>" . $evento['titulo'] . "</h3>";
        echo "<p>" . $evento['descricao'] . "</p>";

        // Mostrar os cursos associados a cada evento
        $evento_id = $evento['id'];
        $sql = "SELECT id, titulo FROM cursos WHERE evento_id = $evento_id";
        $cursos = $conn->query($sql);
        echo "<ul>";
        while($curso = $cursos->fetch_assoc()) {
            echo "<li><a href='modulo_inscricao.php?curso_id=" . $curso['id'] . "'>" . $curso['titulo'] . "</a></li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>

<br><br>
<a href="../index.php">
    <button style="padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Retornar à Página Inicial
    </button>
</a>
