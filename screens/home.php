<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="shortcut icon" href="../image/favicon.ico" type="../image/x-icon" />
    <script src="https://kit.fontawesome.com/5e9d92adc0.js" crossorigin="anonymous"></script>
    <title>Emarket</title>
</head>

<body>
    <!-- com JQuery nos podemos puxar um html code de outro arqui aqui, assim nos pode usar a mesma barra em todas as telas -->
    <div id="header">
    <?php
    include "header.php";
    ?>
    </div>

    <section>
        <div class="slider">
            <div class="slide active">
                <img src="../image/slider/1.jpg" alt="">
            </div>

            <div class="slide">
                <img src="../image/slider/2.jpg" alt="">
            </div>

            <div class="slide">
                <img src="../image/slider/3.jpg" alt="">
            </div>

            <div class="navigation">
                <i class="fas fa-chevron-left prev-btn"></i>
                <i class="fas fa-chevron-right next-btn"></i>
            </div>

            <div class="navigation-visibility">
                <div class="slide-icon active"></div>
                <div class="slide-icon"></div>
                <div class="slide-icon"></div>
                <div class="slide-icon"></div>
                <div class="slide-icon"></div>
            </div>
        </div>
    </section>

    <div id="overlay">
        <main id="all-container">
            <section class="container-prod">
                <div class="list-cards">
                    <div class="cards-items">
                        <figure><img src="../image/produtos/1-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                    <div class="cards-items">
                        <figure><img src="../image/produtos/2-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                    <div class="cards-items">
                        <figure><img src="../image/produtos/n3-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                    <div class="cards-items">
                        <figure><img src="../image/produtos/4-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                </div>
                <div class="list-cards">
                    <div class="cards-items">
                        <figure><img src="../image/produtos/5-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                    <div class="cards-items">
                        <figure><img src="../image/produtos/6-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                    <div class="cards-items">
                        <figure><img src="../image/produtos/7-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                    <div class="cards-items">
                        <figure><img src="../image/produtos/8u-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                </div>
                <div class="list-cards">
                    <div class="cards-items">
                        <figure><img src="../image/produtos/9-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                    <div class="cards-items">
                        <figure><img src="../image/produtos/10-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                    <div class="cards-items">
                        <figure><img src="../image/produtos/11-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                    <div class="cards-items">
                        <figure><img src="../image/produtos/12-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                </div>
                <div class="list-cards">
                    <div class="cards-items">
                        <figure><img src="../image/produtos/13-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                    <div class="cards-items">
                        <figure><img src="../image/produtos/n14u-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                    <div class="cards-items">
                        <figure><img src="../image/produtos/15-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                    <div class="cards-items">
                        <figure><img src="../image/produtos/15-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                </div>
                <div class="list-cards">
                    <div class="cards-items">
                        <figure><img src="../image/produtos/16-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                    <div class="cards-items">
                        <figure><img src="../image/produtos/17-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                    <div class="cards-items">
                        <figure><img src="../image/produtos/18-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                    <div class="cards-items">
                        <figure><img src="../image/produtos/19-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                </div>
                <!-- Aqui dá ruim o card fica muito grande - Obs.:precisa arrumar -->
                <!-- <div class="list-cards">
                    <div class="cards-items">
                        <figure><img src="../image/produtos/20u-min.jpg" class="products-imgs" /></figure>
                        <p class="products-name">PC Gamer</p>
                        <figcaption class="cards-price">Preço: R$ 3.000,00</figcaption>
                        <button class="buy-bttn">
                            <a href="#">Adicionar ao Carrinho</a>
                        </button>
                    </div>
                </div> -->
            </section>
        </main>

        <div id="footer">
            <?php
                include "footer.php";
            ?>
        </div>

        <script src="../js/script.js"></script>
    </div>
   
</body>

</html>