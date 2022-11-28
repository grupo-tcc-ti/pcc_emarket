<?php
session_start();
require_once '../model/connect.php';
require_once '../controller/cartControl.php';

//undo requirefolder if fails!
File_Path::requireFolder('../model/dao');
File_Path::requireFolder('../model/dto');
if (!isset($_SESSION['client_id'])) {
    header('location: conta.php');
}
$usuario = UsuariosDAO::getUserByID(
    $_SESSION['client_id']['type'], $_SESSION['client_id']['id']
);
$fulladdress = "$usuario[cidade], $usuario[endereco], Número: $usuario[numero], $usuario[complemento] - $usuario[estado]";
(!isset($pageTitle)) ? $pageTitle = 'Emarket' : $pageTitle;
?>

<!DOCTYPE html>
<html lang="pt, en">

<head>
    <?php require_once File_Path::head(); ?>
    <link rel="stylesheet" href="../css/home.css" />
    <link rel="stylesheet" href="../css/quickview.css" />
    <link rel="stylesheet" href="../css/checkout.css" />
    <title>
        <?php echo $pageTitle; ?>
    </title>
</head>

<body>
    <?php require_once 'user_header.php'; ?>
    <?php
    if (count($fetchCart) <= 0) {
    ?>

    <div class="empty-cart">
        <a href="../view/pedidos.php">
            <div class="gotoorders">Ver minhas compras</div>
        </a>
        <p class="box">Carrinho vazio...
            &nbsp;&nbsp;&nbsp;
            <i class="fa-brands fa-opencart"></i>
            <img src="../image/cart_empty.png" alt="">
        </p>
    </div>

    <?php
    } else {
        ?>

    <div class="checkout">

        <div class="back" id="prev-checkout">
            <i class="fas fa-arrow-left"></i>
        </div>
        <section class="container">
            <!-- <form action="" id="checkout" method="post" class="form" novalidate> -->
            <!-- <form action="" id="checkout" method="post" class="form" enctype="multipart/form-data" novalidate> -->
            <form action="" id="checkout" method="post" class="form" novalidate>
                <div class="concat shipping-method current">
                    <!-- <div class="concat shipping-method"> -->
                    <span class="title">Método de Entrega</span>
                    <div class="subtitle"><span>Endereço de Entrega</span></div>
                    <div class="client-address">
                        <i class="icons fas fa-location-dot"></i>
                        <?php echo $fulladdress; ?>
                    </div>
                    <div class="subtitle"><span>Tipo de envio</span></div>
                    <div class="radio-selector">
                        <input type="radio" name="tipoEntrega" id="shipping-type-expresso" class="shipping-type"
                            value="expresso">
                        <div class="js">
                            <label for="shipping-type-expresso">
                                <span>Expresso</span>
                                <span>R$&nbsp;120,00&nbsp;
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </label>
                        </div>
                        <input type="radio" name="tipoEntrega" id="shipping-type-normal" class="shipping-type"
                            value="normal" required>
                        <div class="js">
                            <label for="shipping-type-normal">
                                <span>Normal</span><span>R$&nbsp;60,00&nbsp;
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- <div class="concat payment-method current"> -->
                <div class="concat payment-method">
                    <span class="title">Método de Pagamento</span>
                    <div class="radio-selector">
                        <input type="radio" name="tipoPagamento" id="payment-method-credito" class="payment-type"
                            value="credito">
                        <div class="js">
                            <label for="payment-method-credito">
                                <i class="icons fas fa-credit-card"></i>
                                <span>Cartão de Crédito&nbsp;</span><i class="fas fa-angle-right"></i>
                            </label>
                        </div>
                        <input type="radio" name="tipoPagamento" id="payment-method-debito" class="payment-type"
                            value="debito">
                        <!-- <div class="js">
                            <label for="payment-method-debito">
                                <i class="icons fas fa-credit-card"></i>
                                <span>Cartão de Débito&nbsp;</span><i class="fas fa-angle-right"></i>
                            </label>
                        </div> -->
                        <input type="radio" name="tipoPagamento" id="payment-method-boleto" class="payment-type"
                            value="boleto" required>
                        <div class="js">
                            <label for="payment-method-boleto">
                                <i class="icons fas fa-barcode"></i>
                                <span>Boleto&nbsp;</span><i class="fas fa-angle-right"></i>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- <div class="concat credit-card-option current"> -->
                <div class="concat credit-card-option">
                    <span class="title">Quantas vezes?</span>
                    <div class="radio-selector installments">
                        <input type="radio" name="installment" id="row1" class="num-itm"
                            value="<?php echo json_encode(array(1, $cartTotal['price'])); ?>">
                        <div class="js">
                            <label for="row1">
                                <span>
                                    1 x&nbsp;R$&nbsp;<?= number_format($cartTotal['price'], 2, ',', '.'); ?>
                                </span><i class="fas fa-angle-right"></i>
                            </label>
                        </div>
                        <?php for ($i = 2; $i < 13; $i++) {
            $itm = ($cartTotal['price'] / $i);
            $itm = number_format($itm, 2, ',', '.');
                        ?>
                        <input type="radio" name="installment" id="row<?= $i; ?>" class="num-itm"
                            value="<?php echo json_encode(array($i, $cartTotal['price'] / $i)); ?>">
                        <div class="js">
                            <label for="row<?= $i; ?>">
                                <span>
                                    <?= $i; ?> x&nbsp;R$&nbsp;<?= $itm; ?>
                                </span><i class="fas fa-angle-right"></i>
                            </label>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- <div class="concat receipt-data current"> -->
                <div class="concat receipt-data">
                    <span class="title">Emissão de nota</span>
                    <div class="card-figure">
                        <span>Dados para a sua Nota Fiscal</span>
                        <div class="line">
                            <hr />
                        </div>
                        <div class="di" style="display: flex;">
                            <p>XXXX&nbsp;&nbsp;&nbsp;</p>
                            <span>xxxx xxxx xxxx xxxx</span>
                        </div>
                        <div class="bar">
                            <i class="fas fa-barcode"></i>
                            <i class="fas fa-barcode"></i>
                            <i class="fas fa-barcode"></i>
                            <i class="fas fa-barcode"></i>
                            <i class="fas fa-barcode"></i>
                        </div>
                    </div>
                    <div class="data-select">
                        <label for="data-id">Tipo</label>
                        <select name="tipoCred" id="data-id" class="input-field">
                            <option class="input-field" value="cpf">CPF</option>
                            <option class="input-field" value="rg">RG</option>
                            <option class="input-field" value="cnpj">CNPJ</option>
                        </select>
                        <br />
                        <div class="form-field">
                            <label for="data-number">Número</label>
                            <input type="text" class="input-field" id="data-number" name="credencial"
                                placeholder="4321 5432 6543 7654" pattern="" value="1123.456.789-10" required>
                            <small class="message"></small>
                        </div>
                    </div>
                </div>

                <!-- <div class="concat review-purchase current"> -->
                <div class="concat review-purchase">
                    <span class="title">Revise os dados da sua compra</span>
                    <div class="shipping-content">
                        <span class="subtitle">Detalhes do envio</span>
                        <div class="checkout-review location">
                            <i class="icons fas fa-location-dot"></i>
                            <?php echo $fulladdress; ?>
                        </div>
                        <div class="checkout-review shipping">
                            <i class="icons fas fa-van-shuttle"></i>
                            <p>Tipo de Entrega:&nbsp;<span>Normal</span></p>
                        </div>
                        <div class="payment-content">
                            <span class="subtitle">Detalhes do pagamento</span>
                            <div class="checkout-review shipping">
                                <i class="icons fas fa-credit-card"></i>
                                <p>Tipo de Pagamento:&nbsp;<span>Cartão</span></p>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn buy" name="purchase" value="true">Comprar</button>
                    <!-- <input type="submit" class="btn buy" name="purchase" value="Comprar"></input> -->
                    <input type="hidden" name="client_cart" value="purchase">
                </div>

                <!-- <div class="concat checkout-complete current"> -->
                <div class="concat checkout-complete">
                    <span class="title">Compra Finalizada</span>
                    <i class="icons fas fa-circle-check"></i>

                </div>
            </form>
            <div class="next" id="next-checkout">Próximo</div>
        </section>
    </div>
    <?php } ?>

    <!-- <php require_once Redirect::directory($_SERVER['PHP_SELF']) . '/footer.html'; ?> -->

    <script src="../js/script.js"></script>
    <script src="../js/checkout.js"></script>

</body>

</html>