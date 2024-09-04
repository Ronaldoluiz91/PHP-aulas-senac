<?php
$namePage = "Recuperar Senha";
include("inc/head.inc.php");
?>

<main>
    <h1>Recuperação de Senha</h1>
    <span id="alertMsg"></span>
    <div id="form-recover-password">
        <label> Digite seu Usuario ou email</label>
        <br>
        <input type="text" name="user-login-email" id="user-login-email">
        <br>
        <input type="hidden" name="fxLogin" id="fxLogin" value="Recuperar">
        <button onclick="actLogin()">Recuperar</button>
        <br>
        <a href="index.php">Login</a> | <a href="add.new.user.php">Cadastrar usuario</a>
    </div>
</main>

<script>
    function actLogin() {
        var recLoginEmail = $('#user-login-email').val();
        var fxLogin = $('#fxLogin').val();

        if (!recLoginEmail) {
            $('#alertMsg').text('Por favor preencha o campo');
            $('#user-login-email').focus();
            return;
        }


        $.ajax({
            url: "<?= $urlPrivate ?>/model/Login.model.php",
            method: "POST",
            async: true,
            data: {
                recLoginEmail: recLoginEmail,
                fxLogin: fxLogin
            }
        })
    }
</script>

<?php
include("inc/footer.inc.php");
?>