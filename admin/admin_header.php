<?php
set_include_path('../model');
// require_once '../model/dao/UsuariosDAO.php';
// require_once '../model/dto/UsuariosDTO.php';

$user_id = $_SESSION['admin_id'];
if (!isset($user_id)) {
    $admin_header = 'admin_login.php';
    header('location:../admin/' . $admin_header);
}

if (isset($_GET['adminlogout'])) {
    include_once '../controller/admin_logoutControl.php';
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
            $fetch_perfil = UsuariosDAO::getUserByID(
                $_SESSION['admin_id']['type'],
                $_SESSION['admin_id']['id']
            );
            ?>
            <p>
                <?php echo $fetch_perfil['nome']; ?>
            </p>
            <a href="../admin/alterar_perfil.php" class="btn">Alterar Conta</a>
            <div class="flex-btn">
                <a href="../admin/registrar_admin.php" class="option-btn">Registrar</a>
            </div>
            <a href="<?php echo '?adminlogout'; ?>" onclick="return confirm('Você realmente deseja sair?');"
                class="delete-btn">Logout</a>
        </div>

    </section>

</header>