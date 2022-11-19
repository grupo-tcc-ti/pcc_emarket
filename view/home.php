<?php
session_start();
require_once '../model/connect.php';
require_once '../model/dao/ProdutosDAO.php';
require_once '../model/dto/ProdutosDTO.php';
(isset($_SESSION['client_id'])) ? 
  $user_id = $_SESSION['client_id']
  : '';
(!isset($pageTitle)) ? $pageTitle = 'Emarket' : $pageTitle;
// require_once '../components/wishlist_card.php';
require_once '../controller/navigationControl.php';
?>

<!DOCTYPE html>
<html lang="pt-br, en">

<head>
  <?php require_once Path_Locale::head(); ?>
  <link rel="stylesheet" href="../css/home.css" />
  <link rel="stylesheet" href="../css/quickview.css" />
  <title>
    <?php echo $pageTitle; ?>
  </title>
</head>

<?php require_once Path_Locale::user_header(); ?>

<body>
  <section>
    <div class="slider">
      <div class="slide active">
        <img src="../image/slider/1.jpg" alt="" />
      </div>

      <div class="slide">
        <img src="../image/slider/2.jpg" alt="" />
      </div>

      <div class="slide">
        <img src="../image/slider/3.jpg" alt="" />
      </div>

      <div class="navigation">
        <i class="fas fa-chevron-left prev-btn"></i>
        <i class="fas fa-chevron-right next-btn"></i>
      </div>

      <div class="navigation-visibility">
        <div class="slide-icon active"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
      </div>
    </div>
  </section>

  <section>
    <?php //include '../view/vitrine_teste.html'; ?>
    </section>

    <?php
    // if (!isset($_GET['str']) && !isset($_GET['category'])) {
    if (!isset($_GET) || empty($_GET)) {
    ?>

    <div id="overlay">
      <main id="all-container">
        <!-- <div class="swiper products-slider">
    <div class="swiper-wrapper"> -->
        <section class="container-prod">
          <div class="list-cards">
            <?php
      $fetch_produto = ProdutosDAO::listarProdutos();
      if (count($fetch_produto) > 0) {
        foreach ($fetch_produto as $prod) {
          $prodimg = explode(",", $prod['image']);
          $preco = number_format($prod['preco'], 2, ',', '.');
          // NumberFormatter
          $prod_link = cleaner::cleanURL($prod['nome']);
          // $prod['max_prest'];
            ?>
            <div class="cards-items peek">
              <a type="submit" class="fas fa-heart" name="addListadesejo"></a>
              <button id="peek-prod" onclick="return peekProd();"><i class="fas fa-eye"></i>
              </button>
              <a title="<?php echo $prod['nome']; ?>" href="../view/page.php/<?php echo $prod_link; ?>">
                <img src="<?php echo $prodimg[0]; ?>" alt="" class="products-imgs" />
              </a>

              <a title="<?php echo $prod['nome']; ?>" href="../view/page.php/<?php echo $prod_link; ?>">
                <div class="products-name">
                  <?php echo $prod['nome']; ?>
                </div>
              </a>

              <div class="cards-price">
                <div class="old-price">
                  de&nbsp;<em>&nbsp;
                    <?php echo $preco; ?>&nbsp;
                  </em>&nbsp;por:
                </div>
                <div class="price">
                  R$
                  <?php echo number_format(($prod['preco'] * 0.90), 2, ',', '.'); ?>
                  <span> à vista</span>
                  <div class="price-opt">
                    <small> ou em 12x de R$
                      <?php echo number_format(($prod['preco'] * 0.90) / 12, 2, ',', '.'); ?> <i>sem juros</i>
                    </small>
                  </div>
                </div>
              </div>

              <!-- Provavelmente essa opção será movida para a página do produto -->
              <form action="" method="post">
                <input type="hidden" name="pid" value="<?php echo $prod['codProduto']; ?>"></input>
                <input type="number" name="qty" class="qty" min="1" max="99"
                  onkeypress="if(this.value> 2) return false;" value="1">
                <input type="submit" value="Adicionar ao Carrinho" name="add_cart" class="buy-btn">
              </form>
            </div>

            <?php
        }
      } else {
        // só por enquanto
        $error[] = 'Nenhum produto foi encontrado!';
        $error[] = '../image/error/th-1517709978.jpg';
        $error[] = 'Não se preocupe estamos trabalhando nisso!';
      }
    } else if (isset($_GET['str']) || isset($_GET['category'])) {
      include_once '../view/page.php';
    } else if (array_key_first($_GET) != "str" || array_key_first($_GET) != "category") {
      $error[] = 'Talvez o que você procura não esteja aqui. <br> talvez...!';
      $error[] = '../image/error/th-1517709978.jpg';
    } else if (empty($_GET['str']) || empty($_GET['category'])) {
      $error[] = 'Nenhum produto foi encontrado!';
    }
    // var_dump(array_key_first($_GET)); //debug
    // var_dump($_GET); //debug
            ?>
          </div>
          <!-- <div class="swiper-pagination"></div>
    </div>
    </div> -->
        </section>
      </main>
    </div>

    <?php
    require_once '../view/quickview.php';

    if (isset($error)) {
      echo '<div class="thrown-error">';
      foreach ($error as $obj) {
        if (str_contains($obj, '/image')) {
          echo ' <p class="vazio"><img src="' . $obj . '" alt="" /></p> ';
        } else {
          echo ' <p class="vazio">' . $obj . '</p> ';
        }
      }
      echo '</div>';
    }
    ?>

    <?php require_once '../view/footer.html'; ?>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <!-- <script src="../js/swiper.js"></script> -->

    <script src="../js/script.js"></script>


    <!-- <div class="home-bg">

    <section class="home">

      <div class="swiper home-slider">
        <div class="swiper-wrapper">

          <div class="swiper-slide slide active">
            <div class="image">
              <img src="../image/produtos/home-img-1.png" alt="">
            </div>
            <div class="content">
              <span>upto 50% off</span>
              <h3>latest smartphones</h3>
              <a href="shop.php" class="btn">shop now</a>
            </div>
          </div>

          <div class="swiper-slide slide">
            <div class="image">
              <img src="../image/produtos/home-img-2.png" alt="">
            </div>
            <div class="content">
              <span>upto 50% off</span>
              <h3>latest watches</h3>
              <a href="shop.php" class="btn">shop now</a>
            </div>
          </div>

          <div class="swiper-slide slide">
            <div class="image">
              <img src="../image/produtos/home-img-3.png" alt="">
            </div>
            <div class="content">
              <span>upto 50% off</span>
              <h3>latest headsets</h3>
              <a href="shop.php" class="btn">shop now</a>
            </div>
          </div>

          <div class="swiper-slide slide">
            <div class="image fill">
              <img src="../image/slider/1.jpg" alt="">
            </div>
          </div>
          <div class="swiper-slide slide">
            <div class="image fill">
              <img src="../image/slider/2.jpg" alt="">
            </div>
          </div>
          <div class="swiper-slide slide">
            <div class="image fill">
              <img src="../image/slider/3.jpg" alt="">
            </div>
          </div>

          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>
    <div class="navigation">
      <i class="fas fa-chevron-left prev-btn"></i>
      <i class="fas fa-chevron-right next-btn"></i>
    </div>
  </div> -->
</body>

</html>