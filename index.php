<?php
    include("database.php");
    include("exportarCsv.php");
?>

<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="text-black bg-light">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container d-flex justify-content-between">
            <div class="">
                <a class="btn btn-success" href="?page=cadastrar">Adicionar</a>
                <a class="btn btn-outline-dark" href="?page=exibir">Exibir</a>
            </div>
         
                
            <form action="index.php?page=exibir-search" class="d-flex" role="search" method="POST">
                <!-- Botão que abre o modal -->
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#meuModal">
                    Filtro
                </button>
                <button type="submit" class="btn btn-secondary ms-1" name="export">
                    Exportar
                </button>
                <div class="input-group w-100 ms-1">
                    <input name="search" class="form-control" type="search" placeholder="Pesquisar" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Buscar</button>
                </div>
            </form>
        </div>
    </nav>
    
    <div class="modal fade" id="meuModal" tabindex="-1" aria-labelledby="meuModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="meuModalLabel">Exibir apenas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php?page=search_filter" method="POST">
                        <!-- Filtro por Switches -->
                        <div class="mb-3">
                            <label for="switches" class="form-label">Selecione os Switches</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="switches[]" value="SW-DF100" id="SW-DF100">
                                <label class="form-check-label" for="SW-DF100">SW-DF100</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="switches[]" value="SW-ESTANCIA" id="SW-ESTANCIA">
                                <label class="form-check-label" for="SW-ESTANCIA">SW-ESTANCIA</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="switches[]" value="SW-MARAJO" id="SW-MARAJO">
                                <label class="form-check-label" for="SW-MARAJO">SW-MARAJO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="switches[]" value="SW-PATIO" id="SW-PATIO">
                                <label class="form-check-label" for="SW-PATIO">SW-PATIO</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="switches[]" value="SW-SOF" id="SW-SOF">
                                <label class="form-check-label" for="SW-SOF">SW-SOF</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="switches[]" value="SW-VALE" id="SW-VALE">
                                <label class="form-check-label" for="SW-VALE">SW-VALE</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="switches[]" value="SW-JARDINS" id="SW-JARDINS">
                                <label class="form-check-label" for="SW-JARDINS">SW-JARDINS</label>
                            </div>
                        </div>

                        <!-- Filtro por Situação (Pendente ou Concluído) -->
                        <div class="mb-3">
                            <label for="situacao" class="form-label">Situação do Incidente</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="situacao[]" value="pendente" id="pendente">
                                <label class="form-check-label" for="pendente">Pendente</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="situacao[]" value="concluido" id="concluido">
                                <label class="form-check-label" for="concluido">Concluído</label>
                            </div>
                        </div>

                        <!-- Filtro por Data de Início e Fim -->
                        <div class="mb-3">
                            <label for="dataInicio" class="form-label">Data de Início</label>
                            <input type="date" class="form-control" id="dataInicio" name="dataInicio">
                        </div>
                        <div class="mb-3">
                            <label for="dataFim" class="form-label">Data de Fim</label>
                            <input type="date" class="form-control" id="dataFim" name="dataFim">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
            switch (@$_REQUEST["page"]) {
                case 'cadastrar':
                    include("adicionar.php");
                    break;
                case 'exibir':
                    include("exibir.php");
                    break;
                case 'exibir-search':
                    include("exibir-search.php");
                    break;
                case 'salvar':
                    include("salvar.php");
                    break;
                case 'editar':
                    include("editar.php");
                    break;
                case 'search_filter':
                    include("search_filter.php");
                    break;
                case 'home':
                    header("Location: index.php");
                    exit();
                    break;
                default:
                    include("exibir.php");
                    break;
            }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>