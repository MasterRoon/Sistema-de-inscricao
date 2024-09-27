<?php
include 'conexao.php';
session_start();



$usuario_id = $_SESSION['usuario_id'];

if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
} else {
    echo "Usuário não logado!";
    exit;
}

// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $curso_id = $_POST['curso_id'];

    // Verifique se o aluno já está inscrito no curso
    $sql = "SELECT * FROM inscricoes WHERE usuario_id = $usuario_id AND curso_id = $curso_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Você já está inscrito neste curso!";
    } else {
        // Verifique se o aluno está tentando se inscrever em cursos com horários conflitantes
        $sql_horarios = "
            SELECT c.data, c.horario 
            FROM cursos c 
            JOIN inscricoes i ON c.id = i.curso_id 
            WHERE i.usuario_id = $usuario_id
            AND c.data = (SELECT data FROM cursos WHERE id = $curso_id)
            AND c.horario = (SELECT horario FROM cursos WHERE id = $curso_id)
        ";
        $result_horarios = $conn->query($sql_horarios);

        if ($result_horarios->num_rows > 0) {
            echo "Você já está inscrito em outro curso no mesmo horário!";
        } else {
            // Inscrição no curso
            $sql_inscricao = "INSERT INTO inscricoes (usuario_id, curso_id) VALUES ($usuario_id, $curso_id)";
            if ($conn->query($sql_inscricao) === TRUE) {
                echo "Inscrição realizada com sucesso!";
            } else {
                echo "Erro ao realizar inscrição: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Módulo de Inscrição</title>
</head>
<body>
    <h2>Inscrever-se em um Curso</h2>
    <form method="POST" action="">
        <label for="curso_id">Selecione o Curso:</label><br>
        <select id="curso_id" name="curso_id">
            <?php
            // Listar cursos disponíveis
            $sql_cursos = "SELECT id, titulo FROM cursos";
            $result_cursos = $conn->query($sql_cursos);

            if ($result_cursos->num_rows > 0) {
                while($curso = $result_cursos->fetch_assoc()) {
                    echo "<option value='" . $curso['id'] . "'>" . $curso['titulo'] . "</option>";
                }
            } else {
                echo "<option value=''>Nenhum curso disponível</option>";
            }
            ?>
        </select><br><br>

        <input type="submit" value="Inscrever">
    </form>
</body>
</html>


<br><br>
<a href="../index.php">
    <button style="padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Retornar à Página Inicial
    </button>
</a>

