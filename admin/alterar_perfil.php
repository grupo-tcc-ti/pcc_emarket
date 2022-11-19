<?php
session_start();
require_once '../model/connect.php';
require_once '../model/dao/UsuariosDAO.php';
require_once '../model/dto/UsuariosDTO.php';
require_once Path_Locale::admin_header();
$uid = str_replace('"', "'", json_encode($_SESSION['admin_id']));
?>

<!DOCTYPE html>
<html lang="pt, en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_stylesheet.css">
    <title>Alterar Perfil - Administrador</title>
</head>

<body>

    <?php

    require_once '../controller/updateUserControl.php';
    ?>

    <section class="form-container">
        <form action="" method="post">
            <input type="hidden" name="user_id" value="<?php echo str_replace('"', "'", json_encode($_SESSION['admin_id'])); ?>">
            <h3 class="heading">Alterar Perfil - Administrador</h3><br><br><br>
            <div class="flex">
                <div class="inputbox">
                    <span class="title required-field">Usuario</span>
                    <!-- <input type="text" name="usuario" class="inputbox" maxlength="20" placeholder="Usuário" required -->
                    <input type="text" name="usuario" class="box" maxlength="20" placeholder="Usuário" required
                        oninput="this.value = this.value.replace(/\s/g, '')"
                        value="<?php echo $fetch_perfil['nome']; ?>">
                </div>
                <div class="inputbox">
                    <span class="title required-field">Senha Anterior</span>
                    <!-- <input type="password" name="senha_antiga" class="inputbox" maxlength="20" placeholder="Digite a Senha Anterior"  -->
                    <input type="password" name="senha_atual" class="box" maxlength="20"
                        placeholder="Digite a Senha Anterior" oninput="this.value = this.value.replace(/\s/g, '' )"
                        value="1234">
                </div>
                <div class="inputbox">
                    <span class="title required-field">Nova Senha</span>
                    <!-- <input type="password" name="nova_senha" class="inputbox" maxlength="20" placeholder="Digite a Nova Senha"  -->
                    <input type="password" name="senha_nova" class="box" maxlength="20"
                        placeholder="Digite a Nova Senha" oninput="this.value = this.value.replace(/\s/g, '' )"
                        value="4321">
                </div>
                <div class="inputbox">
                    <span class="title required-field">Repita a Nova Senha</span>
                    <!-- <input type="password" name="rnova_senha" class="inputbox" maxlength="20" placeholder="Repita a sua Nova Senha"  -->
                    <input type="password" name="senha_confirma" class="box" maxlength="20"
                        placeholder="Repita a sua Nova Senha" oninput="this.value = this.value.replace(/\s/g, '' )"
                        value="4321">
                </div>
                <input type="submit" value="Alterar" class="btn" name="submit">
            </div>
        </form>
    </section>

    <script src="../js/admin_script.js"></script>
</body>

</html>