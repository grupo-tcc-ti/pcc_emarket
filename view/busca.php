<?php 
session_start();
require_once '../model/connect.php';
require_once '../model/dao/ProdutosDAO.php';
require_once '../model/dto/ProdutosDTO.php';
(isset($_SESSION['client_id']))?
$user_id = $_SESSION['client_id']
:'';
if (isset($_GET['str']) && !empty($_GET['str'])) {
    $search = [];
    $produtos = new ProdutosDTO;
    $produtos->setNome($_GET['str']); $search =
    ProdutosDAO::pesquisarProduto($produtos); 
} else { $_GET['str'] = 'nada
encontrado!'; 
} ?>

<!DOCTYPE html>
<html lang="pt-br, en">
  <head>
    <!-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <?php require_once Path_Locale::head();?>
    <title>Busca: <?php echo $_GET['str']; ?> - Techgrifo</title>
  </head>
  <?php 
    require_once Path_Locale::user_header();
    // require_once '../controller/searchControl.php';
    ?>
  <body>
    <!-- <div id="products-search"> -->
    <section class="produtos">
      <div class="container">
        <div class="header-content">
          <h3>
            Resultados da busca para: &nbsp;<span
              ><?php echo $_GET['str'];?></span
            >
          </h3>
        </div>
        <div class="products-list">
          <div class="filters">filtro aqui</div>
          <div class="prodarea">
            <?php 
            if (isset($search) && count($search) > 0) 
            { foreach ($search as $prod) { $prodimg = explode(
                    ",",
                $prod['image']
                    ); echo $prod['nome']; echo '<img
              src="'.$prodimg[0].'"
              alt=""
              class="products-imgs"
              style="height: 100px; width: 100px"
            />'; echo 'R$'.$prod['preco']; echo '<br />'; 
            } 
            } else { echo
                'Nenhum produto foi encontrado!'; 
            } ?>
          </div>
        </div>
      </div>
    </section>
    <!-- </div> -->
    <?php require_once '../view/footer.html'; ?>
    <script src="../js/script.js"></script>
  </body>
</html>
