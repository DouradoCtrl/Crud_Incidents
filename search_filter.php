


<?php
// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Captura os valores do formulário
if (isset($_POST['switches'])) {
    $switches = $_POST['switches'];
} else {
    $switches = [];
}

if (isset($_POST['situacao'])) {
    $situacao = $_POST['situacao'];
} else {
    $situacao = [];
}

if (isset($_POST['dataInicio'])) {
    $dataInicio = $_POST['dataInicio'];
} else {
    $dataInicio = '';
}

if (isset($_POST['dataFim'])) {
    $dataFim = $_POST['dataFim'];
} else {
    $dataFim = '';
}

// Construção da query SQL dinâmica
$query = "SELECT * FROM incidentes WHERE 1=1";

// Filtro por switches
if (!empty($switches)) {
    $switchPlaceholders = implode(',', array_fill(0, count($switches), '?'));
    $query .= " AND nome_switch IN ($switchPlaceholders)";
}

// Filtro por status
if (!empty($situacao)) {
    $situacaoPlaceholders = implode(',', array_fill(0, count($situacao), '?'));
    $query .= " AND status IN ($situacaoPlaceholders)";
}

// Filtro por datas
if (!empty($dataInicio) && !empty($dataFim)) {
    $query .= " AND data_incidente BETWEEN ? AND ?";
} elseif (!empty($dataInicio)) {
    $query .= " AND data_incidente >= ?";
} elseif (!empty($dataFim)) {
    $query .= " AND data_incidente <= ?";
}

// Preparação da consulta
$stmt = $conn->prepare($query);

// Liga os parâmetros
$params = array_merge($switches, $situacao);

if (!empty($dataInicio) && !empty($dataFim)) {
    $params[] = $dataInicio;
    $params[] = $dataFim;
} elseif (!empty($dataInicio)) {
    $params[] = $dataInicio;
} elseif (!empty($dataFim)) {
    $params[] = $dataFim;
}

// Bind dos parâmetros na consulta
$stmt->bind_param(str_repeat('s', count($params)), ...$params);

// Execução da consulta
$stmt->execute();
$result = $stmt->get_result();

// Exibe os resultados
if ($result->num_rows === 0) {
    echo "<h1>Nenhum resultado encontrado</h1>";
} else {
    // Exibe os resultados
    print("<table class='table table-hover table-striped table-bordered table-light mt-2'>");
    print("<tr>");
        print("<th>#</th>");
        print("<th><div class=''>Nome</div></th>");
        print("<th><div class='text-center'>Switch</div></th>");
        print("<th class='w-25'><div class=''>Descricao</div></th>");
        print("<th><div class='text-center'>Status</div></th>");
        print("<th><div class='text-center'>Data incidente</div></th>");
        print("<th><div class='text-center'>Hora</div></th>");
        print("<th><div class='text-center'>Finalizado</div></th>");
        print("<th><div class='text-center'>Hora fim</div></th>");
        print("<th style='width: 200px;'><div class='text-center'>Ações</div></th>");
    print("</tr>");

    while ($row = $result->fetch_assoc()) {
        $data_fim = $row['data_incidente_fim'];
        $horaText = $row['hora_incidente_fim'];

        if ($data_fim == "0000-00-00") {
            $data_fim = "Aguardando";
        }

        // Variáveis de classe Bootstrap
        $statusClass = '';
        $dataClass = '';
        $horaClass = '';
        $statusClassDiv = '';

        // Situação do incidente
        if ($row['status'] == 'Pendente') {
            $statusClass = 'text-white text-center';
            $statusClassDiv = 'bg-danger rounded';
        } elseif ($row['status'] == 'Concluído') {
            $statusClass = 'text-white text-center';
            $statusClassDiv = 'bg-success rounded';
        }

        // Situação de data/aguardando
        if ($data_fim == 'Aguardando') {
            $dataClass = 'bg-warning rounded';
        } else {
            $dataClass = 'bg-secondary rounded';
        }

        // Situação de hora
        if ($horaText == '00:00:00') {
            $horaClass = 'bg-warning rounded text-light text-center';
            $horaText = 'Aguardando';
        } else {
            $horaClass = 'text-center';
        }

        print("<tr>");
            print("<td>".$row['id']."</td>");
            print("<td>".$row['nome']."</td>");
            print("<td><div class='text-center'>".$row['nome_switch']."</div></td>");
            print("<td>".$row['descricao']."</td>");
            print("<td class='$statusClass'><div class='$statusClassDiv'>".$row['status']."</div></td>");
            print("<td class=''><div class='bg-secondary rounded text-light text-center'>".$row['data_incidente']."</div></td>");
            print("<td class=''><div class='text-center'>".$row['hora_incidente']."</div></td>");
            print("<td class='$statusClass'><div class='$dataClass'>".$data_fim."</div></td>");
            print("<td class=''><div class='$horaClass'>".$horaText."</div></td>");
            print("<td>
                <div class='d-flex justify-content-around align-items-center'>
                    <button class='btn btn-success' onclick=\"location.href='?page=editar&id=" . $row['id'] . "';\">Editar</button>
                    <button class='btn btn-danger text-white' onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar&entendo=excluir&id=" . $row['id'] . "';}else{false;}\">Excluir</button>
                    </div>
            </td>");
        print("</tr>");
    }

    print("</table>");
}

// Fecha a conexão
$stmt->close();
$conn->close();
?>

