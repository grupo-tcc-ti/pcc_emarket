<?php
  session_start();
  require_once '../model/connect.php';
  require_once '../model/dao/ProdutosDAO.php';
  (isset($_SESSION['client_id']))?
  $user_id = $_SESSION['client_id']
  :'';
  // include '../components/wishlist_card.php';
?>

<!DOCTYPE html>
<html lang="pt-br, en">

  <head>
    <!-- <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../css/style.css" />
    <link rel="shortcut icon" href="../image/favicon.ico"
      type="../image/x-icon"/>
    <script src="https://kit.fontawesome.com/5e9d92adc0.js"
      crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
      integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
      crossorigin="anonymous"> </script> -->
    <?php 
    //isso é só um teste,
    //também pode servir para usar uma css de svg caso não tenha conectividade com o site fontawesome
    require_once Path_Locale::head(); ?>
    <title>Emarket</title>
  </head>

  <?php require_once Path_Locale::user_header(); ?>
    <body>

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
          </div>
        </div>
      </section>

      <section>
        <?php //include '../view/vitrine_teste.html'; ?>
      </section>

  <div id="overlay">
  <main id="all-container">
  <!-- <div class="swiper products-slider">
  <div class="swiper-wrapper"> -->
  <section class="container-prod">
    <div class="list-cards">
      <?php
        $fetch_produto = ProdutosDAO::listarProdutos();
        if (is_array($fetch_produto)) {
        foreach ($fetch_produto as $prod) {
          $prodimg = explode(",", $prod['image']);
      ?>
        <div class="cards-items">
          <a type="submit" class="fas fa-heart"
            name="addListadesejo"></a>
          <a href="espiar_produto.php?id=<?php echo $prod['codProduto'];?>"
            class="fas fa-eye"></a>
          <a href="gotoproductpage.php">
            <img src="<?php echo $prodimg[0];?>" alt=""
            class="products-imgs">
            <div class="products-name"><?php echo $prod['nome'];?></div>
            </a>
            <div class="cards-price">
              R$ <?php echo $prod['preco'];?> 
            </div>
          <!-- <form action="" method="post">
              <input type="hidden" name="id" value="<?php echo $prod['codProduto'];?>"></input>
              <input type="number" name="qty" id="" class="qty"
              min="1" max="99" onkeypress="if(this.value> 2) return false;" value="1">
              <input type="submit" value="Adicionar ao Carrinho"
              name="add_carrinho" class="buy-btn">
            </form> -->
            <div class="buy-btn">
              <a value="Comprar"
              name="add_carrinho">Adicionar ao Carrinho</a>
            </div>
        </div>
                <?php
            }
        } else {
            echo '<p class="vazio">Nenhum produto foi encontrado!</p>';
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
  // require_once '../view/footer.php';
  require_once '../view/footer.html';
  ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="../js/script.js"></script>

  <script>
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
  </script>
  </body>
</html>
