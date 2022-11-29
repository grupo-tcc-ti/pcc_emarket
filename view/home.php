<?php
session_start();
require_once '../model/connect.php';
require_once '../model/dao/ProdutosDAO.php';
require_once '../model/dto/ProdutosDTO.php';

(!isset($pageTitle)) ? $pageTitle = 'Emarket' : $pageTitle;
// require_once 'wishlist_card.php';
require_once '../controller/navigationControl.php'; // important!
?>

<!DOCTYPE html>
<html lang="pt, en">

<head>
  <?php require_once File_Path::head(); ?>
  <link rel="stylesheet" href="../css/home.css" />
  <link rel="stylesheet" href="../css/quickview.css" />
  <title>
    <?php echo $pageTitle; ?>
  </title>
</head>

<body>
  <div id="header">
    <?php require_once 'user_header.php'; ?>
  </div>

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


  <div id="overlay">
    <main id="all-container">
      <!-- <div class="swiper products-slider">
    <div class="swiper-wrapper"> -->
      <section class="container-prod">
        <div class="list-cards">
          <?php

          switch (true) {
            case (!isset($_GET) || empty($_GET)): //case 1
              $fetch_produto = ProdutosDAO::listarProdutos();
              if (count($fetch_produto) > 0) {
                foreach ($fetch_produto as $prod) {
                  $prodimg = explode(",", $prod['image']);
                  $preco = number_format($prod['preco'], 2, ',', '.');
                  $prod_link = cleaner::cleanURL($prod['nome']);
                  // $prod['max_prest'];
          ?>

          <div class="cards-items">
            <div class="wishlist_heart">
              <!-- <span data-code="2I2-5019-322" data-device="desktop" data-department="depart" data-template="pdp" data-category="informatica" data-href="&amp;page="> -->
              <i class="fas fa-heart"></i>
            </div>
            <div id="peek-prod" onclick="peekProd(this);"><i class="fas fa-eye"></i>
            </div>

            <a title="<?php echo $prod['nome']; ?>" href="<?php echo "produto.php?id=$prod[codProduto]"; ?>">
              <img src="<?php echo $prodimg[0]; ?>" alt="" class="products-imgs" />
            </a>

            <a title="<?php echo $prod['nome']; ?>" href="<?php echo "produto.php?id=$prod[codProduto]"; ?>">

              <!-- href="<php echo Redirect::directory($_SERVER['PHP_SELF']) . "/produto/$prod[codProduto]/$prod_link"; ?>" onclick=""> -->
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
            <?php require 'quickview.php'; ?>
          </div>
          <?php
                }
              } else {
                $error[] = 'Nenhum produto foi encontrado!';
                $error[] = '../image/error/th-1517709978.jpg';
                $error[] = 'Não se preocupe estamos trabalhando nisso!';
              }
              break;
            case (isset($_GET['str']) || isset($_GET['category'])): //case 2
              require_once 'page.php';
              break;
            case (empty($_GET['str']) || empty($_GET['category'])): //case 3
              $error[] = 'Nenhum produto foi encontrado!';
              break;
            // case ():
            //   break;
            default:
              $error[] = 'Talvez o que você procura não esteja aqui. <br> talvez...!';
              $error[] = '../image/error/th-1517709978.jpg';
          } // switch ends +++++++++++++++++++++++++++++++++++++
          // var_dump(array_key_first($_GET)); //debug
          // var_dump($_GET); //debug
          ?>
        </div>
      </section>
    </main>
  </div>

  <?php
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

  <?php require_once Redirect::directory($_SERVER['PHP_SELF']) . '/footer.html'; ?>

  <script src="../js/swiper-bundle.min.js"></script>

  <script src="../js/script.js"></script>

</body>

</html>