<?php
include("../db/conn.php");

$username = $_POST["user-name-email"];
$newPassword = $_POST["new-password"];
$confirmNewPassword = $_POST["confirm-new-password"];
$newHash = $_GET["new-hash"];

$sql = "SELECT hash FROM tbl_login WHERE nome OR email "; 

$exc = $conn->query($sql);






if (
    (empty($username)) || (empty($newPassword)) || (empty($confirmNewPassword)) || ($username === "") || ($newPassword === "") || ($confirmNewPassword === "")
) {
    $resp = "ERRO - Algum campo está vazio";
} else {

    if ($newPassword !== $confirmNewPassword) {
        $resp = "ERRO - as senhas não combinam";
    } else {


        $apikkey = "manga";
        $apikkey = (md5($apikkey));


        //$resp = "Usuario Cadastrado com sucesso";

        // $dateTime = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
        // $formattedDate = $dateTime->format('Y-m-d H:i:s');

        // $username = $nameDB. $formattedDate;

        $usernameC = (md5($username));
        $userPasswordC = (md5($newPassword));
        // $userPasswordC = (md5($userPassword));

        $senhaDB = (md5($apikkey . $userPasswordC . $usernameC));
        //$hashDB = (md5($usernameC . $apikkey . $userPasswordC . $userEmailC));
        $hashDB = (md5($usernameC . $apikkey . $userPasswordC));

        $custSenha = '09';
        $custHash = '08';

        $saltSenha = $senhaDB;
        $saltHash = $hashDB;



        //Cript senha
        $senhaDB = crypt($usernameC, '$2b$' . $custSenha . '$' . $saltSenha . '$');

        //Cript Hash
        //$hashDB = crypt($usernameC, '$2b$' . $custHash . '$' . $saltHash . '$');
        $hashDB = crypt($usernameC, '$2b$' . $custHash . '$' . $saltHash . '$');


        $sql = "UPDATE tbl_login SET senha = '$senhaDB' AND hash = '$hashDB' WHERE nome = '$username'";

        $exc = $conn->query($sql);

        if ($exc) {
            $resp = "Usuario alterado com sucesso";
        } else {
            $resp = "Erro ao alterar usuario";
        }
    }
}

echo $resp;
