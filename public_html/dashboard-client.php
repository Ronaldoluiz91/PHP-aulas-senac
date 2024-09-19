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
    const sessionLifeTime = <?=$sessionLifeTime?>

    //Criando variavel com o tempo restante
    var timeRemaining = <?=$timeRemaining?>

    //Função para atualizar o contador de tempo restante
    function updateTimeCount(){
        if(timeRemaining <= 0){
            document.getElementById('time-count').innerHTML = '<p>Sua sessão expirou</p>';
            //Redireciona para a pg Login
            window.location.href = 'index.php';
            return;
        }
        var minutes = Math.floor(timeRemaining / 60);
        var seconds = timeRemaining % 60;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        document.getElementById('time-count').innerHTML = `<p> tempo restante é : ${minutes} :${seconds}<p>`;
         //Diminuir o tempo restante a cada segundo
         timeRemaining--;
    } 
    //Atualiza o contador a cada segundo
    setInterval(updateTimeCount, 1000);
    //atualiza o contador imediatamente ao abrir a pagina
    window.onload = updateTimeCount;
    </script>
</head>
<body>
    <h1>DashBoard Client</h1>
    <p>Usuario esta logado como: <?php
    echo htmlspecialchars($_SESSION['userLoginEmail']);
    ?> </p>
    <span id="time-count"></span>
    <hr>
    <a href="logout.php">SAIR</a>
</body>
</html>