<?php
session_start();

require_once '../model/connect.php';
//undo requirefolder if fails!
File_Path::requireFolder('../model/dao');
File_Path::requireFolder('../model/dto');
?>

<!DOCTYPE html>
<html lang="pt, en">

<head>
    <?php require_once File_Path::head(); ?>
    <link rel="stylesheet" href="../css/admin_stylesheet.css">
    <title>Administrador - Intranet</title>
</head>

<body>

    <div class="header">
        <?php require_once File_Path::admin_header(); ?>
    </div>

    <div class="heading-dash">
        <h1><span>i</span>DASH</h1>
        <div class="hd-img"></div>
    </div>

    <section class="dashboard user-welcome">
        <div class="box">
            <h3>Bem Vindo!</h3>
            <p>
                <?php echo $fetch_perfil['nome']; ?>
            </p>
            <!-- <p><?php echo $fetch_perfil['senha']; ?></p> -->
            <a href="alterar_perfil.php" class="btn">Alterar Perfil</a>
        </div>
    </section>

    <section class="dashboard">
        <div class="box">
            <?php
            $total_pendente = 0;
            foreach (PedidosDAO::listarPedidosTipo('pendente') as $pedido) {
                $total_pendente += $pedido['totalPreco'];
            }
            ?>
            <h3>Total Pendente<span></span></h3>
            <p>
                <?php echo '<span>R$ </span>' . $total_pendente; ?>
            </p>
            <a href="pedidos.php" class="btn">Ver Pedidos</a>
        </div>

        <div class="box">
            <?php
            $total_pago = 0;
            foreach (PedidosDAO::listarPedidosTipo('pago') as $pedido) {
                $total_pago += $pedido['totalPreco'];
            }
            ?>
            <h3>Total a Pagar<span></span></h3>
            <p>
                <?php echo '<span>R$ </span>' . $total_pago; ?>
            </p>
            <a href="pedidos.php" class="btn">Ver Pagamentos</a>
        </div>

        <div class="box">
            <?php
            $total_cancelado = 0;
            foreach (PedidosDAO::listarPedidosTipo('cancelado') as $pedido) {
                $total_cancelado += $pedido['totalPreco'];
            }
            ?>
            <h3>Total Cancelado<span></span></h3>
            <p>
                <?php echo '<span>R$ </span>' . $total_cancelado; ?>
            </p>
            <a href="pedidos.php" class="btn">Ver Cancelamentos</a>
        </div>

        <div class="box">
            <h3>Total de Produtos <span></span></h3>
            <p>
                <?php echo ProdutosDAO::qtyProdutos(); ?>
            </p>
            <a href="produtos.php" class="btn">Ver Produtos</a>
        </div>

        <div class="box">
            <h3>Total de Clientes <span></span></h3>
            <p>
                <?php echo UsuariosDAO::qtyUsuarios('cliente'); ?>
            </p>
            <a href="users_contas.php" class="btn">Ver Clientes</a>
        </div>

        <div class="box">
            <h3>Total de Admin<span>'s</span></h3>
            <p>
                <?php echo UsuariosDAO::qtyUsuarios('admin'); ?>
            </p>
            <a href="admin_contas.php" class="btn">Ver Admin's</a>
        </div>
    </section>

    <script src="../js/admin_script.js"></script>
</body>

</html>