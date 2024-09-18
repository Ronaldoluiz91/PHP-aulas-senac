<?php
session_start();

if(!isset($_SESSION['loginValido']) || !$_SESSION['loginValido']){
    header("Location: index.php");
    exit();
}
//Configura a duração da sessão em 1min
$sessionLifeTime = 1 * 60;
$sessionStartTime = isset($_SESSION['start-time']) ? $_SESSION['start-time'] : time();

//Calcula o tempo restante da sessão
$timeRemaining = max(0, $sessionLifeTime - (time() - $sessionStartTime));

//Atualiza o tempo da sessão
$_SESSION['start-time'] = time();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard Client</title>
    <script>
    //Definir o tempo maximo da sessão 
    const
    </script>
</head>
<body>
    <h1>DashBoard Client</h1>
    <p>Usuario esta logado como: <?php
    echo htmlspecialchars($_SESSION['userLoginEmail']);
    ?> </p>
    <hr>
    <a href="logout.php">SAIR</a>
</body>
</html>