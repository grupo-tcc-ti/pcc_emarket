<?php
session_start();
require_once '../model/connect.php';
//undo requirefolder if fails!
File_Path::requireFolder('../model/dao');
File_Path::requireFolder('../model/dto');
if (!isset($_SESSION['client_id'])) {
    header('location: conta.php');
}
$usuario = UsuariosDAO::getUserByID(
    $_SESSION['client_id']['type'], $_SESSION['client_id']['id']
);
$pedidos = PedidosDAO::listarPedidosUserId($_SESSION['client_id']['id']);
(!isset($pageTitle)) ? $pageTitle = 'Emarket' : $pageTitle;
?>

<!DOCTYPE html>
<html lang="pt, en">

<head>
    <?php require_once File_Path::head(); ?>
    <link rel="stylesheet" href="../css/pedidos.css" />
    <title>
        <?php echo $pageTitle; ?>
    </title>
</head>

<body>
    <div id="header">
        <?php require_once 'user_header.php'; ?>
    </div>

    <div id="pedidos" class="">
        <div class="container">
            <article class="card">
                <header class="card-header"> Meus Pedidos / Rastreamento </header>
                <ul class="list-group list-group-flush">
                    <?php
                    if (count($pedidos) > 0) {
                        foreach ($pedidos as $pedido) {
                            // echo var_dump($pedido) . '<br>';
                    ?>
                    <div class="card-header">
                        <h4 class="card-title text-dark display-5">Pedido n&#176;&nbsp;
                            <?php echo md5($pedido['codPedido']) ?>
                        </h4>
                    </div>
                    <li class="list-group-item">
                        <div class="card-body">
                            <!-- <h6>Order ID: </h6> -->
                            <article class="card">
                                <div class="card-body row">
                                    <div class="col">
                                        <strong>Tempo estimado da entrega:</strong>
                                        <br>Sem previsão&nbsp;
                                    </div>
                                    <div class="col">
                                        <strong>Entregador:</strong>
                                        <br>&nbsp;TECHGRIFO,&nbsp;|&nbsp;&nbsp;<i class="fa fa-phone"></i>
                                        +55 (61)9 8765-4321
                                    </div>
                                    <div class="col">
                                        <strong>Status:</strong>
                                        <br>&nbsp;Preparando pacote&nbsp;
                                    </div>
                                    <div class="col">
                                        <strong>Código de Rastreamento :</strong>
                                        <br>&nbsp;BR045903594059
                                    </div>
                                </div>
                            </article>
                            <div class="track">
                                <div class="step active">
                                    <span class="icon"> <i class="fas fa-check"></i> </span>
                                    <span class="text">&nbsp;Pedido confirmado</span>
                                </div>
                                <div class="step active">
                                    <span class="icon"> <i class="fas fa-box-open"></i> </span>
                                    <span class="text">&nbsp;Preparando pacote</span>
                                </div>
                                <div class="step">
                                    <span class="icon"> <i class="fas fa-dolly"></i> </span>
                                    <span class="text">&nbsp;Encomenda despachada</span>
                                </div>
                                <div class="step">
                                    <span class="icon"> <i class="fas fa-truck"></i> </span>
                                    <span class="text">Em trânsito</span>
                                </div>
                                <div class="step">
                                    <span class="icon"> <i class="fas fa-truck-fast"></i> </span>
                                    <span class="text">Pedido saiu para entrega</span>
                                </div>
                            </div>
                            <hr>
                            <ul class="row">
                                <?php
                            $decryptOrder = unserialize($pedido['totalProduto']);
                            foreach ($decryptOrder as $order) {
                                // echo var_dump($order) . '<br>';
                                $img = explode(',', $order['image']);
                                ?>
                                <li class="col-md-4">
                                    <figure class="itemside mb-3">
                                        <div class="aside">
                                            <img src="<?= $img[0]; ?>" class="img-sm border">
                                            <span class="badge rounded-pill text-bg-dark"><?= $order['quantidade']; ?></span>
                                        </div>
                                        <figcaption class="info align-self-center">
                                            <p class="title">
                                                <?= $order['nome']; ?>
                                            </p>
                                            <span class="text-muted">R&#36;&nbsp;
                                                <?= $order['preco']; ?>
                                            </span>
                                        </figcaption>
                                    </figure>
                                </li>
                                <?php
                            }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <hr class="divisor">
                    <?php
                        }
                    } ?>
                </ul>
                <div class="card-footer">
                    <a href="minha_conta.php" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i>
                        Voltar</a>
                </div>
            </article>
        </div>
    </div>

    <?php require_once Redirect::directory($_SERVER['PHP_SELF']) . '/footer.html'; ?>

    <script src="../js/script.js"></script>

</body>

</html>