<?php
//Criar este arquivo na pasta api add-new-user.php
$username = $_POST["user-name"];
$userEmail = $_POST["user-email"];
$userPassword = $_POST["user-password"];
$userConfirmPassword = $_POST["user-confirm-password"];

if (
    (empty($username)) || (empty($userEmail)) || (empty($userPassword)) || (empty($userConfirmPassword)) || ($username === "") || ($userEmail === "") || ($userPassword === "") || ($userConfirmPassword === "")
) {
    $resp = "ERRO - Algum campo está vazio";
    //exit
} else {

    include("../api/db/conn.php");

    //verificar se o email esta disponivel para cadastro
    $sql = "SELECT email FROM tbl_login WHERE email='$userEmail'";

    $exc = $conn->query($sql);

    $emailDB = "";

    if ($exc->num_rows > 0) {
        while ($row = $exc->fetch_assoc())
            $emailDB = $row["email"];
    }

    if ($emailDB === $userEmail) {
        $resp = "Email ja cadastrado";
        $conn->close();
    } else {
        $resp = "Email valido para cadastro !";

        //verificar se a senha e a sua confirmação de é restritamente igual
        if ($userPassword !== $userConfirmPassword) {
            $resp = "ERRO - a senha não combina com a confirmação de senha";
        } else {
            //criptografia se a senha e hash
            $apikkey = "manga";
            $apikkey = (md5($apikkey));

            $usernameC = (md5($username));
            $userEmailC = (md5($userEmail));
            $userPasswordC = (md5($userPassword));

            $senhaDB = (md5($apikkey . $userPasswordC . $userEmailC));
            $hashDB = (md5($usernameC . $apikkey . $userPasswordC));

            $custSenha = '09';
            $custHash = '08';

            $saltSenha = $senhaDB;
            $saltHash = $hashDB;

            //Cript senha
            $senhaDB = crypt($userEmail, '$2b$' . $custSenha . '$' . $saltSenha . '$');

            //Cript Hash
            $hashDB = crypt($usernameC, '$2b$' . $custHash . '$' . $saltHash . '$');
        }
    }
}

echo "<br>$resp";
