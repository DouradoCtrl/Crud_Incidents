<?php
if (isset($_POST['export'])) {
    $search = isset($_POST['search']) ? $_POST['search'] : '';
    $search = $conn->real_escape_string($search); // Escapar o valor de pesquisa
    // Configurações do cabeçalho para download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="incidentes_export.csv"');

    // Abre o fluxo de saída para enviar o CSV diretamente ao navegador
    $output = fopen('php://output', 'w');

    // Adiciona cabeçalho (adapte conforme necessário)
    fputcsv($output, ['ID', 'Nome', 'Switch', 'Descricao', 'Status', 'Data Incidente', 'Hora', 'Data Fim', 'Hora Fim'], ';');

    // Consulta ao banco com o filtro dinâmico
    $query = "SELECT * FROM incidentes WHERE 1=1 AND (nome LIKE '%$search%' OR nome_switch LIKE '%$search%' OR descricao LIKE '%$search%');";
    $result = $conn->query($query);

    // Adiciona os dados ao CSV
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row, ';'); // Use o mesmo delimitador aqui
    }

    // Fecha o fluxo de saída
    fclose($output);
    exit();
}
?>

<?php
if (isset($_POST['export'])) {
    $search = isset($_POST['search']) ? $_POST['search'] : '';
    $search = $conn->real_escape_string($search); // Escapar o valor de pesquisa

    // Configurações do cabeçalho para download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="incidentes_export.csv"');

    // Abre o fluxo de saída para enviar o CSV diretamente ao navegador
    $output = fopen('php://output', 'w');

    // Adiciona cabeçalho (adapte conforme necessário)
    fputcsv($output, ['ID', 'Nome', 'Switch', 'Descricao', 'Status', 'Data Incidente', 'Hora', 'Data Fim', 'Hora Fim'], ';');

    // Monta a query com os filtros
    $query = "SELECT * FROM incidentes WHERE 1=1";

    // Filtro de pesquisa de texto
    if (!empty($search)) {
        $query .= " AND (nome LIKE '%$search%' OR nome_switch LIKE '%$search%' OR descricao LIKE '%$search%')";
    }

    $result = $conn->query($query);

    // Adiciona os dados ao CSV
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row, ';'); // Use o mesmo delimitador aqui
    }

    // Fecha o fluxo de saída
    fclose($output);
    exit();
}
?>




