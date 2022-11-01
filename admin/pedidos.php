<?php
session_start();
require_once '../model/connect.php';
require_once '../model/dao/PedidosDAO.php';

$user_id = $_SESSION['admin_id'];

if (!isset($user_id)) {
    $admin_header = 'admin_login.php';
    header('location:../admin/'.$admin_header);
}

if (isset($_POST['alterar_status'])) {
    PedidosDAO::alterarStatus($_POST['codPedido'], $_POST['status_pagamento']);
}

if(isset($_POST['deletar_pedido'])) {
    PedidosDAO::deletarPedido($_POST['codPedido']);
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

    <title>Lista de Pedidos</title>
</head>
<body>

<?php require_once Path_Locale::admin_header(); ?>

<h1 class="head-list">Lista de Pedidos</h1>
<section class="pedidos">
    <!-- <div class="box-container"> -->
        <?php 
            $qry = 
            "SELECT *, concat(u.cep,', ',u.estado,', ',u.cidade,', ',u.logradouro,', ',u.numero,', ',u.complemento) as endereco
            FROM `pedidos` AS p 
            JOIN `usuarios` AS u ON p.fk_usuarios_codCliente = u.codCliente";
            $selecionar_pedidos = $pdo->prepare($qry);
            $selecionar_pedidos->execute();
        if ($selecionar_pedidos->rowCount() > 0) {
            while ($fetch_pedido = $selecionar_pedidos->fetch(PDO::FETCH_ASSOC)){
                ?>
        <div class="gridbox">
            <div class="itemfield">
                <span class="title">Nome</span>
                <p class="box"><?php echo $fetch_pedido['nome'];?></p>
            </div>
            <div class="itemfield">
                <span class="title">Email</span>
                <p class="box"><?php echo $fetch_pedido['email'];?></p>
            </div>
            <div class="itemfield">
                <span class="title">Telefone</span>
                <p class="box"><?php echo $fetch_pedido['telefone'];?></p>
            </div>
            <div class="itemfield">
                <span class="title">Tipo de Entrega</span>
                <p class="box"><?php echo $fetch_pedido['tipoEntrega'];?></p>
            </div>
            <div class="itemfield">
                <span class="title">Endereco</span>
                <p class="box"><?php echo $fetch_pedido['endereco'];?></p>
            </div>
            <div class="itemfield">
                <span class="title">Produtos</span>
                <p class="box"><?php echo $fetch_pedido['totalProduto'];?></p>
            </div>
            <div class="itemfield">
                <span class="title">Preco Total</span>
                <p class="box"><?php echo $fetch_pedido['totalPreco'];?></p>
            </div>
            <div class="itemfield">
                <span class="title">Data de Envio</span>
                <p class="box">
                <?php echo $fetch_pedido['dataEnvio'];?>
                </p>
            </div>
            <div class="itemfield">
                <span class="title">Data de Entrega</span>
                <p class="box">
                <?php echo empty($fetch_pedido['dataEntrega'])?
                'Sem Previsão':
                $fetch_pedido['dataEntrega'];?></p>
            </div>
            <div class="itemfield">
                <span class="title">Status do Pagamento</span>
                <!-- <p class="box"><?php echo ucfirst($fetch_pedido['statusPagamento']);?></p> -->
            </div>
            <form action="" method="post" name="pedido_form" enctype="multipart/form-data">
                <input type="hidden" name="codPedido" value="<?php echo $fetch_pedido['codPedido'];?>">
                <select name="status_pagamento">
                    <option selected disabled value="">
                        <?php echo ucfirst($fetch_pedido['statusPagamento']);?>
                    </option>
                    <option value="pendente">Pendente</option>
                    <option value="pago">Pago</option>
                    <option value="cancelado">Cancelado</option>
                </select>
                <div class="flex-btn">
                    <button type="submit" name="alterar_status" value="" class="option-btn"
                    >Alterar Pagamento</button>
                    <button type="submit" name="deletar_pedido" value="" class="delete-btn"
                    onclick="return confirm('Deseja mesmo excluir?');"
                    >Deletar Pedido</button>
                </div>
            </form>
        </div>
                <?php
            }
        } else {
            echo '<p class="vazio">Nenhum pedido feito!</span>';
        }
        ?>
    <!-- </div> -->
</section>

<script src="../js/admin_script.js"></script>
</body>
</html>
