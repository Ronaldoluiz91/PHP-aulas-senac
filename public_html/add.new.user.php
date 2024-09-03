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
        <input type="text" name="add-newUser" id="add-newUser">
        <br>
        <label>Digite seu email</label>
        <br>
        <input type="text" name="add-newEmail" id="add-newEmail">
        <br>
        <label> Digite sua senha</label>
        <br>
        <input type="text" name="add-newPassword" id="add-newPassword">
        <br>
        <label> Confirmação de senha</label>
        <br>
        <input type="text" name="confirm-add-newPassword" id="confirm-add-newPassword">
        <br>
        <input type="hidden" name="fxLogin" id="fxLogin" value="Cadastrar">
     
        <button onclick="cadUser()">Cadastrar</button>
        <hr>
    </div>

    <a href="#">Recuperar senha</a> | <a href="index.php">Login</a>
</main>

<script>
    function cadUser() {
        var newUser = $('#add-newUser').val();
        var newEmail = $('#add-newEmail').val();
        var password = $('#add-newPassword').val();
        var confirmPassword = $('#confirm-add-newPassword').val();
        var fxLogin = $('#fxLogin').val();

        if((!newUser) || (!newEmail) || (!password) || (!confirmPassword)){
            $('#alertMsg').text('Por favor, preencha todos os campos');
            $('#add-newUser').focus();
            return;
        }

        $.ajax({
            url: "<?= $urlPrivate ?>/model/Login.model.php",
            method: "POST",
            async: true,
            data: {
               newUser: newUser,
               newEmail: newEmail,
               password: password,
               confirmPassword: confirmPassword
            }
        })
    }
</script>

<?php
include("inc/footer.inc.php");
?>