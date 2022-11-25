<div class="quickview">
    <!-- <div class="closeWindow"> -->
    <div class="closeWindow" onclick="peekProd(this)">
            <i class="fas fa-multiply"></i>
    </div>
    <!-- </div> -->
    <section class="wrap">
        <div class="col img-swip">
            <!-- js faz a mudança de fotos funcionar //important! -->
            <div class="btn-nav">
                <i class="fas fa-chevron-up"></i>
            </div>
            <?php foreach ($prodimg as $img) {
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
        <div class="col prod-info">
            <div class="title">
                <?php echo $prod['nome']; ?>
            </div>
            <div class="prod-price">
                <div class="discount">
                    <small>de&nbsp;<em>&nbsp;R$&nbsp;
                            <?php echo $preco; ?>&nbsp;
                        </em>&nbsp;por:</small>
                </div>
                <div class="price">
                    R$&nbsp;
                    <?php echo number_format(($prod['preco'] * 0.90), 2, ',', '.'); ?>&nbsp;<span>à vista</span>
                </div>
                <div class="opt">
                    <small>ou em até 6x de&nbsp;
                        <?php echo number_format(($prod['preco'] * 0.90) / 12, 2, ',', '.'); ?>&nbsp;<i>sem juros</i>
                    </small>
                </div>
            </div>
            <div class="shipping">
                Vendido e enviado por <em>Techgrifo</em>
            </div>
            <div class="choose-opt">
                <div class="label"><em>Opções:</em> Indianred</div>
                <div class="opt-list">
                    <!-- <img src="../image/produtos/1-min.jpg" alt=""> -->
                    <?php foreach ($prodimg as $img) {
                        echo "<img src='$img' alt=''>";
                    }
                    ?>
                </div>
                <!-- objeto com opções -->
            </div>
            <!-- Provavelmente essa opção será movida para a página do produto -->
            <form action="" method="post">
                <input type="number" name="qty" class="qty" min="1" max="99"
                    onkeypress="if(this.value> 2) return false;" value="1">
                <input type="submit" value="Adicionar ao Carrinho" name="add_cart" class="btn-cart">
                <!-- rename if fails-->
                <input type="hidden" name="pid" value="<?php echo $prod['codProduto']; ?>"></input>
                <input type="hidden" name="client_cart">
            </form>

        </div>
    </section>
</div>