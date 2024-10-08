<?php
session_start();
if (!isset($_SESSION['loginValido']) || !$_SESSION['loginValido']) {
    header("Location: index.php");
    exit();
}

$login = $_SESSION['loginValido'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard Admin</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="acoesAdmin.js"></script>
</head>

<!-- Formulario para adicionar nova Categoria -->
<div class="form-categoria">
    <h3 class="titulo-form">Adicionar Nova Categoria ao Acervo</h3>
    <br>
    <div id="alertMsg"></div>

    <div>
        <label for="desc-categoria">Descrição:</label>
        <input type="text" id="desc-categoria" name="desc-categoria" placeholder="Digite a categoria" required>

        <input type="hidden" id="fxCad" name="fxCad" value="cadCategoria">
    </div>

    <button onclick="cadCategoria()">Adicionar Categoria</button>
</div>
<hr>


<!-- Formulario para adicionar novo Genero -->
<div class="form-genero">
    <h3 class="titulo-form">Adicionar Novo Genero ao Acervo</h3>
    <br>
    <div id="alertMsg2"></div>

    <div>
        <label for="genero">Genero:</label>
        <input type="text" id="desc-genero" name="desc-genero" placeholder="Digite o genero">

        <input type="hidden" id="fxCad2" name="fxCad2" value="cadGenero">
    </div>

    <button onclick="cadGenero()">Adicionar Genero</button>
</div>
<hr>

<!-- Formulario para adicionar nova faixa etaria -->
<div class="form-etaria">
    <h3 class="titulo-form">Adicionar Faixa etaria ao Acervo</h3>
    <br>
    <div id="mensagem"></div>

    <div>
        <label for="etaria">Faixa Etaria:</label>
        <input type="text" id="desc-etaria" name="desc-etaria" placeholder="Digite a faixa etaria" required>

        <input type="hidden" id="fxCad3" name="fxCad3" value="cadEtaria">
    </div>

    <button onclick="cadEtaria()">Adicionar Faixa Etaria</button>
</div>
<hr>

<!-- Formulario do Acervo -->
<div class="form-acervo">
    <div>
        <h3 class="titulo-form">Adicionar Nova Midia ao Acervo</h3>
        <br>
        <div id="mensagemMidia"></div>

        <div>
            <label for="titulo">Titulo:</label>
            <input type="text" id="tituloMidia" name="tituloMidia" placeholder="Digite o Titulo" required>
        </div>

        <div>
            <label for="genero">Genero:</label>
            <select name="genero" id="genero" required>
                <option value="">Selecione o Genero</option>
                <?php
                // Conexão com o banco de dados
                require "../private/config/db/conn.php";

                // Consulta SQL para buscar os andares
                $sql = "SELECT idGenero, descricao FROM tbl_genero";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                // Itera pelos resultados e cria os options
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['idGenero'] . '">' . $row['descricao'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div>
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria" required>
                <option value="">Selecione a Categoria</option>
                <?php
                // Conexão com o banco de dados
                require "../private/config/db/conn.php";

                // Consulta SQL para buscar os andares
                $sql = "SELECT idCategoria, descricao FROM tbl_categoria";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                // Itera pelos resultados e cria os options
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['idCategoria'] . '">' . $row['descricao'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div>
            <label for="etaria">Faixa Etária:</label>
            <select name="etaria" id="etaria" required>
                <option value="">Selecione a Faixa Etária</option>
                <?php
                // Conexão com o banco de dados
                require "../private/config/db/conn.php";

                // Consulta SQL para buscar os andares
                $sql = "SELECT idEtaria, descricao FROM tbl_etaria";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                // Itera pelos resultados e cria os options
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['idEtaria'] . '">' . $row['descricao'] . '</option>';
                }
                ?>
            </select>
        </div>

        <input type="hidden" id="login" name="login" value="<?= $login ?>">

        <input type="hidden" id="fxCad4" name="fxCad4" value="cadMidia">

        <button onclick="cadMidia()">Adicionar Midia</button>
    </div>
</div>
</form>
<hr>


<!-- Formulario para adicionar Filme -->
<div class="form-filme">
    <h3 class="titulo-form">Adicionar Filme ao Acervo</h3>
    <br>
    <div id="mensagem"></div>

    <div>
        <label for="sinopse">Sinopse do Filme:</label>
        <input type="text" id="sinopse" name="sinopse" placeholder="Digite a sinpose " required>
    </div>

    <div>
        <label for="ano-lancamento">Ano de Lançamento:</label>
        <input type="date" id="ano-lancamento" name="ano-lancamento" placeholder="Digite a sinpose " required>

        <input type="hidden" id="fxCad" name="fxCad" value="cadFilme">
    </div>

    <button type="button" id="cad-filme">Adicionar Filme</button>
</div>
<hr>