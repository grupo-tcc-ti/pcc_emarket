<?php 
  // page_test
?>

<section class="produtos">
  <div class="container">
    <div class="header-content">
      <h3>
        Resultados para: &nbsp;<span><?php echo $nav_label;?></span>
      </h3>
    </div>
    <div class="products-list">
      <div class="filters">filtro aqui</div>
      <div class="prodarea">
        <?php 
        if (isset($section) && count($section) > 0) {
          foreach ($section as $prod) {
            $prodimg = explode(",",$prod['image']);
            echo $prod['nome']; echo '
              <img
              src="'.$prodimg[0].'"
              alt=""
              class="products-imgs"
              style="height: 100px; width: 100px"
              />
            '; 
            echo 'R$'.$prod['preco']; echo '<br />'; 
          } 
        } else {
          echo ' <p class="vazio">Nenhum produto foi encontrado!</p> ';
        }
        ?>
      </div>
    </div>
  </div>
</section>
