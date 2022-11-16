<?php
  require_once '../model/dao/ProdutosDAO.php';
  if (!isset($pdo) ) {
    include_once '../model/connect.php';
  }
  if (!isset($header) ) {
    $header = 1;
  }
  // require_once '../model/dao/UsuariosDAO.php';
  // require_once '../model/dto/UsuariosDTO.php';
  if (isset($_GET['logout']) ) {
    include_once '../controller/admin_logoutControl.php';
    Redirect::page('home.php', 1);
  exit();
  }
?>

<div class="header">
  <header class="container">
    <div class="logo-img">
      <a href="home.php"><img src="../image/logo.png" alt="logo" /></a>
    </div>
    <div class="categorias">
      <div class="dropdown">
        <button id="link-depart" onclick='clickDrop("depart")' class="btn">
          <span>Departamentos </span>
          <i class="fa-solid fa-chevron-down mob"></i>
          <i class="fas fa-bars norm"></i>
        </button>
        <nav id="depart" class="dropdown-content">
          <ul class="cat cat-main">
            <li class="cat-li"><a href="<?php echo $_SERVER['PHP_SELF'];?>?category=Promoções">Promoções</a></li>
            <li class="cat-li"><a href="<?php echo $_SERVER['PHP_SELF'];?>?category=Kit Upgrade">Kit Upgrade</a></li>
            <li class="cat-li"><a href="<?php echo $_SERVER['PHP_SELF'];?>?category=Cabos e Acessórios">Cabos e Acessórios</a></li>
            <li class="cat-li"><a href="<?php echo $_SERVER['PHP_SELF'];?>?category=PC Gamer">PC Gamer</a></li>
            <li class="cat-li"><a href="<?php echo $_SERVER['PHP_SELF'];?>?category=Hardware">Hardware</a></li>
            <li class="cat-li"><a href="<?php echo $_SERVER['PHP_SELF'];?>?category=Periféricos">Periféricos</a></li>
            <li class="cat-li"><a href="<?php echo $_SERVER['PHP_SELF'];?>?category=Gabinetes">Gabinetes</a></li>
            <li class="cat-li"><a href="<?php echo $_SERVER['PHP_SELF'];?>?category=Refrigeração">Refrigeração</a></li>
            <li class="cat-li"><a href="<?php echo $_SERVER['PHP_SELF'];?>?category=Diversos">Diversos</a></li>
            <li class="cat-li"><a href="<?php echo $_SERVER['PHP_SELF'];?>?category=Processador">Processador</a></li>
            <li class="cat-li"><a href="<?php echo $_SERVER['PHP_SELF'];?>?category=Placa de Vídeo">Placa de Vídeo</a></li>
          </ul>
          <!-- <form action="../view/categoria.php" method="get"> -->
          <!-- <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get"> 
            <input type="submit" name="str" value="Promoções">
            <input type="submit" name="str" value="Kit Upgrade">
            <input type="submit" name="str" value="Cabos e Acessórios">
            <input type="submit" name="str" value="PC Gamer">
            <input type="submit" name="str" value="Hardware">
            <input type="submit" name="str" value="Periféricos">
            <input type="submit" name="str" value="Gabinetes">
            <input type="submit" name="str" value="Refrigeração">
            <input type="submit" name="str" value="Diversos">
            <input type="submit" name="str" value="Processador">
            <input type="submit" name="str" value="Placa de Vídeo">
          </form> -->
        </nav>
      </div>
    </div>
    <div class="searchbar">
      <button
        id="link-search"
        onclick='clickDrop("dropsearch")'
        class="btn norm"
        aria-label="botao buscar"
      >
        <i class="fas fa-search"></i>
      </button>
      <!-- <form class="search-form" method="get" action="../view/busca.php"> -->
      <form class="search-form" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <nav id="dropsearch" class="nav-search">
          <input
            type="search"
            name="str"
            maxlength="100"
            class="isearch"
            autocomplete="off"
            aria-label="campo de busca"
            placeholder="Pesquise o seu produto"
            required
          />
          <input
            type="submit"
            class="btn"
            aria-label="botao buscar"
            value="buscar"
          />
        </nav>
      </form>
    </div>
    <div class="nav-conta">
      <div class="dropdown">
        <button id="link-conta" onclick='clickDrop("dropconta")' class="btn">
          <span>Conta &nbsp;</span>
          <i class="fa-regular fa-user icon"></i>
        </button>
        <nav id="dropconta" class="dropdown-content">
          <?php
            if (!isset($_SESSION['client_id']) ) {
                ?>
          <a href="<?php echo Path_Locale::conta(); ?>">Login</a>
          <a href="<?php echo Path_Locale::conta().'?register'; ?>"
            >Registrar</a
          >
                <?php
            } else {
                ?>
          <a href="minha_conta.php">Minha conta</a>
          <a
            href="<?php echo '?logout'; ?>"
            onclick="return confirm('Você deseja sair?');"
            >Logout</a
          >
                <?php
            }
            if (isset($_SESSION["admin_id"]) ) {
                ?>
          <a href="../admin/admin_login.php">Admin Panel</a>
                <?php
            }
            ?>
        </nav>
      </div>
    </div>
    <div class="nav-cart">
      <div class="dropdown">
        <button id="link-carrinho" onclick='clickDrop("carrinho")' class="btn">
          <span>Carrinho &nbsp;</span>
          <i class="fas fa-shopping-cart icon"></i>
        </button>
        <nav id="carrinho" class="dropdown-content-cart">
          <div class="dropdown-menu">
            <div class="cart-header">
              <i class="fas fa-shopping-cart" aria-hidden="true"></i>
              <span class="badge badge-pill badge-danger">


                <?php
                if (isset($_SESSION['cart-size']) ) {
                    echo $_SESSION['cart-size'];
                } else {?>
                <!-- 0 -->
                <?php }?>
              </span>
              <div class="total-section">
                <p>Total: <span class="text-info">$1,337.69</span></p>
              </div>
            </div>
            <?php
              $fetch_produto = ProdutosDAO::listarProdutos();
            if (is_array($fetch_produto) ) {
                foreach ( $fetch_produto as $prod ) {
                    $prodimg               = explode(",", $prod['image']);
                    $_SESSION['cart-size'] = count($fetch_produto);
                    ?>
            <div class="row cart-detail">
              <div class="cart-detail-img">
                <img src="<?php echo $prodimg[0]; ?>" />
              </div>
              <div class="cart-detail-product">
                <p>
                    <?php echo $prod['nome']; ?>
                </p>
                <span class="price text-info">R$
                    <?php echo $prod['preco']; ?>
                </span>
              </div>
            </div>
            <hr />
                    <?php
                }
            } else {
                echo '<p class="vazio">Nenhum produto foi encontrado!</p>';
            }
            ?>


            <div class="checkout">
              <button class="btn">Fechar Pedido</button>
            </div>
          </div>
        </nav>
      </div>
    </div>
    <div class="colorScheme">
      <button id="darkmode" class="btn">
        <i class="fas fa-circle-half-stroke"></i>
      </button>
    </div>
  </header>
</div>
<div class="totop">
  <a href="#top">
    <i class="fas fa-chevron-up"></i>
  </a>
</div>
