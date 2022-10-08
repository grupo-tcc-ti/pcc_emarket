<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location: admin_login.php');
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
    <title>Administrador - Intranet</title>
</head>
<body>

<?php include '../components/admin_header.php';?>

    <div class="box-main">
        <div class="heading-dash">
            <h1><span>i</span>DASH</h1><div class="hd-img"></div>
        </div>
        <section class="dashboard user-welcome">
                <div class="box-container">
                    <div class="box">
                        <h3>Bem Vindo!</h3>
                        <p><?=$fetch_perfil['nome'];?></p>
                        <!-- <p><?=$fetch_perfil['senha'];?></p> -->
                        <a href="alterar_perfil.php" class="btn">Alterar Perfil</a>
                    </div>
                </div>
        </section>

        <section class="dashboard">
        <div class="box-container">
            <div class="box">
            <?php
                $total_pendente = 0;
                $qry = ("SELECT * FROM `pedidos` WHERE statusPagamento = ?");
                $select_pendente = $conn->prepare($qry);
                $select_pendente->execute(['pending']);
                while ($fetch_pendente = $select_pendente->fetch(PDO::FETCH_ASSOC)) {
                    $total_pendente = $fetch_pendente['total_preco'];
                }
                ?>
            <h3>Total Pendente<span></span></h3>
            <p><?='<span>R$ </span>' . $total_pendente . ' /-';?></p>
            <a href="pedidos.php" class="btn">Ver Pedidos</a>
            </div>
            <div class="box">
            <?php
                $total_pago = 0;
                $qry = ("SELECT * FROM `pedidos` WHERE statusPagamento = ?");
                $select_pago = $conn->prepare($qry);
                $select_pago->execute(['pago']);
                while ($fetch_pago = $select_pago->fetch(PDO::FETCH_ASSOC)) {
                    $total_pago += $fetch_pago['total_preco'];
                }
                ?>
            <h3>Total a Pagar<span></span></h3>
            <p><?='<span>R$ </span>' . $total_pago . ' /-';?></p>
            <a href="pedidos.php" class="btn">Ver Pagamentos</a>
            </div>

            <div class="box">
            <?php
                $total_produtos = 0;
                $qry = ("SELECT * FROM `produtos`");
                $select_produtos = $conn->prepare($qry);
                $select_produtos->execute();
                $num_produtos = $select_produtos->rowCount();
                ?>
            <h3>Total de Produtos <span></span></h3>
            <p><?=$num_produtos . ' /-';?></p>
            <a href="produtos.php" class="btn">Ver Produtos</a>
            </div>
            <div class="box">
            <?php
                $total_usuarios = 0;
                $qry = ("SELECT * FROM `usuarios`");
                $select_usuarios = $conn->prepare($qry);
                $select_usuarios->execute();
                $num_usuarios = $select_usuarios->rowCount();
                ?>
            <h3>Total de Usuários <span></span></h3>
            <p><?=$num_usuarios . ' /-';?></p>
            <a href="users_contas.php" class="btn">Ver Usuários</a>
            </div>
            <div class="box">
            <?php
                $total_admins = 0;
                $qry = ("SELECT * FROM `admins`");
                $select_admins = $conn->prepare($qry);
                $select_admins->execute();
                $num_admins = $select_admins->rowCount();
                ?>
            <h3>Total de Admin<span>'s</span></h3>
            <p><?=$total_admins . ' /-';?></p>
            <a href="admin_contas.php" class="btn">Ver Admin's</a>
            </div>

            <div class="box">
            <?php
                $total_mensagens = 0;
                $qry = ("SELECT * FROM `mensagens`");
                $select_mensagens = $conn->prepare($qry);
                $select_mensagens->execute();
                $num_mensagens = $select_mensagens->rowCount();
                ?>
            <h3>Total de Mensagens<span></span></h3>
            <p><?=$total_mensagens . ' /-';?></p>
            <a href="mensagens.php" class="btn">Ver Mensagens</a>
            </div>
        </div>
    </section>
    </div>










<script src="../js/admin_script.js"></script>
</body>
</html>