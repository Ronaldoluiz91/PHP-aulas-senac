<?php


//Criando a classe de LOGIN

class LOGIN
{
    private $userLoginEmail;
    private $userPassword;
    // private $fxLogin;
    // private $fxCadUser;

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

    // public function setfxLogin($fxLogin)
    // {
    //     $this->fxLogin = $fxLogin;
    // }

    // public function getfxLogin()
    // {
    //     return $this->fxLogin;
    // }

    // public function setfxCadUser($fxCadUser){
    //     $this->fxCadUser = $fxCadUser;
    // }

    // public function getfxCadUser(){
    //     return $this->fxCadUser;
    // }
}











//$userLoginEmail
//$userPassword
