<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:../components/admin_header.php');
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <title>Login do Administrador - Intranet</title>
</head>
<body>

<?php include '../components/admin_header.php';?>

<section class="dashboard user-welcome">
    <div class="box">
        <h3>Bem Vindo!</h3>
        <p><?=$fetch_profile['nome'];?></p>
        <a href="admin/alterar_perfil.php" class="btn">Alterar Perfil</a>
    </div>
</section>

<section class="dashboard">
    <div class="box">
    <?php
        $total_pendings = 0;
        $qry = ("SELECT * FROM `pedidos` WHERE statusPagamento = ?");
        $select_pendings = $conn->prepare($qry);
        $select_pendings->execute(['pending']);
        while ($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)) {
            $total_pendings += fetch_pendings['total_preco'];
        }
        ?>
    <h3><span>R$ </span><?=$total_pendings;?><span> /-</span></h3>
    <p>Total Pendente</p>
    <a href="admin/pedidos.php" class="btn">Ver Pedidos</a>
    </div>

    <div class="box">
    <?php
        $total_pago = 0;
        $qry = ("SELECT * FROM `pedidos` WHERE statusPagamento = ?");
        $select_pago = $conn->prepare($qry);
        $select_pago->execute(['pago']);
        while ($fetch_pago = $select_pago->fetch(PDO::FETCH_ASSOC)) {
            $total_pago += fetch_pago['total_preco'];
        }
        ?>
    <h3><?=$total_pago;?><span> /-</span></h3>
    <p>Total a Pagar</p>
    <a href="admin/pedidos.php" class="btn">Ver Pagamentos</a>
    </div>
    
    <div class="box">
    <?php
        $total_produtos = 0;
        $qry = ("SELECT * FROM `produtos`");
        $select_produtos = $conn->prepare($qry);
        $select_produtos->execute();
        $num_produtos = $select_produtos->rowCount();
        ?>
    <h3><?= $num_produtos ;?><span> /-</span></h3>
    <p>Total de Produtos</p>
    <a href="admin/produtos.php" class="btn">Ver Produtos</a>
    </div>

    <div class="box">
    <?php
        $total_usuarios = 0;
        $qry = ("SELECT * FROM `usuarios`");
        $select_usuarios = $conn->prepare($qry);
        $select_usuarios->execute();
        $num_usuarios = $select_usuarios->rowCount();
        ?>
    <h3><?= $num_usuarios; ?><span> /-</span></h3>
    <p>Total de Usuários</p>
    <a href="admin/users_contas.php" class="btn">Ver Usuários</a>
    </div>

    <div class="box">
    <?php
        $total_admins = 0;
        $qry = ("SELECT * FROM `admins`");
        $select_admins = $conn->prepare($qry);
        $select_admins->execute();
        $num_admins = $select_admins->rowCount();
        ?>
    <h3><?=$total_admins;?><span> /-</span></h3>
    <p>Total de Admin's</p>
    <a href="admin/admin_contas.php" class="btn">Ver Admin's</a>
    </div>
    
    <div class="box">
    <?php
        $total_mensagens = 0;
        $qry = ("SELECT * FROM `mensagens`");
        $select_mensagens = $conn->prepare($qry);
        $select_mensagens->execute();
        $num_mensagens = $select_mensagens->rowCount();
        ?>
    <h3><?=$total_mensagens;?><span> /-</span></h3>
    <p>Total de Mensagens</p>
    <a href="admin/mensagens.php" class="btn">Ver Mensagens</a>
    </div>

</section>









<script src="../js/admin_script.js"></script>
</body>
</html>