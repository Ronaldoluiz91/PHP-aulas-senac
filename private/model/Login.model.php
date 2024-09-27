<?php
include_once('Crypt.model.php');
//Criando a classe de LOGIN
class LOGIN
{
    private $userLoginEmail;
    private $userPassword;
    private $newUser;
    private $newEmail;
    private $confirmPassword;
    private $idRec;

    // Métodos para email e senha de login
    public function setUserLoginEmail(String $userLoginEmail)
    {
        $this->userLoginEmail = $userLoginEmail;
    }
    public function getUserLoginEmail()
    {
        return $this->userLoginEmail;
    }

    public function setUserPassword(String $userPassword)
    {
        $this->userPassword = $userPassword;
    }
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    // Métodos para novo usuário e email 
    public function setNewUser(String $newUser)
    {
        $this->newUser = $newUser;
    }
    public function getNewUser()
    {
        return $this->newUser;
    }

    public function setNewEmail(String $newEmail)
    {
        $this->newEmail = $newEmail;
    }
    public function getNewEmail()
    {
        return $this->newEmail;
    }
    //CONFIRMAÇÃO DE SENHA NOVO USUARIO
    public function setConfirmPassword(String $confirmPassword)
    {
        $this->confirmPassword = $confirmPassword;
    }
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }
    //validando
    public function validateLogin(String $fxLogin)
    {
        require  "../config/db/conn.php";

        //Prepara o consulta SQL usando parametros do PDO
        $sql = "SELECT * FROM tbl_login WHERE nome= :userLogin OR email = :userEmail";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userLogin', $this->userLoginEmail);
        $stmt->bindParam(':userEmail', $this->userLoginEmail);
        $stmt->execute();

        $nameDB = "";
        $emailDB = "";
        $passwordDB = "";


        //Busca o resultado da consulta 
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $nameDB = $row['nome'];
            $emailDB = $row['email'];
            $passwordDB = $row['senha'];
            $idStatusDB = $row['FK_idStatus'];
            $idAclDB = $row['FK_idAcesso'];
        }

        $Crypt = new Crypt();

        $Cemail = $emailDB;
        $Cpass = $this->userPassword;

        $userPassword = $Crypt->CryptPass($Cemail, $Cpass);
        $userHash = $Crypt->CryptHash($Cemail, $Cpass);

        if (!(($emailDB === $this->userLoginEmail || $nameDB === $this->userLoginEmail) && ($passwordDB === $userPassword && ($idStatusDB == 2)))) {
            $result = [
                'status' => false,
                'msg' => "Usuario/email ou senha invalido",
                '$emailDB' => $emailDB,
                '$nameDB' => $nameDB,
                'senha sem criptografia' => $this->userPassword,
                'senha criptografada' => $userPassword,
                'senha banco' => $passwordDB,
                'hash criptografada' => $userHash,
            ];
        } else {
            $result = [
                'status' => true,
                'msg' => "Usuario valido",
                'dashboardClient' => 'http://localhost/tii06/projeto-streaming-tii06/public_html/dashboard.admin.php',
            ];
        }

        return $this->fxLogin = $result;
    }

    //Consultando se o usuario esta tentando cadastrar um nome ou email ja cadastrado no banco
    public function cadastroLogin(String $fxLogin)
    {
        require  "../config/db/conn.php";
        //Prepara o consulta SQL usando parametros do PDO
        $sql = "SELECT * FROM tbl_login WHERE nome= :userLogin OR email = :userEmail";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userLogin', $this->newUser);
        $stmt->bindParam(':userEmail', $this->newEmail);
        $stmt->execute();

        $nameDB = "";
        $emailDB = "";


        //Busca o resultado da consulta 
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $nameDB = $row['nome'];
            $emailDB = $row['email'];
        }

        if ($nameDB === $this->newUser || $emailDB === $this->newEmail) {
            $result = [
                'status' => false,
                'msg' => "Usuario/email ja cadastrado",
                '$emailDB' => $emailDB,
                '$nameDB' => $nameDB
            ];
        } else {

            include_once("Crypt.model.php");
            $Crypt = new Crypt();
            $Cpass = $this->userPassword;
            $Cemail = $emailDB;

            $passCP = $Crypt->CryptPass($Cemail, $Cpass);
            $hashCP = $Crypt->CryptHash($Cemail, $Cpass);

            $idAcl = 1;
            $idStatus = 2;

            $sql = "INSERT INTO tbl_login (nome, email, senha, FK_idStatus, FK_idAcesso, hash)
           VALUES (:nome, :email , :senha , :idStatus , :idAcesso, :hash) ";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome', $this->newUser);
            $stmt->bindParam(':email', $this->newEmail);
            $stmt->bindParam(':senha', $passCP);
            $stmt->bindParam(':hash', $hashCP);
            $stmt->bindParam(':idStatus', $idStatus);
            $stmt->bindParam(':idAcesso', $idAcl);
            $stmt->execute();

            $result = [
                'status' => true,
                'msg' => "Usuario/email cadastrado com sucesso",
                '$emailDB' => $emailDB,
                '$nameDB' => $nameDB
            ];
        }

        return $this->fxLogin = $result;
    }

    public function recoveryLogin(String $fxLogin)
    {
        require_once("../config/db/conn.php");

        $sql = "SELECT nome, email, hash FROM tbl_login WHERE email = :userEmail OR nome = :userName";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userEmail', $this->userLoginEmail);
        $stmt->bindParam(':userName', $this->userLoginEmail);

        $stmt->execute();

        $userEmailDB = "";

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $userEmailDB = $row['email'];
            $userHash = $row['hash'];
            $userNameDB = $row['nome'];
        }

        if (!(($userEmailDB === $this->userLoginEmail) || ($userNameDB === $this->userLoginEmail))) {
            $result = [
                'status' => false,
                'msg' => 'usuario ou email não cadastrado'
            ];
        } else {
            include("../config/global.php");

            $url = "$urlPublic/password-reset-form.php?idRec=$userHash";

            $result = [
                'status' => true,
                'msg' => "<h2>Recuperar Senha</h2>
                <p> Caro usuario $userNameDB , voce solicitou a recuperação de senha do Sistema</p>
                <p>Segue o link para recuperar a senha clique abaixo ou se preferir cole no seu navegador</p>
                <p><a href='$url' target='_blank'>$url<a/></p>
                <p>Caso não tenha solicitado, desconsidere este email</p> "
            ];
        }
        return $this->fxLogin = $result;
    }

    //Função para atualizar senha
    public function setIdRec(string $idRec)
    {
        $this->idRec = $idRec;
    }

    public function getIdRec()
    {
        return $this->idRec;
    }

    public function passwordReset(string $fxLogin)
    {
        require_once("../config/db/conn.php");

        $sql = "SELECT nome, email, hash FROM tbl_login WHERE email= :userEmail OR nome = :userName";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('userEmail', $this->userLoginEmail);
        $stmt->bindParam('userName', $this->userLoginEmail);
        $stmt->execute();

        $emailDB = "";
        $hashDB = "";

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $emailDB = $row['email'];
            $hashDB = $row['hash'];
            $nameDB = $row['nome'];
        }


        if (
            !((($emailDB === $this->userLoginEmail) || ($nameDB === $this->userLoginEmail))
                && ($hashDB === $this->idRec))
        ) {
            $result = [
                'status' => false,
                'msg' => 'Usuario/email ou seu idec invalido'
            ];
        } else {
            include_once("Crypt.model.php");
            $Crypt = new Crypt();
            $Cpass = $this->userPassword;
            $Cemail = $emailDB;

            $passCP = $Crypt->CryptPass($Cemail, $Cpass);
            $hashCP = $Crypt->CryptHash($Cemail, $Cpass);

            //Preparando update

            $sql = "UPDATE tbl_login SET senha = :passCP, hash = :hashCP WHERE email=:emailDB";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':passCP', $passCP);
            $stmt->bindParam(':hashCP', $hashCP);
            $stmt->bindParam(':emailDB', $emailDB);
            $stmt->execute();


            $result = [
                'status' => true,
                'msg' => 'Usúario sua senha foi alterada com sucesso'
            ];
        }

        return $this->fxLogin = $result;
    }
}
