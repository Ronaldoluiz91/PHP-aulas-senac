<?php
$namePage = "Entre e curta";
include("inc/head.inc.php");
?>
<main>
    <h1>Conheça nosso Streaming <?= $namePage ?></h1>
    <span id="alertMsg"></span>
    <div id="form-user-login">
        <label>Usuario/Email</label>
        <br>
        <input type="text" name="user-login-email" id="user-login-email" placeholder="Digite seu usuario ou email">
        <br>
        <label>Senha</label>
        <br>
        <input type="text" name="user-password" id="user-password" placeholder="Digite sua senha">
        <br>
        <input type="hidden" name="fxLogin" id="fxLogin" value="Logar">
        <button onclick="actLogin()">Entrar</button>
        <hr>
    </div>

    <a href="recover.password.form.php">Recuperar senha</a> | <a href="add.new.user.php">Cadastrar usuario</a>
</main>

<script>
    function actLogin() {
        var userLoginEmail = $('#user-login-email').val();
        var userPassword = $('#user-password').val();
        var fxLogin = $('#fxLogin').val();

        if ((!userLoginEmail) || (!userPassword)) {
            $('#alertMsg').text('Por favor, preencha todos os campos');
            $('#user-login-email').focus();
            return;
        }

        $.ajax({
                url: "<?= $urlPrivate ?>/controller/Login.controller.php",
                method: "POST",
                async: true,
                data: {
                    userLoginEmail: userLoginEmail,
                    userPassword: userPassword,
                    fxLogin: fxLogin
                }
            })

            .done(function(result) {
                if (result['status']) {
                    // document.getElementById("alertMsg").innerHTML = result.msg;
                    $('#alertMsg').removeClass("error");
                    $('#alertMsg').html(result.msg).addClass("sucess");
                    window.location.href = result.dashboardClient;
                } else {
                    $('#alertMsg').html(result.msg).addClass("error");

                }
            })
    }
</script>

<?php
include("inc/footer.inc.php");
?>