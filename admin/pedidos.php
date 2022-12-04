<?php
session_start();
require_once '../model/connect.php';
// require_once '../model/dao/PedidosDAO.php';
// require_once '../model/dto/PedidosDTO.php';
// require_once '../model/dao/UsuariosDAO.php';
//undo requirefolder if fails!
File_Path::requireFolder('../model/dao');
File_Path::requireFolder('../model/dto');

if (isset($_POST['alterar_status'])) {
    $updateData = new PedidosDTO;
    $updateData->setCodPedido($_POST['codPedido']);
    (isset($_POST['status_pagamento'])) ? 
        $updateData->setStatusPagamento($_POST['status_pagamento']) : '';
    PedidosDAO::alterarStatus($updateData);
}

if (isset($_POST['deletar_pedido'])) {
    PedidosDAO::deletarPedido($_POST['codPedido']);
}
?>

<!DOCTYPE html>
<html lang="pt, en">

<head>
    <?php require_once File_Path::head(); ?>
    <link rel="stylesheet" href="../css/admin_stylesheet.css">

    <title>Lista de Pedidos</title>
</head>

<body>

    <div class="header">
        <?php require_once File_Path::admin_header(); ?>
    </div>

    <h1 class="head-list">Lista de Pedidos</h1>
    <section class="pedidos">
        <!-- <div class="box-container"> -->
        <?php
        $fetch_pedido = PedidosDAO::listarPedidos();
        // var_dump($fetch_pedido[0]); //debug
        if (count($fetch_pedido) > 0) {
            foreach ($fetch_pedido as $pedido) {
        ?>
        <div class="gridbox">
            <div class="itemfield">
                <span class="title">Nome</span>
                <p class="box">
                    <?php echo $pedido['nome']; ?>
                </p>
            </div>
            <div class="itemfield">
                <span class="title">Email</span>
                <p class="box">
                    <?php echo $pedido['email']; ?>
                </p>
            </div>
            <div class="itemfield">
                <span class="title">Telefone</span>
                <p class="box">
                    <?php echo $pedido['telefone']; ?>
                </p>
            </div>
            <div class="itemfield">
                <span class="title">Tipo de Entrega</span>
                <p class="box">
                    <?php echo $pedido['tipoEntrega']; ?>
                </p>
            </div>
            <div class="itemfield">
                <span class="title">Endereco</span>
                <p class="box">
                    <?php echo $pedido['fullAddress']; ?>
                </p>
            </div>
            <div class="itemfield">
                <span class="title">Produtos</span>
                <p class="box">
                    <?php
                $discProd = unserialize($pedido['totalProduto']);
                foreach ($discProd as $key => $val) {
                    echo "$val[nome] ($val[quantidade])\n\r<br/><br/>";
                } ?>
                </p>
            </div>
            <div class="itemfield">
                <span class="title">Preco Total</span>
                <p class="box">
                    <?php echo $pedido['totalPreco']; ?>
                </p>
            </div>
            <div class="itemfield">
                <span class="title">Data de Envio</span>
                <p class="box">
                    <?php echo $pedido['dataEnvio']; ?>
                </p>
            </div>
            <div class="itemfield">
                <span class="title">Data de Entrega</span>
                <p class="box">
                    <?php echo empty($pedido['dataEntrega']) ? 
                    'Sem Previsão' :
                    $pedido['dataEntrega']; ?>
                </p>
            </div>
            <div class="itemfield">
                <span class="title">Status do Pagamento</span>
                <!-- <p class="box"><?php echo ucfirst($pedido['statusPagamento']); ?></p> -->
            </div>
            <form action="" method="post" name="pedido_form" enctype="multipart/form-data">
                <input type="hidden" name="codPedido" value="<?php echo $pedido['codPedido']; ?>">
                <select name="status_pagamento">
                    <?php
                foreach (ArrayList::$payStatus as $status) {
                    if ($pedido['statusPagamento'] == $status) {
                        echo "<option selected disabled style='color:dodgerblue;' value=\"$status\">" . ucfirst($status) . "</option>";
                        continue;
                    }
                    echo "<option value='$status'>" . ucfirst($status) . "</option>";
                }
                    ?>
                </select>
                <div class="flex-btn">
                    <button type="submit" name="alterar_status" value="" class="option-btn">Alterar Pagamento</button>
                    <button type="submit" name="deletar_pedido" value="" class="delete-btn"
                        onclick="return confirm('Deseja mesmo excluir?');">Deletar Pedido</button>
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