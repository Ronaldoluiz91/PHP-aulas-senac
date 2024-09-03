<?php

include("../controller/Login.controller.php");
$LOGIN = new LOGIN();


$fxLogin = $_POST['fxLogin'];
// $cadUser = $_POST['fxCadUser'];


switch ($fxLogin) {
    case 'Logar';
        $userLoginEmail = $_POST['userLoginEmail'];
        $userPassword = $_POST['userPassword'];

        $LOGIN->setUserLoginEmail($userLoginEmail);
        $LOGIN->setUserPassword($userPassword);
    break;

    case 'Cadastrar';
        $newUser = $_POST['addNewUser'];
        $newEmail = $_POST['addNewEmail'];
        $userPassword = $_POST ['password'];
        $confirmPassword = $_POST['confirmPassword'];


        $LOGIN->setUserPassword($userPassword);
        $LOGIN->setNewUser($newUser);
        $LOGIN->setNewEmail($newEmail);
        $LOGIN->setConfirmPassword($confirmPassword);
break;

}



echo "<pre>";
var_dump($LOGIN);
echo "</pre>";
