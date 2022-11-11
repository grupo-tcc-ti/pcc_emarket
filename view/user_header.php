<?php
    if (!isset($pdo)) {
        include_once '../model/connect.php';
    }
    require_once '../model/dao/UsuariosDAO.php';
    require_once '../model/dto/UsuariosDTO.php';
    if(isset($_GET['logout'])) {
        include_once '../controller/admin_logoutControl.php';
        Redirect::page('home.php', 1);
        exit();
    }
?>
<div id="header">
    <header class="header">
            <div class="flex">
                <ul>
                    <li>
                        <a href="home.php"><img src="../image/logo.png" class="logo-img" alt="logo"></a>
                    </li>   
                    <li>
                        <div class="dropdown">
                            <button id="link-depart" onclick='clickDrop("depart")' class="btn">
                                <span>Departamento</span>
                            <i class="fa-solid fa-chevron-down"></i>
                            <i class="fas fa-bars"></i>
                            </button>
                            <nav id="depart" class="dropdown-content">
                                <a href="#">Promoções</a>
                                <a href="#">Kit Upgrade</a>
                                <a href="#">Cabos e Acessórios</a>
                                <a href="#">PC Gamer</a>
                                <a href="#">Hardware</a>
                                <a href="#">Periféricos</a>
                                <a href="#">Gabinetes</a>
                                <a href="#">Refrigeração</a>
                                <a href="#">Diversos</a>
                            </nav>
                        </div>
                    </li>
                    <li>
                        <form class="pesquisa" action="#" method="get">
                            <input id="isearch" type="search" name="str" required="" class="busca" autocomplete="off"
                                aria-label="campo de busca" placeholder="Pesquise o seu produto">
                                <button id="link-search" class="btn" aria-label="botao buscar">
                                    <!-- <div class="icons"><i class="fas fa-search"></i></div> -->
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                    </li>
                    <li>
                        <div class="dropdown">
                            <button id="link-conta" onclick='clickDrop("conta")' class="btn">
                            <span>conta</span>
                            <i class="fa-regular fa-user"></i>
                            </button>
                            <nav id="conta" class="dropdown-content">
                                <?php
                                if (!isset($_SESSION['client_id']['id']) ) {
                                    ?>
                                    <a href="conta.php">Login</a>
                                    <a href="conta.php?register">Registrar</a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="minha_conta.php">Minha conta</a>
                                    <!-- <a href="../controller/logoutControl.php" onclick="return confirm('Você deseja sair?');">Logout</a> -->
                                    <a href="<?php echo '?logout';?>" onclick="return confirm('Você deseja sair?');">Logout</a>
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
                    </li>
                    <li>
                        <div class="dropdown">
                            <button id="link-carrinho" onclick='clickDrop("carrinho")' class="btn">
                                <span>carrinho</span>
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                            <nav id="carrinho" class="dropdown-content">
                                <a href="#">Ver Carrinho</a>
                                <a href="#">Limpar Carrinho</a>
                            </nav>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
</div>

