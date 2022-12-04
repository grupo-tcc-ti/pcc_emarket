<?php
session_start();
require_once '../model/connect.php';
// require_once '../model/dao/UsuariosDAO.php';
//undo requirefolder if fails!
File_Path::requireFolder('../model/dao');
File_Path::requireFolder('../model/dto');

if (isset($_GET['deletar'])) {
    UsuariosDAO::deletarCliente($_GET['deletar']);
    Redirect::page('../admin/users_contas.php', 1);
}
?>

<!DOCTYPE html>
<html lang="pt, en">

<head>
    <?php require_once File_Path::head(); ?>
    <link rel="stylesheet" href="../css/admin_stylesheet.css">
    <title>Contas de Usuários</title>
</head>

<body>

    <div class="header">
        <?php require_once File_Path::admin_header(); ?>
    </div>

    <h1 class="head-list">Contas de Usuários</h1>
    <section class="contas">
        <?php
        $fetch_contas = UsuariosDAO::listarUsuariosTipo('cliente');
        if (count($fetch_contas) > 0) {
            foreach ($fetch_contas as $conta) {
        ?>
        <div class="gridbox">
            <div class="itemfield">
                <span class="title">Usuário - ID</span>
                <p class="box">
                    <?php echo $conta['codUsuario'] ?>
                </p>
            </div>
            <div class="itemfield">
                <span class="title">Nome</span>
                <p class="box">
                    <?php echo $conta['nome'] ?>
                </p>
            </div>
            <div class="itemfield">
                <span class="title">Email</span>
                <p class="box">
                    <?php echo $conta['email'] ?>
                </p>
            </div>
            <div class="flex-btn">
                <a href="<?php echo $_SERVER['PHP_SELF'] . '?deletar=' . $conta['codCliente']; ?>" class="delete-btn"
                    onclick="return confirm('Deseja excluir esta conta de Usuário?');">Deletar</a>
            </div>
        </div>
        <?php

            }
        } else {
            echo '<p class="vazio">Nenhuma conta de Usuário encontrada!</span>';
        }
        ?>
    </section>

    <script src="../js/admin_script.js"></script>
</body>

</html>