<?php
session_start();
require_once '../model/connect.php';
// require_once '../model/dao/UsuariosDAO.php';

//undo requirefolder if fails!
File_Path::requireFolder('../model/dao');
File_Path::requireFolder('../model/dto');

if (isset($_GET['deletar'])) {
    UsuariosDAO::deletarAdmin($_GET['deletar']);
    Redirect::page('admin_contas.php', 0);
}
?>

<!DOCTYPE html>
<html lang="pt, en">
<head>
    <?php require_once File_Path::head(); ?>
    <link rel="stylesheet" href="../css/admin_stylesheet.css">
    <title>Contas de Administradores</title>
</head>
<body>
    <div class="header">
        <?php require_once File_Path::admin_header(); ?>
    </div>

    <section class="contas register-admin">
        <div class="gridbox">
            <div class="itemfield">
                <span class="title">Adicionar novo Administador</span>
                <a href="registrar_admin.php" class="option-btn">Registrar Administrador</a>
            </div>
        </div>
    </section>

    <section class="contas">
        <?php
        //     $qry = "SELECT * FROM `usuarios` WHERE codAdmin > 0 AND codCliente = 0";
        //     $selecionar_contas = $pdo->prepare($qry);
        //     $selecionar_contas->execute();
        // if($selecionar_contas->rowCount() > 0) {
        //     while ($fetch_contas = $selecionar_contas->fetch(PDO::FETCH_ASSOC)) {
        $fetch_contas = UsuariosDAO::listarUsuariosTipo('admin');
        if (count($fetch_contas) > 0) {
            foreach ($fetch_contas as $fetch_contas) {
                ?>
        <div class="gridbox">
        <div class="itemfield">
            <span class="title">Admin - ID : </span>
            <p class="box"><?php echo $fetch_contas['codAdmin'];?></p> 
        </div>
        <div class="itemfield">
            <span class="title">Admin - Nome : </span>
            <p class="box"><?php echo $fetch_contas['nome'];?></p>
        </div>
            <div class="flex-btn">
                <?php if ($fetch_contas['codAdmin'] == $_SESSION['admin_id']['id']) {
                        $_POST['alterar'] = $fetch_contas['codAdmin'];
                        echo '<a href="alterar_perfil.php" class="option-btn"
                    onclick="return confirm(`Deseja fazer alterações nesta Conta?`)">Alterar</a>';
                }
                ?>
                <a href="<?php echo $_SERVER['PHP_SELF'].'?deletar='.$fetch_contas['codAdmin'];?>" class="delete-btn"
                onclick="send(this.form);  return confirm(`Deseja deletar esta conta Admin?`);"
                >Deletar</a>
            </div>
        </div>
                <?php
                // send(this.form); 
            }
        } else {
            echo '<p class="vazio">Nenhum conta de Administrador encontrada!</span>';
        }
        ?>
    </section>
    


<script src="../js/admin_script.js"></script>
</body>
</html>
