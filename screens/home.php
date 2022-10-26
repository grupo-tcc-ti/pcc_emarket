<?php
    include '../components/connect.php';
    session_start();
    if ( isset( $_SESSION['user_id'] ) ) {
        $user_id = $_SESSION['user_id'];
    } else {
        $user_id = '';
    }
    // include '../components/wishlist_card.php';
?>

<!DOCTYPE html>
<html lang="pt-br, en">

  <head>
    <meta charset="UTF-8" />
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
      crossorigin="anonymous"> </script>
    <title>Emarket</title>
  </head>

  <?php include '../screens/header.php';?>
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
        <?php //include '../screens/vitrine_teste.html'; ?>
      </section>

  <div id="overlay">
  <main id="all-container">
  <!-- <div class="swiper products-slider">
  <div class="swiper-wrapper"> -->
  <section class="container-prod">
    <div class="list-cards">
      <?php
          $pdo = Connect::getInstance();
          // $qry="SELECT * FROM `produtos` LIMIT 4";
          $qry = "SELECT * FROM `produtos`";
          // $produtos= $conn->query($qry);
          $produtos = $pdo->prepare( $qry );
          $produtos->execute();
          if ( $produtos->rowCount() > 0 ) {
              while ( $fetch_produto = $produtos->fetch( PDO::FETCH_ASSOC ) ) {
                  // $fetch_prodimg = explode(",", trim($fetch_produto['image'], "./"));
                  $fetch_prodimg = explode( ",", $fetch_produto['image'] );
              ?>
        <div class="cards-items">
          <button type="submit" class="fas fa-heart"
            name="addListadesejo"></button>
          <a href="espiar_produto.php?id=<?=$fetch_produto['codProduto'];?>"
            class="fas fa-eye"></a>
          <a href="gotoproductpage.php">
            <img src="<?=$fetch_prodimg[0];?>" alt=""
            class="products-imgs">
            <div class="products-name"><?=$fetch_produto['nome'];?></div>
            </a>
            <div class="flex">
              <div class="cards-price"><span>R$ </span><?=$fetch_produto['preco'];?></div>
                <form action="" method="post">
                  <input type="hidden" name="id" value="<?=$fetch_produto['codProduto'];?>"></input>
                  <input type="hidden" name="nome" value="<?=$fetch_produto['nome'];?>"></input>
                  <input type="hidden" name="preco" value="<?=$fetch_produto['preco'];?>"></input>
                  <input type="hidden" name="image" value="<?=$fetch_prodimg[0];?>"></input>
                  <input type="number" name="qty" id="" class="qty"
                  min="1" max="99"
                  onkeypress="if(this.value> 2) return false;" value="1">
              </div>
                  <input type="submit" value="Adicionar ao Carrinho"
                  name="add_carrinho" class="buy-btn">
                </form>
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

      <?php include '../screens/footer.php';?>

  <script src="../js/script.js"></script>

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
  </body>
</html>