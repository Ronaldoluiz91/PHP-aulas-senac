<?php
$namePage = "Cadastrar usuário";
include("inc/head.inc.php");
?>

<main>
    <h1>Cadastro de Usuário </h1>
    <span id="alertMsg"></span>
    <div id="form-new-login">
        <label> Digite seu Usuario</label>
        <br>
        <input type="text" name="new-userLogin" id="new-userLogin">
        <br>
        <label>Digite seu email</label>
        <br>
        <input type="text" name="new-userEmail" id="new-userEmail">
        <br>
        <label> Digite sua senha</label>
        <br>
        <input type="text" name="user-password" id="user-password">
        <br>
        <label> Confirmação de senha</label>
        <br>
        <input type="text" name="confirmPassword" id="confirmPassword">
        <br>
        <input type="hidden" name="fxLogin" id="fxLogin" value="Cadastrar">
     
        <button onclick="actLogin()">Cadastrar</button>
        <hr>
    </div>

    <a href="recover.password.form.php">Recuperar senha</a> | <a href="index.php">Login</a>
</main>

<script>
    function actLogin() {
        var newUser = $('#new-userLogin').val();
        var newEmail = $('#new-userEmail').val();
        var userPassword = $('#user-password').val();
        var confirmPassword = $('#confirmPassword').val();
        var fxLogin = $('#fxLogin').val();

        if((!newUser) || (!newEmail) || (!userPassword) || (!confirmPassword)){
            $('#alertMsg').html('<h2>Por favor, preencha todos os campos</h2>');
            $('#userLoginEmail').focus();
            return;
        }

        $.ajax({
            url: "<?= $urlPrivate ?>/controller/Login.controller.php",
            method: "POST",
            async: true,
            data: {
               newUser: newUser,
               newEmail: newEmail,
               userPassword: userPassword,
               confirmPassword: confirmPassword,
               fxLogin: fxLogin
            }
        })

        .done(function(result) {
                if (result['status']) {
                    // document.getElementById("alertMsg").innerHTML = result.msg;
                    $('#alertMsg').removeClass("error");
                    $('#alertMsg').html(result.msg).addClass("sucess");
                } else {
                    $('#alertMsg').html(result.msg).addClass("error");

                }
            })
    }
</script>

<?php
include("inc/footer.inc.php");
?>