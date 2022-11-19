<?php
session_start();
require_once '../model/connect.php';
require_once '../model/dao/UsuariosDAO.php';

if (isset($_GET['deletar'])) {
    UsuariosDAO::deletarCliente($_GET['deletar']);
    Redirect::page('../admin/users_contas.php', 0);
}
require_once Path_Locale::admin_header();
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
    <title>Contas de Usuários</title>
</head>

<body>

    <!-- <php require_once Path_Locale::admin_header(); ?> -->

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