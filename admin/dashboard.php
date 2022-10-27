<?php
include '../model/connect.php';
include '../model/dao/PedidosDAO.php';
include '../model/dao/ProdutosDAO.php';
include '../model/dao/UsuariosDAO.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    $admin_header = 'admin_login.php';
    header('location:../admin/'.$admin_header);
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

<?php include Admin_Header::component();?>

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
            $total_pendente = 0;
            foreach (PedidosDAO::ListarPedidos('pendente') as $pedido){
                $total_pendente += $pedido['totalPreco'];
            }
        ?>
        <h3>Total Pendente<span></span></h3>
        <p><?='<span>R$ </span>' . $total_pendente . ' /-';?></p>
        <a href="pedidos.php" class="btn">Ver Pedidos</a>
        </div>

        <div class="box">
        <?php
            $total_pago = 0;
            foreach (PedidosDAO::ListarPedidos('pago') as $pedido){
                $total_pago += $pedido['totalPreco'];
            }
        ?>
        <h3>Total a Pagar<span></span></h3>
        <p><?='<span>R$ </span>' . $total_pago . ' /-';?></p>
        <a href="pedidos.php" class="btn">Ver Pagamentos</a>
        </div>

        <div class="box">
        <?php
            $total_cancelado = 0;
            foreach (PedidosDAO::ListarPedidos('cancelado') as $pedido){
                $total_cancelado += $pedido['totalPreco'];
            }
        ?>
        <h3>Total Cancelado<span></span></h3>
        <p><?='<span>R$ </span>' . $total_cancelado . ' /-';?></p>
        <a href="pedidos.php" class="btn">Ver Pagamentos</a>
        </div>

        <div class="box">
        <h3>Total de Produtos <span></span></h3>
        <p><?= ProdutosDAO::QtyProdutos(). ' /-';?></p>
        <a href="produtos.php" class="btn">Ver Produtos</a>
        </div>

        <div class="box">
        <h3>Total de Clientes <span></span></h3>
        <p><?= UsuariosDAO::QtyUsuarios('cliente') . ' /-';?></p>
        <a href="users_contas.php" class="btn">Ver Clientes</a>
        </div>

        <div class="box">
        <h3>Total de Admin<span>'s</span></h3>
        <p><?= UsuariosDAO::QtyUsuarios('admin') . ' /-';?></p>
        <a href="admin_contas.php" class="btn">Ver Admin's</a>
        </div>

        <!-- <div class="box">
        <?php
            $qry = ("SELECT * FROM `mensagens`");
            $select_mensagens = $pdo->prepare($qry);
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