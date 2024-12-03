<?php
    $sql = "SELECT * FROM incidentes WHERE id=".$_REQUEST["id"];
    $res = $conn->query($sql);

    $row = $res->fetch_object();
    /* print($_REQUEST["id"]); */
?>

<div class="row vh-100 d-flex align-items-center">
    <div class="col-12">
        <h1 class="text-center mt-3">Editar Incidente</h1>
        <form action="index.php?page=salvar" method="POST">
            <input type="hidden" name="entendo" value="Editar">
            <input type="hidden" name="id" value="<?php print($_REQUEST["id"])?>">

            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" required class="form-control d-block" value="<?php print($row->nome);?>"><br><br>

            <label for="nome_switch" class="form-label">Switch:</label>
            <select id="nome_switch" name="nome_switch" required class="form-control d-block ">
                <option value="SW-DF100" <?php echo ($row->nome_switch == 'SW-DF100') ? 'selected' : ''; ?>>SW-DF100</option>
                <option value="SW-ESTANCIA" <?php echo ($row->nome_switch == 'SW-ESTANCIA') ? 'selected' : ''; ?>>SW-ESTANCIA</option>
                <option value="SW-JARDINS" <?php echo ($row->nome_switch == 'SW-JARDINS') ? 'selected' : ''; ?>>SW-JARDINS</option>
                <option value="SW-MARAJO" <?php echo ($row->nome_switch == 'SW-MARAJO') ? 'selected' : ''; ?>>SW-MARAJO</option>
                <option value="SW-PATIO" <?php echo ($row->nome_switch == 'SW-PATIO') ? 'selected' : ''; ?>>SW-PATIO</option>
                <option value="SW-SOF" <?php echo ($row->nome_switch == 'SW-SOF') ? 'selected' : ''; ?>>SW-SOF</option>
                <option value="SW-VALE" <?php echo ($row->nome_switch == 'SW-VALE') ? 'selected' : ''; ?>>SW-VALE</option>
            </select><br><br>

            <label for="descricao" class="form-label">Descrição:</label>
            <textarea id="descricao" name="descricao" class="form-control d-block"><?php print(htmlspecialchars($row->descricao)); ?></textarea><br><br>


            <label for="status" class="form-label">Status:</label>
            <select id="status" name="status" required class="form-control d-block">
                <option value="Pendente" <?php echo ($row->status == 'Pendente') ? 'selected' : ''; ?>>Pendente</option>
                <option value="Concluído" <?php echo ($row->status == 'Concluído') ? 'selected' : ''; ?>>Concluído</option>
            </select><br><br>


            <label for="data_incidente" class="form-label">Data do Incidente:</label>
            <input type="date" id="data_incidente" name="data_incidente" required class="form-control d-block " value="<?php print($row->data_incidente);?>"><br><br>

            <label for="hora_incidente" class="form-label">Hora do Incidente:</label>
            <input type="time" id="hora_incidente" name="hora_incidente" required class="form-control d-block " value="<?php print($row->hora_incidente);?>"><br><br>

            <label for="data_incidente" class="form-label">Data fim do incidente:</label>
            <input type="date" id="data_incidente_fim" name="data_incidente_fim" class="form-control d-block "  value="<?php print($row->data_incidente_fim);?>"><br><br>

            <label for="hora_incidente_fim" class="form-label">Hora finalizado:</label>
            <input type="time" id="hora_incidente" name="hora_incidente_fim" class="form-control d-block " value="<?php print($row->hora_incidente_fim);?>"><br><br>

            <button type="submit" class="btn btn-success btn-lg mb-3">Salvar</button>
        </form>
    </div>
</div>