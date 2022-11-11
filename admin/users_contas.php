<?php
session_start();
require_once '../model/connect.php';
require_once '../model/dao/UsuariosDAO.php'; 

$user_id = $_SESSION['admin_id'];

if (!isset($user_id)) {
    $admin_header = 'admin_login.php';
    header('location:../admin/'.$admin_header);
}

if (isset($_GET['deletar'])) {
    UsuariosDAO::deletarCliente($_GET['deletar']);
    Redirect::page('../admin/users_contas.php', 0);
}
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
    <title>Contas de Usuários</title>
</head>
<body>

<?php require_once Path_Locale::admin_header(); ?>

<h1 class="head-list">Contas de Usuários</h1>
<section class="contas">
    <?php
        // $qry = ("SELECT * FROM `usuarios` WHERE codAdmin = 0 AND codCliente > 0");
        // $selecionar_usuarios = $pdo->prepare($qry);
        // // $selecionar_usuarios->bindParam(':', $codUsuarios);
        // $selecionar_usuarios->execute();
        // if ($selecionar_usuarios->rowCount() > 0) {
        // while ($fetch_contas = $selecionar_usuarios->fetch(PDO::FETCH_ASSOC)){
            $fetch_contas = UsuariosDAO::listarUsuariosTipo('cliente');
            if (count($fetch_contas) > 0) {
                foreach ($fetch_contas as $conta) {
            ?>
            <div class="gridbox">
                <div class="itemfield">
                    <span class="title">Usuário - ID</span>
                    <p class="box"><?php echo $conta['codUsuario']?></p>
                </div>
                <div class="itemfield">
                    <span class="title">Nome</span>
                    <p class="box"><?php echo $conta['nome']?></p>
                </div>
                <div class="itemfield">
                    <span class="title">Email</span>
                    <p class="box"><?php echo $conta['email']?></p>
                </div>
                <div class="flex-btn">
                    <a href="<?php echo $_SERVER['PHP_SELF'].'?deletar='.$conta['codCliente'];?>"
                    class="delete-btn" onclick="return confirm('Deseja excluir esta conta de Usuário?');"
                    >Deletar</a>
                    <!-- <a href="<php echo $_SERVER['PHP_SELF'].'?deletar='.$fetch_contas['codUsuario'];?>"
                    class="delete-btn" onclick="return confirm('Deseja excluir esta conta de Usuário?');"
                    >Deletar</a> -->
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
