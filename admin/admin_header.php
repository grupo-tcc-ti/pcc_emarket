<?php
// var_dump($_SERVER['HTTP_HOST'].''.$_SERVER['PHP_SELF']);
if (!isset($pdo)){
    require_once '../model/connect.php';
}
require_once '../model/dao/UsuariosDAO.php';
require_once '../model/dto/UsuariosDTO.php';

if(isset($_GET['logout'])) {
    Message::pop('Até a próxima!');
    include_once '../controller/admin_logoutControl.php';
    Redirect::page('admin_login.php', 2);
    exit();
}
?>

<header class="header">

<section class="flex">
    
    <a href="dashboard.php" class="logo">Admin<span>Dashboard</span></a>
    <div class="spacing"></div>
    <nav class="navbar">
        <a href="dashboard.php">Home</a>
        <a href="produtos.php">Produtos</a>
        <a href="pedidos.php">Pedidos</a>
        <a href="users_contas.php">Usuários</a>
        <a href="admin_contas.php">Administradores</a>
        <a href="mensagens.php">Mensagens</a>
    </nav>
    <div class="spacing"></div>
    <div class="icons">
        <div id="menu-btn" class="fas fa-bars"></div>
        <div id="user-btn" class="fas fa-user"></div>
    </div>

    <div class="profile">
        <?php
            // $qry = "SELECT * FROM `usuarios` WHERE codAdmin = :admin_id";
            // $selecionar_perfil = $pdo->prepare($qry);
            // $selecionar_perfil->bindParam(':admin_id', $user_id['id']);
            // $selecionar_perfil->execute();
            // $fetch_perfil = $selecionar_perfil->fetch(PDO::FETCH_ASSOC);
            $fetch_perfil = UsuariosDAO::getUserByID(
                $_SESSION['admin_id']['type'],
                $_SESSION['admin_id']['id']
            );
            ?>
        <p><?php echo $fetch_perfil['nome'];?></p>
        <a href="../admin/alterar_perfil.php" class="btn">Alterar Conta</a>
        <div class="flex-btn">
            <!-- <a href="../controller/admin_logoutControl.php" onclick="return confirm('Você deseja sair?');" class="option-btn">Login</a> -->
            <!-- <a href="<?php echo '?logout';?>" onclick="return confirm('Você deseja sair?');" class="option-btn">Login</a> -->
            <a href="../admin/registrar_admin.php" class="option-btn">Registrar</a>
        </div>
        <!-- <a href="../controller/admin_logoutControl.php" onclick="return confirm('Você realmente deseja sair?');" class="delete-btn">Logout</a> -->
        <a href="<?php echo '?logout';?>" onclick="return confirm('Você realmente deseja sair?');" class="delete-btn">Logout</a>
    </div>

</section>

</header>
