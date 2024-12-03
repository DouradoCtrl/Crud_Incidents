<div class="row d-flex align-items-center">
    <div>
        <?php
            $search = $_POST['search'];
            
            $sql = "SELECT * FROM incidentes WHERE 1=1 AND (nome LIKE '%$search%' OR nome_switch LIKE '%$search%' OR descricao LIKE '%$search%');";

            $res = $conn->query($sql);

            $qtdi = $res->num_rows;

            if($qtdi > 0 ) {
                print("<table class='table table-hover table-striped table-bordered rounded table-light mt-2'>");
                print("<tr>");
                    print("<th>#</th>");
                    print("<th><div class=''>Nome</div></th>");
                    print("<th><div class='text-center'>Switch</div></th>");
                    print("<th class='w-25'><div class=''>Descricao</div></th>");
                    print("<th><div class='text-center'>Status</div></th>");
                    print("<th><div class='text-center'>Data incidente</div></th>");
                    print("<th><div class='text-center'>Hora</div></th>");
                    print("<th><div class='text-center'>Data finalizado</div></th>");
                    print("<th><div class='text-center'>Hora fim</div></th>");
                    print("<th style='width: 200px;'><div class='text-center'>Ações</div></th>");
                print("</tr>");
                while($row = $res->fetch_object()) {
                    $data_fim = $row->data_incidente_fim;
                    $horaText = $row->hora_incidente_fim;

                    if($row->data_incidente_fim == "0000-00-00") {
                        $data_fim = "Aguardando";
                    }
                    
                    //variaveis de class bootstrap
                    $statusClass = '';
                    $dataClass = '';
                    $horaClass = '';

                    //Situacao do incidente
                    if ($row->status == 'Pendente') {
                        $statusClass = 'text-white text-center'; 
                        $statusClassDiv = 'bg-danger rounded';
                    } elseif ($row->status == 'Concluído') {
                        $statusClass = 'text-white text-center'; 
                        $statusClassDiv = 'bg-success rounded';
                    }

                    //Situação de dada/aguardando
                    if ($row->data_incidente_fim == '0000-00-00') {
                        $dataClass = 'bg-warning rounded';
                    }else {
                        $dataClass = 'bg-secondary rounded';
                        $statusClass = 'text-light text-center';
                    }

                    if($row->hora_incidente_fim == '00:00:00') {
                        $horaClass = 'bg-warning rounded text-light text-center';
                        $horaText = 'Aguardando';
                    }else {
                        $horaClass = 'text-center';
                    }

                    print("<tr>");
                        print ("<td>".$row->id."</td>");
                        print ("<td>".$row->nome."</td>");
                        print ("<td><div class='text-center'>".$row->nome_switch."</div></td>");
                        print ("<td>".$row->descricao."</td>");
                        print ("<td class='$statusClass'><div class='$statusClassDiv'>".$row->status."</div></td>");
                        print ("<td class=''><div class='bg-secondary rounded text-light text-center'>".$row->data_incidente."</div></td>");
                        print ("<td class=''><div class= 'text-center'>".$row->hora_incidente."</div></td>");
                        print ("<td class='$statusClass'><div class='$dataClass'>".$data_fim."</div></td>");
                        print ("<td class=''><div class='$horaClass'>".$horaText."</div></td>");
                        print ("<td>
                            <div class='d-flex justify-content-around align-items-center'>
                                <button class='btn btn-success' onclick=\"location.href='?page=editar&id=" . $row->id . "';\">Editar</button>
                                <button class='btn btn-danger text-white' onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar&entendo=excluir&id=" . $row->id . "';}else{false;}\">Excluir</button>
                                </div>
                        </td>");
                    print("</tr>");
                }
                print("</table>");
            }else {
                print("<p class='alert alert-danger'>Nenhum resultado encontrado</p>");
            }
        ?>
    </div>
</div>
