<?php
session_start();
require_once '../model/connect.php';
// require_once '../model/dao/UsuariosDAO.php';
// require_once '../model/dto/UsuariosDTO.php';
//undo requirefolder if fails!
File_Path::requireFolder('../model/dao');
File_Path::requireFolder('../model/dto');
require_once '../controller/updateUserControl.php';
?>

<!DOCTYPE html>
<html lang="pt, en">

<head>
    <?php require_once File_Path::head(); ?>
    <link rel="stylesheet" href="../css/admin_stylesheet.css">
    <title>Alterar Perfil - Administrador</title>
</head>

<body>
    <div class="header">
        <?php require_once File_Path::admin_header(); ?>
    </div>
    <section class="form-container">
        <form action="" method="post">
            <input type="hidden" name="admin_id" wfd-invisible="true" />
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