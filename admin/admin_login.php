<?php
include '../model/connect.php';
session_start();

(empty($_SESSION['admin_id']))?:$admin_id = $_SESSION['admin_id'];

if (isset($admin_id)) {
    // echo print_r($_SESSION).':loggedin'; //debug
    $mensagem[] = 'Sua sessão já foi iniciada!';
    $mensagem[] = 'Voce está sendo redirecionado....';
    
    Redirect::page('dashboard.php');
}

include '../controller/admin_loginControl.php';

?>

<!DOCTYPE html>
<html lang="pt-BR, en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_stylesheet.css">
    <title>Login do Administrador - Intranet</title>
</head>
<body>


<?php
if (isset($mensagem)){
    foreach ($mensagem as $mensagem) {
        echo '
        <div class="mensagem">
        <span>'.$mensagem.'</span>
        <i class="fas fa-times" onclick = "this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>
<!-- Container do formulário de login do adminisrador -->

<section class="form-container">
    <form action="" method="post">
        <h3 class="heading">Credenciais de Login</h3>
        <p>Usuário de administrador predefinido: user = <span>admin</span> e senha <span>1234</span></p>
        <div class="flex">
        <div class="inputbox">
        <!-- <span class="title required-field">Usuario</span> -->
        <input type="text" name="usuario" class="box required-field" maxlength="20" required placeholder="Usuário*"
        oninput = "this.value = this.value.replace(/\s/g, '')" >
    </div>
        <div class="inputbox">
        <!-- <span class="title required-field">Senha</span> -->
        <input type="senha" name="senha" class="box required-field" maxlength="20" required placeholder="Senha*"
        oninput = "this.value = this.value.replace(/\s/g, '')" >
        </div>
        <input type="submit" value="Logar" class="btn" name="submit">
    </div>
    </form>
</section>

</body>
</html>