<?php
include("../db/conn.php");

$username = $_POST["user-name-email"];
$userPassword = $_POST["new-password"];
$confirmPassword = $_POST["confirm-new-password"];
$hash = $_POST["hash"];

$hashRec = "";
// $emailRec ="";
// $nomeRec ="";


// echo $userPassword;
if (
    (empty($username)) || (empty($userPassword)) || (empty($confirmPassword)) || ($username === "") || ($userPassword === "") || ($confirmPassword === "")
) {
    $resp = "ERRO - Algum campo está vazio";
} else {

    $sql = "SELECT hash, email, nome FROM tbl_login WHERE nome='$username' OR email='$username'";

    $exc = $conn->query($sql);

    if ($exc->num_rows === 0) {
        $resp = "Erro na consulta";
    } else {
        $row = $exc->fetch_assoc();
        $hashRec = $row["hash"];
        $nomeRec =$row["nome"];
        $emailRec = $row["email"];


        if ($hash !== $hashRec) {
            $resp = "ERRO - idRec invalido";
        } else {
            if ($userPassword !== $confirmPassword) {
                $resp = "ERRO - as senhas não combinam";
            } else {
                //criptografia se a senha e hash
            $apikkey = "manga";
            $apikkey = (md5($apikkey));

            $dateTime = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
            $formattedDate = $dateTime->format('Y-m-d H:i:s');

            $nomeRec = $nomeRec . $formattedDate;
           

            $usernameC = (md5($nomeRec));
            $userEmailC = (md5($emailRec));
            $userPasswordC = (md5($userPassword));

            $senhaDB = (md5($apikkey . $userPasswordC . $userEmailC));
            //$hashDB = (md5($usernameC . $apikkey . $userPasswordC . $userEmailC));
            $hashDB = (md5($usernameC . $apikkey . $userPasswordC));

            $custSenha = '09';
            $custHash = '08';

            $saltSenha = $senhaDB;
            $saltHash = $hashDB;

           

            //Cript senha
            $senhaDB = crypt($userEmailC, '$2b$' . $custSenha . '$' . $saltSenha . '$');

            //Cript Hash
            //$hashDB = crypt($usernameC, '$2b$' . $custHash . '$' . $saltHash . '$');
            $hashDB = crypt($nomeRec, '$2b$' . $custHash . '$' . $saltHash . '$');
 

                $sql = "UPDATE tbl_login SET senha = '$senhaDB' , hash = '$hashDB' WHERE nome = '$username' OR email= '$username'";

                $exc = $conn->query($sql);

                if ($exc) {
                    $resp = "Usuario alterado com sucesso";
                } else {
                    $resp = "Erro ao alterar usuario";
                }
               
            }
        }
    }
}
$conn->close();

echo $resp;
