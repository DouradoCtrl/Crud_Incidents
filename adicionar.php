<h1 class="text-center mt-5">Adicionar Incidente</h1>
<div class="d-flex">
    <form action="index.php?page=salvar" method="POST" class="w-100">
        <input type="hidden" name="entendo" value="Cadastrar">

        <input type="hidden" name="id" value="">

        <label for="nome" class="form-label">Nome:</label>
        <input type="text" id="nome" name="nome" required class="form-control d-block"><br><br>

        <label for="status" class="form-label">Switch:</label>
        <select id="status" name="nome_switch" required class="form-control d-block ">
            <option value="SW-DF100">SW-DF100</option>
            <option value="SW-ESTANCIA">SW-ESTANCIA</option>
            <option value="SW-JARDINS">SW-JARDINS</option>
            <option value="SW-MARAJO">SW-MARAJO</option>
            <option value="SW-PATIO">SW-PATIO</option>
            <option value="SW-SOF">SW-SOF</option>
            <option value="SW-VALE">SW-VALE</option>
        </select><br><br>

        <label for="descricao class="form-label"">Descrição:</label>
        <textarea id="descricao" name="descricao" class="form-control d-block "></textarea><br><br>

        <label for="status" class="form-label">Status:</label>
        <select id="status" name="status" required class="form-control d-block ">
            <option value="Pendente">Pendente</option>
            <option value="Concluído">Concluído</option>
        </select><br><br>

        <label for="data_incidente" class="form-label">Data do incidente:</label>
        <input type="date" id="data_incidente" name="data_incidente" required class="form-control d-block "><br><br>

        <label for="hora_incidente" class="form-label">Hora do incidente:</label>
        <input type="time" id="hora_incidente" name="hora_incidente" required class="form-control d-block "><br><br>

        <label for="data_incidente" class="form-label">Data fim do incidente:</label>
        <input type="date" id="data_incidente_fim" name="data_incidente_fim" class="form-control d-block "><br><br>

        <label for="hora_incidente_fim" class="form-label">Hora finalizado:</label>
        <input type="time" id="hora_incidente" name="hora_incidente_fim" class="form-control d-block "><br><br>

        <button type="submit" class="btn btn-success btn-lg mb-5">Adicionar</button>
    </form>
</div>
