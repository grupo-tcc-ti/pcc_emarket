<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message">
        <span>' . $message . '</span>
        <i class="fas fa-times" onclick = "this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<header class="header">

<section class="flex">
    
    <a href="dashboard.php" class="logo">Admin<span>Manager</span></a>
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
            $qry = "SELECT * FROM `admins` WHERE codAdmin = ?";
            $select_profile = $conn->prepare($qry);
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>
        <p><?= $fetch_profile['nome'];?></p>
        <a href="../admin/alterar_perfil.php" class="btn">Alterar Conta</a>
        <div class="flex-btn">
            <a href="../components/admin_logout.php" onclick="return confirm('Você deseja sair?');" class="option-btn">Login</a>
            <a href="../admin/registrar_admin.php" class="option-btn">Registrar</a>
        </div>
        <a href="../components/admin_logout.php" onclick="return confirm('Você realmente deseja sair?');" class="delete-btn">Logout</a>
    </div>

</section>

</header>

