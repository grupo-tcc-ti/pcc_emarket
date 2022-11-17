<?php
  session_start();
  require_once '../model/connect.php';
  require_once '../model/dao/ProdutosDAO.php';
  require_once '../model/dto/ProdutosDTO.php';
  ( isset($_SESSION['client_id']) ) ?
  $user_id = $_SESSION['client_id']
  : '';
  (!isset($pageTitle)) ? $pageTitle = 'Emarket' : $pageTitle ;
  // require_once '../components/wishlist_card.php';
  require_once '../controller/navigationControl.php';
?>

<!DOCTYPE html>
<html lang="pt-br, en">
  <head>
    <?php require_once Path_Locale::head();?>
    <link rel="stylesheet" href="../css/home.css" />
    <link rel="stylesheet" href="../css/quickview.css" />
    <script src="../js/script.js"></script>
    <title><?php echo $pageTitle;?></title>
  </head>

  <?php require_once Path_Locale::user_header();?>
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
    if (!isset($_GET['str']) && !isset($_GET['category'])) {
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
        foreach ( $fetch_produto as $prod ) { 
          $prodimg = explode(",",$prod['image']);
          $preco = number_format($prod['preco'], 2,',', '.');
          // $prod['max_prest'];
    ?>
      <div class="cards-items">
        <a type="submit" class="fas fa-heart" name="addListadesejo"></a>
        <!-- <a
          href="espiar_produto.php?id=<php echo $prod['codProduto']; ?>"
          class="fas fa-eye"
        ></a> -->
        <button
          id="peek-prod"
          onclick="return peekProd();"
        ><i class="fas fa-eye"></i>
      </button>
        <a
          title="<?php echo $prod['nome']; ?>"
          href="../view/page.php/<?php echo $prod['nome']; ?>"
        >
          <img
            src="<?php echo $prodimg[0]; ?>"
            alt=""
            class="products-imgs"
          />
        </a>

        <a
          title="<?php echo $prod['nome']; ?>"
          href="../view/page.php/<?php echo $prod['nome']; ?>"
        >
          <div class="products-name">
            <?php echo $prod['nome']; ?>
          </div>
        </a>

        <div class="cards-price">
          <div class="old-price">
            de <em><?php echo $preco;?></em> por: 
          </div>
          <div class="price">
            R$ <?php 

            $new_price = ($prod['preco'] * 0.90);
            // var_dump($new_price);
            // $new_price = number_format($new_price, 2,',', '.');
            echo number_format($new_price, 2,',', '.');
            ?>
            <span> à vista</span>
            <div class="price-opt">
              <!-- <small> ou em 12x de R$ <php echo ($new_price / 12);?> <i>sem juros</i> </small> -->
              <small> ou em 12x de R$ <?php echo number_format($new_price / 12, 2,',', '.');?> <i>sem juros</i> </small>
            </div>
          </div>
        </div>

        <!-- <form action="" method="post">
        <input type="hidden" name="id" value="<php echo $prod['codProduto']; ?>"></input>
        <input type="number" name="qty" id="" class="qty"
        min="1" max="99" onkeypress="if(this.value> 2) return false;" value="1">
        <input type="submit" value="Adicionar ao Carrinho"
        name="add_carrinho" class="buy-btn">
      </form> -->

        <!-- <div class="buy-btn">
          <a value="Comprar" name="add_carrinho">Adicionar ao Carrinho</a>
        </div> -->
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
    } else if (empty($_GET['str']) || empty($_GET['category'])) {
      $error[] = 'Talvez o que você procura não esteja aqui. <br> talvez...!';
    } 
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
        echo '<div class="thrown-error">'; foreach ($error as $obj) { 
          if (str_contains($obj, '/image')) {
              echo ' <p class="vazio"><img src="'.$obj.'" alt="" /></p> '; 
          } else {
              echo ' <p class="vazio">'.$obj.'</p> '; 
          } 
      } echo '</div>'; 
    } 
    ?>

    <?php require_once '../view/footer.html';?>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>


    <!-- <script>
    var swiper = new Swiper(".home-slider", {
      loop:true,
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        clickable:true,
      },
    });

    var swiper = new Swiper(".category-slider", {
      loop:true,
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        clickable:true,
      },
      breakpoints: {
        0: {
            slidesPerView: 2,
          },
        650: {
          slidesPerView: 3,
        },
        768: {
          slidesPerView: 4,
        },
        1024: {
          slidesPerView: 5,
        },
      },
    });

    var swiper = new Swiper(".products-slider", {
      loop:true,
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        clickable:true,
      },
      breakpoints: {
        550: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    });
  </script> -->

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
