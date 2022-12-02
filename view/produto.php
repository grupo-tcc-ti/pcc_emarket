<?php
session_start();
require_once '../model/connect.php';
File_Path::requireFolder('../model/dao');
File_Path::requireFolder('../model/dto');
if (isset($_GET['id'])) {
    $_SESSION['last_visited'] = $_GET['id'];
}
$fetch_produto = ProdutosDAO::productByID($_SESSION['last_visited']);
?>
<!DOCTYPE html>
<html lang="pt-br, en">

<head>
    <?php require_once File_Path::head(); ?>
    <link rel="stylesheet" href="../css/product.css" />
    <title>Emarket</title>
</head>

<body>
    <div id="header">
        <?php require_once 'user_header.php'; ?>
    </div>
    <div class="product-page">
        <section class="wrap">
            <?php
            $prodimg = explode(",", $fetch_produto['image']);
            $preco = number_format($fetch_produto['preco'], 2, ',', '.');
            $prod_link = cleaner::cleanURL($fetch_produto['nome']);
            ?>
            <div class="col-1 img-swip">
                <!-- js faz a mudança de fotos funcionar //important! -->
                <div class="btn-nav">
                    <i class="fas fa-chevron-up"></i>
                </div>
                <?php
                foreach ($prodimg as $img) {
                    echo "<img src='$img' alt=''>";
                }
                ?>
                <div class="btn-nav">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>


            <div class="col prod-img">
                <img src="<?php echo $prodimg[0]; ?>" alt="">
            </div>


            <div class="prod-info">
                <div class="title">
                    <?php echo $fetch_produto['nome']; ?>
                </div>
                <div class="sponsor-rate">
                    <span>
                        <em>Marca:</em> TechGrifo-Product
                    </span>
                    <div class="ratings">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        (5)
                    </div>
                </div>

                <div class="shipping">
                    Vendido e enviado por <em>Techgrifo*</em>
                </div>

                <!-- objeto com opções -->
                <!-- <div class="choose-opt">
        <div class="label"><em>Opções:</em> Indianred</div>
        <div class="opt-list">
            <img src="../../image/produtos_teste/cadeira-gamer-riotoro-spitfire-x1s-plus-rgb-bluetooth-alto-falantes-reclinavel-black-gc-30x1splus_106602.jpg"
                alt=""><img
                src="../../image/produtos_teste/cadeira-gamer-riotoro-spitfire-x1s-plus-rgb-bluetooth-alto-falantes-reclinavel-black-gc-30x1splus_106603.jpg"
                alt=""><img
                src="../../image/produtos_teste/cadeira-gamer-riotoro-spitfire-x1s-plus-rgb-bluetooth-alto-falantes-reclinavel-black-gc-30x1splus_106604.jpg"
                alt="">
        </div>
    </div> -->
                <div class="payment-view">
                    <div class="prod-price">
                        <span class="">
                            <i class="fas fa-money-bill"></i>
                            À vista</span>
                        <div class="discount">
                            <small>de&nbsp;<em>&nbsp;R$&nbsp;
                                    <?php echo $preco; ?>&nbsp;
                                </em>&nbsp;por:</small>
                        </div>
                        <div class="price">
                            R$&nbsp;
                            <?php echo number_format(($fetch_produto['preco'] * 0.90), 2, ',', '.'); ?>
                        </div>
                        <div class="opt">
                            <small>ou em até 12x de R$&nbsp;
                                <?php echo number_format(($fetch_produto['preco'] * 0.90) / 12, 2, ',', '.'); ?>&nbsp;<i>sem
                                    juros</i>
                            </small>
                        </div>
                    </div>

                    <div class="line">
                        <hr class="" />
                    </div>

                    <div class="financed-limit">
                        <div class="wrap-content">
                            <span class="">
                                <i class="fas fa-credit-card"></i>
                                Parcelamento</span>
                            <div class="installments">
                                <?php
                                // $preco = number_format($fetch_produto['preco'], 2, ',', '.');
                                foreach (range(1, 12) as $i) {
                                    $prest = "<div class=''>$i&nbsp;x de " . number_format($fetch_produto['preco'] / $i, 2, ',', '.');
                                    if ($i <= 1) {
                                        echo "$prest (com 10% de desconto)</div>";
                                    }
                                    if (in_array($i, range(2, 3))) {
                                        echo "$prest (com 5% de desconto)</div>";
                                    }
                                    if (in_array($i, range(4, 6))) {
                                        echo "$prest (com 3% de desconto)</div>";
                                    }
                                    if (in_array($i, range(7, 12))) {
                                        echo "$prest (sem juros)</div>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="credit-card-flags">
                            <span class="jss411"><img title="Visa" src="../image/pay/visa.png" height="20">
                            </span>
                            <span class="jss411"><img title="MasterCard" src="../image/pay/mastercard.png" height="20">
                            </span>
                            <span class="jss411"><img title="American Express" src="../image/pay/american.png"
                                    height="20">
                            </span>
                            <span class="jss411"><img title="ELO" src="../image/pay/cartao-elo.png" height="20">
                            </span>
                            <span class="jss411"><img title="Hipercard" src="../image/pay/cartao-hipercard.png"
                                    height="20">
                            </span>
                            <span class="jss411"><img title="Diners" src="../image/pay/mercadopago.png" height="20">
                            </span>
                        </div>
                        <div class="credit-card-flags">
                            <p>Bandeiras bancárias meramente ilustrativas*</p>
                        </div>
                    </div>
                </div>
                <form action="" method="post">
                    <input type="number" name="qty" class="qty" min="1" max="100"
                        onchange="if(this.value > 99) return this.value = 1;" value="1">
                    <input type="submit" value="Adicionar ao Carrinho" name="add_cart" class="btn-cart">
                    <!-- rename if fails-->
                    <input type="hidden" name="pid" value="<?php echo $fetch_produto['codProduto']; ?>">
                    <input type="hidden" name="client_cart">
                </form>
            </div>
        </section>
    </div>
    <?php
    require_once '../view/footer.html';
    ?>

    <script src="../js/script.js"></script>
</body>

</html>