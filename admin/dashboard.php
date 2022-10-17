<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    $admin_header = 'admin_header.php';
    header('location:../components/'.$admin_header);
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

    <div class="heading-dash">
        <h1><span>i</span>DASH</h1><div class="hd-img"></div>
    </div>

    <section class="dashboard user-welcome">
        <div class="box">
            <h3>Bem Vindo!</h3>
            <p><?=$fetch_perfil['nome'];?></p>
            <!-- <p><?=$fetch_perfil['senha'];?></p> -->
            <a href="alterar_perfil.php" class="btn">Alterar Perfil</a>
        </div>
    </section>

    <section class="dashboard">
        <div class="box">
        <?php
            // $qry = ("SELECT * FROM `pedidos` WHERE statusPagamento = ?");
            // $select_pendente = $conn->prepare($qry);
            // $select_pendente->execute(['pendente']);
            $qry = ("SELECT * FROM `pedidos` WHERE statusPagamento = :status");
            $select_pendente = $conn->prepare($qry);
            $select_pendente->bindValue(':status', 'pendente');
            $select_pendente->execute();
            $total_pendente = 0;
            while ($fetch_pendente = $select_pendente->fetch(PDO::FETCH_ASSOC)) {
                $total_pendente += $fetch_pendente['totalPreco'];
            }
        ?>
        <h3>Total Pendente<span></span></h3>
        <p><?='<span>R$ </span>' . $total_pendente . ' /-';?></p>
        <a href="pedidos.php" class="btn">Ver Pedidos</a>
        </div>

        <div class="box">
        <?php
            // $qry = ("SELECT * FROM `pedidos` WHERE statusPagamento = ?");
            // $select_pago = $conn->prepare($qry);
            // $select_pago->execute(['pago']);
            $qry = ("SELECT * FROM `pedidos` WHERE statusPagamento = :status");
            $select_pago = $conn->prepare($qry);
            $select_pago->bindValue(':status', 'pago');
            $select_pago->execute();
            $total_pago = 0;
            while ($fetch_pago = $select_pago->fetch(PDO::FETCH_ASSOC)) {
                $total_pago += $fetch_pago['totalPreco'];
            }
        ?>
        <h3>Total a Pagar<span></span></h3>
        <p><?='<span>R$ </span>' . $total_pago . ' /-';?></p>
        <a href="pedidos.php" class="btn">Ver Pagamentos</a>
        </div>

        <div class="box">
        <?php
            // $qry = ("SELECT * FROM `pedidos` WHERE statusPagamento = ?");
            // $select_pago = $conn->prepare($qry);
            // $select_pago->execute(['pago']);
            $qry = ("SELECT * FROM `pedidos` WHERE statusPagamento = :status");
            $select_cancelado = $conn->prepare($qry);
            $select_cancelado->bindValue(':status', 'cancelado');
            $select_cancelado->execute();
            $total_cancelado = 0;
            while ($fetch_cancelado = $select_cancelado->fetch(PDO::FETCH_ASSOC)) {
                $total_cancelado += $fetch_cancelado['totalPreco'];
            }
        ?>
        <h3>Total Cancelado<span></span></h3>
        <p><?='<span>R$ </span>' . $total_cancelado . ' /-';?></p>
        <a href="pedidos.php" class="btn">Ver Pagamentos</a>
        </div>

        <div class="box">
        <?php
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
            $qry = ("SELECT * FROM `admins`");
            $select_admins = $conn->prepare($qry);
            $select_admins->execute();
            $num_admins = $select_admins->rowCount();
        ?>
        <h3>Total de Admin<span>'s</span></h3>
        <p><?=$num_admins . ' /-';?></p>
        <a href="admin_contas.php" class="btn">Ver Admin's</a>
        </div>

        <!-- <div class="box">
        <?php
            $qry = ("SELECT * FROM `mensagens`");
            $select_mensagens = $conn->prepare($qry);
            $select_mensagens->execute();
            $num_mensagens = $select_mensagens->rowCount();
        ?>
        <h3>Total de Mensagens<span></span></h3>
        <p><?=$num_mensagens . ' /-';?></p>
        <a href="mensagens.php" class="btn">Ver Mensagens</a>
        </div> -->
    </section>










<script src="../js/admin_script.js"></script>
</body>
</html>