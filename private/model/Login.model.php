<?php

//Criando a classe de LOGIN
class LOGIN
{
    private $userLoginEmail;
    private $userPassword;
    private $newUser;
    private $newEmail;
    private $confirmPassword;


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

        //Criptografia
        $apikey = "maçã";
        $apikey = (md5($apikey));

        $userEmailC = (md5($emailDB));
        $userPasswordC = (md5($this->userPassword));

        $passWordC = (md5($apikey . $userPasswordC . $userEmailC));

        $custPassword = "09";
        $saltPassword = $userPasswordC;

        $userPassword = crypt($userEmailC, '$2b$' . $custPassword . '$' . $saltPassword . '$');


        if (!(($emailDB === $this->userLoginEmail || $nameDB === $this->userLoginEmail) && ($passwordDB === $userPassword && ($idStatusDB == 2)))) {
            $result = [
                'status' => false,
                'msg' => "Usuario/email ou senha invalido",
                '$emailDB' => $emailDB,
                '$nameDB' => $nameDB,
                'senha sem criptografia' => $this->userPassword,
                'senha entrada' => $userPassword,
                'senha banco' => $passwordDB
            ];
        } else {
            $result = [
                'status' => true,
                'msg' => "Usuario valido",
                '$emailDB' => $emailDB,
                '$nameDB' => $nameDB,
                'senha sem criptografia' => $this->userPassword,
                'senha entrada' => $userPassword,
                'senha banco' => $passwordDB
            ];

            //Iniciar uma sessão
            session_start();
            $_SESSION['nickName'] = (string) $nameDB;
            $_SESSION['password'] = (string) $passwordDB;
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
            $result = [
                'status' => true,
                'msg' => "Usuario/email pode ser cadastrado",
                '$emailDB' => $emailDB,
                '$nameDB' => $nameDB
            ];
        }

        return $this->fxLogin = $result;
    }
}
