<?php
session_start();

if(!isset($_SESSION['loginValido']) || !$_SESSION['loginValido']){
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard Admin</title>
 </head>

 <div class="form-acervo">
        <div>
            <h3 class="titulo-form">Adicionar Nova Midia ao Acervo</h3>
            <br>
            <div id="mensagem"></div>

            <div>
                <label for="titulo" >Titulo:</label>
                <input type="text" id="tituloMidia" name="tituloMidia" placeholder="Digite o Titulo" required>
            </div>

            <div>
                <label for="genero" >Genero:</label>
                 <select name="genero" id="genero" required>
                        <option value="">Selecione o genero</option>
                </select> 
            </div>

              <div>
                <label for="categoria" >Categoria:</label>
                 <select name="categoria" id="categoria" required>
                        <option value="">Selecione a categoria</option>
                </select> 
            </div>

            <div>
                <label for="etaria" >Faixa Etária:</label>
                 <select name="etaria" id="etaria" required>
                        <option value="">Selecione a faixa etaria</option>
                </select> 
            </div>

            <button type="button" id="cad-midia">Adicionar Midia</button>
        </div>
    </div>
<hr>

    <div class="form-categoria">
    <h3 class="titulo-form">Adicionar Nova Categoria ao Acervo</h3>
            <br>
            <div id="mensagem"></div>

            <div>
                <label for="desc-categoria" >Descrição:</label>
                <input type="text" id="desc-categoria" name="desc-categoria" placeholder="Digite a categoria" required>
            </div>

             <button type="button" id="cad-categoria">Adicionar Ctegoria</button>
    </div>
    <hr>

 <div class="form-genero">
    <h3 class="titulo-form">Adicionar Novo Genero ao Acervo</h3>
            <br>
            <div id="mensagem"></div>

            <div>
                <label for="genero" >Genero:</label>
                <input type="text" id="genero" name="genero" placeholder="Digite o genero" required>
            </div>

             <button type="button" id="cad-genero">Adicionar Genero</button>
    </div>

<hr>

<div class="form-etaria">
    <h3 class="titulo-form">Adicionar Faixa etaria ao Acervo</h3>
            <br>
            <div id="mensagem"></div>

            <div>
                <label for="etaria" >Faixa Etaria:</label>
                <input type="text" id="etaria" name="etaria" placeholder="Digite a faixa etaria" required>
            </div>

             <button type="button" id="cad-etaria">Adicionar Faixa Etaria</button>
    </div>
    <hr>

    <div class="form-filme">
    <h3 class="titulo-form">Adicionar Filme ao Acervo</h3>
            <br>
            <div id="mensagem"></div>

            <div>
                <label for="sinopse" >Sinopse do Filme:</label>
                <input type="text" id="sinopse" name="sinopse" placeholder="Digite a sinpose " required>
            </div>

            <div>
                <label for="ano-lancamento" >Ano de Lançamento:</label>
                <input type="date" id="ano-lancamento" name="ano-lancamento" placeholder="Digite a sinpose " required>
            </div>

             <button type="button" id="cad-filme">Adicionar Filme</button>
    </div>
    <hr>





