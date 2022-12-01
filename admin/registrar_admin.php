<?php
session_start();
require_once '../model/connect.php';
// require_once '../model/dao/UsuariosDAO.php';
//undo requirefolder if fails!
File_Path::requireFolder('../model/dao');
File_Path::requireFolder('../model/dto');
?>

<!DOCTYPE html>
<html lang="pt, en">

<head>
    <?php require_once File_Path::head(); ?>
    <link rel="stylesheet" href="../css/admin_stylesheet.css">
    <title>Registrar Conta de Administrador</title>
</head>

<body>

    <?php require_once '../controller/registerControl.php'; ?>

    <div class="header"><?php require_once File_Path::admin_header(); ?></div>

    <section class="form-container">
        <form action="" method="post">
            <!-- <form action="../controller/registerControl.php" method="post"> -->
            <h3 class="heading">Criar Nova Conta - Administrador</h3><br><br><br>
            <input type="hidden" name="usertype" value="admin">
            <div class="flex">
                <div class="inputbox">
                    <span class="title required-field">Usuário</span>
                    <input type="text" name="nome" class="box" maxlength="255" required
                        placeholder="Digite o nome do Usuário" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <div class="inputbox">
                    <span class="title required-field">Email</span>
                    <input type="email" name="email" class="box" maxlength="255" required
                        placeholder="Insira um email válido" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <div class="inputbox">
                    <span class="title required-field">Senha</span>
                    <input type="password" name="senha" class="box" maxlength="50" required placeholder="Digite a Senha"
                        oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <div class="inputbox">
                    <span class="title required-field">Confirme a Senha</span>
                    <input type="password" name="rsenha" class="box" maxlength="50" required
                        placeholder="Confirme a senha" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <input type="submit" value="Cadastrar" class="btn" name="register">
            </div>
        </form>
    </section>




















    <script src="../js/admin_script.js"></script>
</body>

</html>