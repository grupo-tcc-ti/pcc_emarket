<?php
if (!isset($pdo)) {
  include_once '../model/connect.php';
}
// if (!isset($user_id)) {
//   $user_id = $_SESSION['client_id'];
// }

if (isset($_GET['logout'])) {
  include_once '../controller/logoutControl.php';
}

require_once '../controller/cartControl.php'; // important!

$categorias = array(
  'Promoções',
  'Kit Upgrade',
  'Cabos e Acessórios',
  'PC Gamer',
  'Hardware',
  'Periféricos',
  'Gabinetes',
  'Refrigeração',
  'Diversos',
  'Processador',
  'Placa de Vídeo'
);
?>

<div class="header">
  <header class="container">
    <div class="logo-img">
      <!-- <a href="home.php"><img src="../image/logo.png" alt="logo" /></a> -->
      <a href="<?php echo Redirect::directory($_SERVER['PHP_SELF']); ?>"><img src="../image/logo.png" alt="logo" /></a>
    </div>
    <div class="categorias">
      <div class="dropdown">
        <button id="link-depart" onclick='clickDrop("depart")' class="btn">
          <span>Departamentos </span>
          <i class="fa-solid fa-chevron-down mob"></i>
          <i class="fas fa-bars norm"></i>
        </button>
        <nav id="depart" class="dropdown-content">

          <div class="nav-wrapper">
            <form action="" method="get">
              <?php
              foreach ($categorias as $cat) {
                // var_dump($cat); //debug
                echo '<button class="send" type="submit" name="category" value="' . strtolower(cleaner::removeSpecialChars($cat)) . '">' . $cat . '</button>';
              }
              echo '</form>';
              ?>
          </div>
        </nav>
      </div>
    </div>
    <div class="searchbar">
      <button id="link-search" onclick='clickDrop("dropsearch")' class="btn norm" aria-label="botao buscar">
        <i class="fas fa-search"></i>
      </button>
      <form class="search-form" method="get" action="">
        <nav id="dropsearch" class="nav-search">
          <input type="search" name="str" maxlength="100" class="isearch" autocomplete="off" aria-label="campo de busca"
            placeholder="Pesquise o seu produto" required />
          <input type="submit" class="btn" aria-label="botao buscar" value="buscar" />
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
          if (!isset($_SESSION['client_id'])) {
          ?>
          <a href="<?php echo File_Path::conta(); ?>">Login</a>
          <a href="<?php echo File_Path::conta() . '?register'; ?>">Registrar</a>
          <?php
          } else {
          ?>
          <a href="minha_conta.php">Minha conta</a>
          <a href="<?php echo '?logout'; ?>" onclick="return confirm('Você deseja sair?');">Logout</a>
          <?php
          }
          if (isset($_SESSION["admin_id"])) {
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
        <nav id="carrinho" class="dropdown-content cart">
          <div class="dropdown-menu">


            <?php
            if (isset($_SESSION['client_id']['id'])) {
            ?>
            <div class="cart-header">
              <div class="total-qty">
                <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                <span>
                  <?php echo $cartTotal['qty']; ?>
                </span>
              </div>
              <div class="price total-price">
                <p>Total: <span>R$</span>&nbsp;
                  <?php echo $cartTotal['price']; ?>
                </p>
              </div>
            </div>

            <!-- +++++++++Carrinho_starts+++++++++ -->
            <form action="" method="post" class="checkout">
              <?php
              //cartControl.php
              if (count($fetchCart) > 0) {
                foreach ($fetchCart as $prod) {
                  $prodimg = explode(",", $prod['image']);
                  // echo var_dump($prod['codProduto']) . '<br>'; //debug
              ?>
              <div class="prod-wrapper">
                <div class="cart-del-btn">
                  <button type="submit" name="del_cart_item">
                    <i class="fas fa-multiply"></i>
                  </button>
                </div>
                <div class="cart-info">
                  <div class="cart-img">
                    <img src="<?php echo $prodimg[0]; ?>" />
                  </div>
                  <div class="cart-title">
                    <?php echo $prod['nome']; ?>
                  </div>
                </div>
                <div class="cart-info price">
                  <div class="item-price"><span>R$</span>&nbsp;
                    <?php echo $prod['preco']; ?>
                  </div>
                  <div class="item-qty">x
                    <?php echo $prod['quantidade']; ?>
                  </div>
                </div>
              </div>
              <div class="divisor">
                <hr>
              </div>
              <!-- +++++++++Foreach_ends+++++++++ -->
              <?php } ?>
              <div class="checkout-btn">
                <button type="submit" class="btn" name="checkout" value="true">Fechar Pedido</button>
                <button type="submit" class="btn" name="del_cart" value="true">Esvaziar Carrinho</button>
              </div>
              <input type="hidden" name="pid" value="<?php echo $prod['codProduto']; ?>"></input>
              <input type="hidden" name="client_cart">
            </form>
            <!-- +++++++++Carrinho_starts+++++++++ -->
            <?php
              } else {
                echo '<p class="vazio">Carrinho vazio!</p>';
              }
            ?>
            <?php } else {
            ?>
            <a href="conta.php?register">Crie sua conta!</a>
            <?php } ?>
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