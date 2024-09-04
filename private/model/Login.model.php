<?php
include("../controller/Login.controller.php");


$LOGIN = new LOGIN();
$fxLogin = $_POST['fxLogin'];


switch ($fxLogin) {
    case 'Logar':
        $userLoginEmail = $_POST['userLoginEmail'];
        $userPassword = $_POST['userPassword'];

        $LOGIN->setUserLoginEmail($userLoginEmail);
        $LOGIN->setUserPassword($userPassword);
        break;

    case 'Cadastrar':
        $newUser = $_POST['newUser'];
        $newEmail = $_POST['newEmail'];
        $userPassword = $_POST['userPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        $LOGIN->setNewUser($newUser);
        $LOGIN->setNewEmail($newEmail);
        $LOGIN->setUserPassword($userPassword);
        $LOGIN->setConfirmPassword($confirmPassword);
        break;

        case 'Recuperar':
        $recLoginEmail = $_POST['recLoginEmail'];

        $LOGIN->setUserLoginEmail($recLoginEmail);
        break;

    default:
        echo "Ação desconhecida.";
        break;
}


echo "<pre>";
var_dump($LOGIN);
echo "</pre>";
