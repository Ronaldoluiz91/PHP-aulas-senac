<?php
$userLoginEmail = $_POST["user-login-email"];
$userPassword = $_POST["user-password"];

if (((empty($userLoginEmail)) || $userLoginEmail === "") || ((empty($userPassword)) || $userPassword === "")) {
    $resp = "ERRO - algum campo esta vazio !";
} else {
    include("../db/conn.php");

    $sql = "SELECT * FROM tbl_login WHERE nome = '$userLoginEmail' OR email = '$userLoginEmail'";

    $exc = $conn->query($sql);

    if (!($exc->num_rows > 0)) {
        $resp = "ERRO - usuario ou senha invalida";
    } else {

        while ($row = $exc->fetch_assoc()) {
            $userEmail = $row ['email'];
            $DBpass = $row['senha'];
        }


        $apikkey = "manga";
        $apikkey = (md5($apikkey));


        $userEmailC = (md5($userEmail));
        $userPasswordC = (md5($userPassword));

        $senhaDB = (md5($apikkey . $userPasswordC . $userEmailC));



        $custSenha = '09';
        $saltSenha = $senhaDB;


        $senhaDB = crypt($userEmailC, '$2b$' . $custSenha . '$' . $saltSenha . '$');



        if (!($senhaDB == $DBpass)) {
            $resp = "ERRO - Usuário ou senha invalida!";
            $conn->close();
        } else {
            $resp = "Ok usuario ou email valido!";
            $conn->close();
        }
    }
}



echo $resp;
