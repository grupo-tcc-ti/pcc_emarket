<?php
session_start();
require_once '../model/connect.php';

// (empty($_SESSION['admin_id']))?
// ''
// :$user_id = $_SESSION['admin_id'];

(isset($_SESSION['admin_id']))?
$user_id = $_SESSION['admin_id']:'';
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
require_once '../controller/admin_loginControl.php';

if (isset($user_id)) {
    // echo print_r($_SESSION).':loggedin'; //debug
    Message::pop('Sua sessão já foi iniciada!');
    Message::pop('Voce está sendo redirecionado....');
    Redirect::page('dashboard.php', 2);
}
?>
<!-- Container do formulário de login do adminisrador -->

<section class="form-container">
    <!-- <form action='../controller/admin_loginControl.php' method="POST"> -->
    <form method="POST">
        <h3 class="heading">Credenciais de Login</h3>
        <!-- <p>Usuário de administrador predefinido: </p>
            <p>user = <span>admin</span> e</p>
            <p>senha <span>1234</span></p> -->
        <div class="flex">
        <div class="inputbox">
        <!-- <span class="title required-field">Usuario</span> -->
        <input type="text" name="usuario" class="box required-field" maxlength="20" required placeholder="Usuário*"
        oninput = "this.value = this.value.replace(/\s/g, '')" value="admin">
    </div>
        <div class="inputbox">
        <!-- <span class="title required-field">Senha</span> -->
        <input type="password" name="senha" class="box required-field" maxlength="20" required placeholder="Senha*"
        oninput = "this.value = this.value.replace(/\s/g, '')" value="1234"><!-- Tirar value 1234 -->
        </div>
        <input type="submit" value="Logar" class="btn" name="submit">
    </div>
    </form>
</section>

</body>
</html>
