<?php
include("../model/Login.model.php");

//Inicia uma sessão
session_start();

//Configura a durção da sessão em 1minuto
$sessionLifeTime = 1 * 60;
$sessionStartTime = isset($_SESSION['start-time']) ? $_SESSION['start-time'] : time();

//Verifica se a sessão expirou
if(time() - $sessionStartTime > $sessionLifeTime){
    //Se a sessão expirou, encerra a sessão
    session_unset();
    session_destroy();
    //Redefine a variavel de inicio de sessão
    $sessionStartTime = time();
}
//Atualiza o tempo da sessão
$_SESSION['start-time'] = time();

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

            //Validando o retorno com true e cria a sessão
             if($result['status']){
                //Criando a sessão com o login bem sucedido
                $_SESSION['userLoginEmail'] = $userLoginEmail;
                $_SESSION['loginValido'] = true;
                //Atualiza o tempo da sessão após o login bem sucedido
                $_SESSION['start-time'] = time();
             }
        }
        break;

    case 'Cadastrar':
        $newUser = $_POST['newUser'];
        $newEmail = $_POST['newEmail'];
        $userPassword = $_POST['userPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        if (
            !((!isset($newUser)) || (empty($newUser)) || ($newUser === "") ||
            (!isset($newEmail)) || (empty($newEmail)) || ($newEmail === "") ||
            (!isset($userPassword)) || (empty($userPassword)) || ($userPassword === "") ||
            (!isset($confirmPassword)) || (empty($confirmPassword)) || ($confirmPassword === ""))
        ) {

            if ($userPassword === $confirmPassword) {
                $LOGIN->setNewUser($newUser);
                $LOGIN->setNewEmail($newEmail);
                $LOGIN->setUserPassword($userPassword);

                $LOGIN->cadastroLogin($fxLogin);

                $result = $LOGIN->fxLogin;

            
            } else {
                $result = [
                    'status' => false,
                    'msg' => "<h2>Usuario- senhas não combinam be</h2>",
                    'userLogin' => $newUser,
                    'userEmail' => $newEmail,
                    'userPassword' => $userPassword,
                    'userConfirmPassword' => $confirmPassword
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
        
     if((!isset ($recLoginEmail)) || (empty ($recLoginEmail)) || ($recLoginEmail ===""))
     {
        $result = [
            'status'=> false,
            'msg'=> 'Preencha o campo'
        ];
     } else {
            $LOGIN->setUserLoginEmail($recLoginEmail);
            $LOGIN->recoveryLogin($fxLogin);

              $result = $LOGIN->fxLogin;
       }
        break;

        case 'PasswordReset':
         $userLoginEmail = $_POST['userLoginEmail'];
         $userPassword = $_POST['userPassword'];
         $userConfirmPassword = $_POST['userConfirmPassword'];
         $idRec = $_POST['idRec'];

         $LOGIN->setUserLoginEmail($userLoginEmail);
         $LOGIN->setUserPassword($userPassword);
         $LOGIN->setIdRec($idRec);

         $LOGIN->PasswordReset($fxLogin);

        $result = $LOGIN->fxLogin;
        
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
