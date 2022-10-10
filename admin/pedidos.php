<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    $admin_header = 'admin_login.php';
    header('location:../components/'.$admin_header);
}

if (isset($_POST['alterar_pgmt'])) {
    $codPedido = $_POST['codPedido'];
    if (empty($_POST['status_pagamento'])){
        $statusPagamento = 'Pendente';
    } else { 
        $statusPagamento = $_POST['status_pagamento'];
    }
    // var_dump($statusPagamento); //debug
    
    $statusPagamento = filter_var($statusPagamento, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // $statusPagamento = ucwords($statusPagamento);
    $statusPagamento = ucfirst($statusPagamento);
    $qry = "UPDATE `pedidos` SET statusPagamento = :status WHERE codPedido = :cpid";
    $alterar_pgmt = $conn->prepare($qry);
    $alterar_pgmt->bindParam(':status', $statusPagamento);
    $alterar_pgmt->bindParam(':cpid', $codPedido);
    $alterar_pgmt->execute();
    $mensagem[] = 'Status do pagamento alterado!';
}

if(isset($_POST['deletar_pedido'])){
    $codPedido = $_POST['codPedido'];
    $qry = "DELETE FROM `pedidos` WHERE codPedido = :cpid";
    $deletar_pedido = $conn->prepare($qry);
    $deletar_pedido->bindParam(':cpid',$codPedido);
    $deletar_pedido->execute();
    header('location: pedidos.php');
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

<?php include '../components/admin_header.php'; ?>

<section class="pedidos"></section>
    <h1 class="heading">Lista de Pedidos</h1>
    <div class="box-container">
        <?php 
            $qry = "SELECT * FROM `pedidos`";
            $selecionar_pedidos = $conn->prepare($qry);
            // $selecionar_pedidos->bindParam('');
            $selecionar_pedidos->execute();
            if ($selecionar_pedidos->rowCount() > 0){
                while ($fetch_pedido = $selecionar_pedidos->fetch(PDO::FETCH_ASSOC)){
        ?>
        <div class="box">
            <p>Nome</p>
            <span><?=$fetch_pedido['nome'];?></span>
            <p>Email</p>
            <span><?=$fetch_pedido['email'];?></span>
            <p>Telefone</p>
            <span><?=$fetch_pedido['telefone'];?></span>
            <p>Tipo de Entrega</p>
            <span><?=$fetch_pedido['tipoEntrega'];?></span>
            <p>Cep do Destinatário</p>
            <span><?=$fetch_pedido['cepDestino'];?></span>
            <p>Endereco</p>
            <span><?=$fetch_pedido['endereco'];?></span>
            <p>Produtos</p>
            <span><?=$fetch_pedido['totalProduto'];?></span>
            <p>Preco Total</p>
            <span><?=$fetch_pedido['totalPreco'];?></span>
            <p>Data de Envio</p>
            <span><?=$fetch_pedido['dataEnvio'];?></span>
            <p>Data de Entrega</p>
            <span><?=$fetch_pedido['dataEntrega'];?></span>
            <p>Status do Pagamento</p>
            <span><?=$fetch_pedido['statusPagamento'];?></span>
            <!-- <p>Usuarios_Codusuario</p> -->
            <form action="" method="post" name="pedido_form" enctype="multipart/form-data">
                <input type="hidden" name="codPedido" value="<?=$fetch_pedido['codPedido'];?>">
                <select name="status_pagamento" class="">
                    <option selected disabled value="">
                        <?=$fetch_pedido['statusPagamento'];?>
                    </option>
                    <option value="pendente">Pendente</option>
                    <option value="finalizado">Finalizado</option>
                </select>
                <div class="flex-btn">
                    <button type="submit" name="alterar_pgmt" value="" class="option-btn"
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
            echo '<p class="vazio">Nenhum pedido feito!</p>';
        }
        ?>
    </div>
</section>

<script src="../js/admin_script.js"></script>
</body>
</html>