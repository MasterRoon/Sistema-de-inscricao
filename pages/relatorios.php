<?php
include 'conexao.php'; // Conexão ao banco de dados

function exibirRelatorioUsuarios($conn) {
    $sql = "SELECT matricula, nome, email FROM usuarios";
    $result = $conn->query($sql);
    echo "<h3>Relatório de Usuários</h3>";
    echo "<table border='1'><tr><th>Matrícula</th><th>Nome</th><th>Email</th></tr>";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["matricula"] . "</td><td>" . $row["nome"] . "</td><td>" . $row["email"] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Nenhum usuário cadastrado</td></tr>";
    }
    echo "</table><br>";
}

function exibirRelatorioEventos($conn) {
    $sql = "SELECT eventos.titulo AS evento, cursos.titulo AS curso, cursos.descricao, cursos.data, cursos.horario 
            FROM eventos
            JOIN cursos ON eventos.id = cursos.evento_id";
    $result = $conn->query($sql);
    echo "<h3>Relatório de Eventos e Cursos</h3>";
    echo "<table border='1'><tr><th>Evento</th><th>Curso</th><th>Descrição</th><th>Data</th><th>Horário</th></tr>";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["evento"] . "</td><td>" . $row["curso"] . "</td><td>" . $row["descricao"] . "</td><td>" . $row["data"] . "</td><td>" . $row["horario"] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Nenhum evento ou curso cadastrado</td></tr>";
    }
    echo "</table><br>";
}

function exibirRelatorioInscricoes($conn) {
    $sql = "SELECT usuarios.nome AS aluno, cursos.titulo AS curso, eventos.titulo AS evento 
            FROM inscricoes
            JOIN usuarios ON inscricoes.usuario_id = usuarios.id
            JOIN cursos ON inscricoes.curso_id = cursos.id
            JOIN eventos ON cursos.evento_id = eventos.id";
    $result = $conn->query($sql);
    echo "<h3>Relatório de Inscrições</h3>";
    echo "<table border='1'><tr><th>Aluno</th><th>Curso</th><th>Evento</th></tr>";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["aluno"] . "</td><td>" . $row["curso"] . "</td><td>" . $row["evento"] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Nenhuma inscrição encontrada</td></tr>";
    }
    echo "</table><br>";
}

if (isset($_GET['relatorio'])) {
    $relatorio = $_GET['relatorio'];
} else {
    $relatorio = null;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatórios</title>
</head>
<body>
    <h2>Relatórios</h2>
    <ul>
        <li><a href="?relatorio=usuarios">Relatório de Usuários</a></li>
        <li><a href="?relatorio=eventos">Relatório de Eventos e Cursos</a></li>
        <li><a href="?relatorio=inscricoes">Relatório de Inscrições</a></li>
    </ul>

    <?php
    // Exibir o relatório selecionado
    if ($relatorio == 'usuarios') {
        exibirRelatorioUsuarios($conn);
    } elseif ($relatorio == 'eventos') {
        exibirRelatorioEventos($conn);
    } elseif ($relatorio == 'inscricoes') {
        exibirRelatorioInscricoes($conn);
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
