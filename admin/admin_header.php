<?php
if (!isset($pdo)) {
    include_once '../model/connect.php';
    //undo requirefolder if fails!
    File_Path::requireFolder('../model/dao');
    File_Path::requireFolder('../model/dto');
}

$user_id = $_SESSION['admin_id'];
if (!isset($user_id)) {
    $admin_header = 'admin_login.php';
    header('location:../admin/' . $admin_header);
}

if (isset($_GET['adminlogout'])) {
    include_once '../controller/logoutControl.php';
}
?>

<header class="container">

    <section class="flex">

        <a href="dashboard.php" class="logo">Admin<span>Dashboard</span></a>
        <nav class="navbar">
            <a href="dashboard.php">Home</a>
            <a href="produtos.php">Produtos</a>
            <a href="pedidos.php">Pedidos</a>
            <a href="users_contas.php">Usuários</a>
            <a href="admin_contas.php">Administradores</a>
            <!-- <a href="mensagens.php">Mensagens</a> -->
        </nav>
        <div class="icons">
            <!-- <div id="menu-btn" class="fas fa-bars"> -->
            <button type="button" id="menu-btn">
                <i class="fas fa-bars"></i>
            </button>
            <!-- <div id="user-btn" class="fas fa-user"> -->
            <button type="button" id="user-btn">
                <i class="fas fa-user"></i>
            </button>
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