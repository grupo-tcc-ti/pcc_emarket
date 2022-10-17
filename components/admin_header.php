<?php
if (isset($mensagem)) {
    foreach ($mensagem as $mensagem) {
        echo '
        <div class="mensagem">
        <span>' . $mensagem . '</span>
        <i class="fas fa-times" onclick = "this.parentElement.remove();"></i>
        </div>
        ';
    }
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
            $qry = "SELECT * FROM `admins` WHERE codAdmin = :admin_id";
            $selecionar_perfil = $conn->prepare($qry);
            $selecionar_perfil->bindParam(':admin_id', $admin_id);
            $selecionar_perfil->execute();
            $fetch_perfil = $selecionar_perfil->fetch(PDO::FETCH_ASSOC);
        ?>
        <p><?= $fetch_perfil['nome'];?></p>
        <a href="../admin/alterar_perfil.php" class="btn">Alterar Conta</a>
        <div class="flex-btn">
            <a href="../components/admin_logout.php" onclick="return confirm('Você deseja sair?');" class="option-btn">Login</a>
            <a href="../admin/registrar_admin.php" class="option-btn">Registrar</a>
        </div>
        <a href="../components/admin_logout.php" onclick="return confirm('Você realmente deseja sair?');" class="delete-btn">Logout</a>
    </div>

</section>

</header>

