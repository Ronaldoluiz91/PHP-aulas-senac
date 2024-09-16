<?php
    $namePage = "Recuperar senha";
    include("inc/head.inc.php");

$idRec = $_GET['idRec']
?>
<style>
    .error{color:red}
    .success{color:green} 
</style>
<main>
    <h1>Conheça nosso Streaming <?=$namePage?></h1>
    <span id="alertMsg"></span>
    <div id="form-user-login">
        <label>Usuário/Email</label><br>
        <input type="text" name="user-login-email" id="user-login-email"><br>
        <label>Senha</label><br>
        <input type="text" name="user-password" id="user-password"><br>
        <label>Confirmar Senha</label><br>
        <input type="text" name="user-confirm-password" id="user-confirm-password"><br>

        <input type="hidden" name="idRec" id="idRec" value="<?=$idRec?>">

        <input type="hidden" name="fxLogin" id="fxLogin" value="PasswordReset">
        <button type="button" onclick="actLogin()">Recuperar Senha</button>
    </div>
    <p>
        <a href="<?=$urlPublic?>/">Login</a> |
        <a href="<?=$urlPublic?>/login-register.php">Cadastrar usuário</a> 
    </p>
</main>
<script>
    function actLogin(){
        
        $('#alertMsg').html('');

        let fxLogin = $('#fxLogin').val();
        let userLoginEmail = $('#user-login-email').val();
        let userPassword = $('#user-password').val();
        let userConfirmPassword = $('#user-confirm-password').val();
        let idRec = $('#idRec').val();



        if((!userLoginEmail || !userPassword || !userConfirmPassword) || (!idRec)) {
            $('#alertMsg').html('<p>Usuário - Preencha o campo obrigatório!</p>');
            $('#alertMsg').addClass('error');
            $('#user-login-email').focus();
            return;
        }

        $.ajax({
            url:"<?=$urlPrivate?>/controller/Login.controller.php",
            method:"POST",
            async:true,
            data:{
                fxLogin:fxLogin,
                userLoginEmail:userLoginEmail,
                userPassword:userPassword,
                userConfirmPassword:userConfirmPassword,
                idRec: idRec
            }
        })

        .done(function(result){
            if(result['status']){
                //document.getElementById("alertMsg").innerHTML = result.msg;
                $('#alertMsg').removeClass("error");
                $('#alertMsg').html(result.msg).addClass("success");
            }else{
                $('#alertMsg').removeClass("success");
                $('#alertMsg').html(result.msg).addClass("error");
            }
        })
       

    }
</script>
<?php
    include("inc/footer.inc.php");
?>