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

        if (
            (isset($newUser)) || (empty($newUser)) || ($newUser === "") ||
            (isset($newEmail)) || (empty($newEmail)) || ($newEmail === "") ||
            (isset($userPassword)) || (empty($userPassword)) || ($userPassword === "") ||
            (isset($confirmPassword)) || (empty($confirmPassword)) || ($confirmPassword === "")
        ) {

            if ($userPassword === $confirmPassword) {
                $LOGIN->setNewUser($newUser);
                $LOGIN->setNewEmail($newEmail);
                $LOGIN->setUserPassword($userPassword);


                $result = [
                    'status' => true,
                    'msg' => "OK - as senhas combinam"
                ];
            } else {
                $result = [
                    'status' => false,
                    'msg' => "Usuario- senhas não combinam"
                ];
            }
        } else {
            $result = [
                'status' => false,
                'msg' => "Usuario- Preencha todos os campos"
            ];
        }
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

header('Content-Type: Application/json');
echo json_encode($result);

// echo "<pre>";
// var_dump($LOGIN);
// echo "</pre>";

// echo "<pre>";
// var_dump($result);
// echo "</pre>";
