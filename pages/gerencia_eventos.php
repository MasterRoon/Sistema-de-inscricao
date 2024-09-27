<?php
include 'conexao.php';
session_start();



// Lógica para gerenciar eventos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'evento') {
    $titulo_evento = $_POST['titulo_evento'];
    $descricao_evento = $_POST['descricao_evento'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];

    $sql = "INSERT INTO eventos (titulo, descricao, data_inicio, data_fim) VALUES ('$titulo_evento', '$descricao_evento', '$data_inicio', '$data_fim')";
    if ($conn->query($sql) === TRUE) {
        echo "Evento adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar evento: " . $conn->error;
    }
}

// Lógica para gerenciar cursos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'curso') {
    $titulo_curso = $_POST['titulo_curso'];
    $descricao_curso = $_POST['descricao_curso'];
    $data_curso = $_POST['data_curso'];
    $horario_curso = $_POST['horario_curso'];
    $evento_id = $_POST['evento_id'];

    $sql = "INSERT INTO cursos (titulo, descricao, data, horario, evento_id) VALUES ('$titulo_curso', '$descricao_curso', '$data_curso', '$horario_curso', $evento_id)";
    if ($conn->query($sql) === TRUE) {
        echo "Curso adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar curso: " . $conn->error;
    }
}

// Selecionar eventos para exibição na lista de cursos
$sql_eventos = "SELECT id, titulo FROM eventos";
$result_eventos = $conn->query($sql_eventos);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Eventos e Cursos</title>
</head>
<body>
    <h2>Gerenciar Eventos</h2>
    <form method="POST" action="">
        <input type="hidden" name="action" value="evento">
        <label for="titulo_evento">Título do Evento:</label><br>
        <input type="text" id="titulo_evento" name="titulo_evento"><br><br>

        <label for="descricao_evento">Descrição:</label><br>
        <textarea id="descricao_evento" name="descricao_evento"></textarea><br><br>

        <label for="data_inicio">Data de Início:</label><br>
        <input type="date" id="data_inicio" name="data_inicio"><br><br>

        <label for="data_fim">Data de Fim:</label><br>
        <input type="date" id="data_fim" name="data_fim"><br><br>

        <input type="submit" value="Adicionar Evento">
    </form>

    <h2>Gerenciar Cursos</h2>
    <form method="POST" action="">
        <input type="hidden" name="action" value="curso">
        <label for="titulo_curso">Título do Curso:</label><br>
        <input type="text" id="titulo_curso" name="titulo_curso"><br><br>

        <label for="descricao_curso">Descrição:</label><br>
        <textarea id="descricao_curso" name="descricao_curso"></textarea><br><br>

        <label for="data_curso">Data do Curso:</label><br>
        <input type="date" id="data_curso" name="data_curso"><br><br>

        <label for="horario_curso">Horário:</label><br>
        <input type="time" id="horario_curso" name="horario_curso"><br><br>

        <label for="evento_id">Evento Associado:</label><br>
        <select id="evento_id" name="evento_id">
            <option value="">Selecione um evento</option>
            <?php while($evento = $result_eventos->fetch_assoc()) { ?>
                <option value="<?php echo $evento['id']; ?>"><?php echo $evento['titulo']; ?></option>
            <?php } ?>
        </select><br><br>

        <input type="submit" value="Adicionar Curso">
    </form>
</body>
</html>

<br><br>
<a href="../index.php">
    <button style="padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Retornar à Página Inicial
    </button>
</a>
