<?php
session_start();
require_once '../model/connect.php';
?>

<!DOCTYPE html>
<html lang="pt, en">

<head>
    <?php require_once File_Path::head(); ?>
    <link rel="stylesheet" href="../css/admin_stylesheet.css">
    <title>Login do Administrador - Intranet</title>
</head>

<body>


    <?php
    if (isset($_SESSION['admin_id'])) {
        // echo print_r($_SESSION).':loggedin'; //debug
        Message::pop('Sua sessão já foi iniciada!');
        Message::pop('Voce está sendo redirecionado....');
        Redirect::page('dashboard.php', 2);
    }
    require_once '../controller/loginControl.php';
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
                    <input type="text" name="usuario" class="box required-field" maxlength="20" required
                        placeholder="Usuário*" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <div class="inputbox">
                    <!-- <span class="title required-field">Senha</span> -->
                    <input type="password" name="senha" class="box required-field" maxlength="20" required
                        placeholder="Senha*" oninput="this.value = this.value.replace(/\s/g, '')">
                    <!-- Tirar value 1234 -->
                </div>
                <input type="submit" value="Logar" class="btn" name="login">
            </div>
        </form>
    </section>
    <script src="../js/script.js"></script>
</body>

</html>