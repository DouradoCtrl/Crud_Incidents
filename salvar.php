<?php

    switch(@$_REQUEST["entendo"]) {
        case 'Cadastrar':
            $nome = $_POST["nome"];
            $nome_switch = $_POST["nome_switch"];
            $descricao = $_POST["descricao"];
            $status = $_POST["status"];
            $data_incidente = $_POST["data_incidente"];
            $hora_incidente = $_POST["hora_incidente"];
            $data_incidente_fim = $_POST["data_incidente_fim"];
            $hora_incidente_fim = $_POST["hora_incidente_fim"];
            
            $sql = "INSERT INTO incidentes (nome, nome_switch, descricao, status, data_incidente, hora_incidente, data_incidente_fim, hora_incidente_fim) 
            VALUES ('{$nome}', '{$nome_switch}', '{$descricao}', '{$status}', '{$data_incidente}', '{$hora_incidente}', '{$data_incidente_fim}', '{$hora_incidente_fim}');";

            $res = $conn->query($sql);

            if($res==true) {

                echo("
                <h1 class='alert alert-success'>Adicionado com sucesso</h1>
                <div class=\"container d-flex justify-content-end\">
                    <a class=\"btn btn-primary btn-lg\" href=\"index.php\">Voltar</a>
                </div>

                ");
            }else {
                print("<script>alert(\"Não foi possível cadastrar !!\");</script>");
                print("<script>location.href='?page=listar';</script>");
            }

            break;

        case 'Editar':
            $id_inc = $_REQUEST['id'];

            $nome = $_POST["nome"];
            $nome_switch = $_POST["nome_switch"];
            $descricao = $_POST["descricao"];
            $status = $_POST["status"];
            $data_incidente = $_POST["data_incidente"];
            $hora_incidente = $_POST["hora_incidente"];
            $data_incidente_fim = $_POST["data_incidente_fim"];
            $hora_incidente_fim = $_POST["hora_incidente_fim"];

            $sql = 
                "UPDATE incidentes
                SET nome = '$nome',
                    nome_switch = '$nome_switch',
                    descricao = '$descricao',
                    status = '$status',
                    data_incidente = '$data_incidente',
                    hora_incidente = '$hora_incidente',
                    data_incidente_fim = '$data_incidente_fim',
                    hora_incidente_fim = '$hora_incidente_fim'
                WHERE id = $id_inc;";

            $res = $conn->query($sql);

            if($res==true) {
                echo("
                <h1 class='alert alert-success'>Editado com sucesso</h1>

                <div class=\"container d-flex justify-content-end\">
                    <a class=\"btn btn-primary btn-lg\" href=\"index.php\">Voltar</a>
                </div>

                ");
            }else {
                print("<script>alert(\"Não foi possível Editar !!\");</script>");
                print("<script>location.href='?page=exibir';</script>");
            }
            
        break;

        case 'excluir':
            $sql = "DELETE FROM incidentes WHERE id=".$_REQUEST['id'];
            $res = $conn->query($sql);
            if($res==true) {
                echo("
                <h1 class='alert alert-danger'>Excluído com sucesso</h1>
                <div class=\"container d-flex justify-content-end\">
                    <a class=\"btn btn-primary btn-lg\" href=\"index.php\">Voltar</a>
                </div>
                ");
            }else {
                print("<script>alert(\"Não foi possível Editar !!\");</script>");
                print("<script>location.href='?page=listar';</script>");
            }

            break;
    }