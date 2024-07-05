<?php

//Dados para conexao local
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "db_contato";

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

mysqli_set_charset($conexao, "UTF8");

date_default_timezone_set("America/Sao_Paulo");

if(mysqli_connect_error()){
    die("Erro ao se conectar" . mysqli_connect_error());
}

?>