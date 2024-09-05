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

    public function validateLogin(String $fxLogin){
    require  "../config/db/conn.php";

    //Prepara o consulta SQL usando parametros do PDO
     $sql = "SELECT * FROM tbl_login WHERE nome= :userLogin OR email = :userEmail";
     $stmt = $conn->prepare($sql);
$stmt->bindParm(':userLogin' , $this->userLoginEmail);
$stmt->bindParm(':userEmail' , $this->userLoginEmail);
$stmt->execulte();

$nameDB = "";
$emailDB = "";
$passwordDB ="";

//Busca o resultado da consulta 
if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $nameDB = $row['nome'];
    $emailDB = $row['email'];
    $passwordDB = $row['senha']
    $idStatusDB = $row['idStatus'];
    $idAclDB = $row['idAcesso'];

}


        $result=[
            'status' => true,
            'msg' => "Usuario valido"
        ];
        //return $this->fxLogin = "ok";
        return $this->fxLogin = $result;
    }

    
}

?>
