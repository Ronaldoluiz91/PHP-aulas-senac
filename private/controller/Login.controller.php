<?php
include("../model/Login.model.php");

//header('Content-Type: Application/json');


$LOGIN = new LOGIN();
$fxLogin = $_POST['fxLogin'];


switch ($fxLogin) {
    case 'Logar':
        $userLoginEmail = $_POST['userLoginEmail'];
        $userPassword = $_POST['userPassword'];

        if ((!((isset($userLoginEmail)) ||  (empty($userLoginEmail)) || ($userLoginEmail === "")))  ||
            (!((isset($userPassword)) || (empty($userPassword)) || ($userPassword === "")))
        ) {
            $result = [
                'status' => false,
                'msg' => "Usuario- Preencha todos os campos"
            ];
        } else {

            $LOGIN->setUserLoginEmail($userLoginEmail);
            $LOGIN->setUserPassword($userPassword);

            $LOGIN->validateLogin($fxLogin);

            $result = $LOGIN->fxLogin;
        }
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
        $result = [
            'status' => false,
            'msg' => " <p>Sistema indisponivel. Tente mais tarde... </p>"
        ];
        break;
}

// echo json_encode($result);

echo "<pre>";
var_dump($LOGIN);
echo "</pre>";

echo "<pre>";
var_dump($result);
echo "</pre>";
