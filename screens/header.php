    <?php 
        if (isset($mensagem)){
            foreach($mensagem as $mensagem){
                echo
                '<div class="mensagem">
                    <span>'.$mensagem.'</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>';
            }
        }
    ?>
    <header class="header">
        <div class="flex">
            <ul>
                <li>
                    <img src="../image/logo.png" class="logo-img" alt="logo">
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
                        <!-- <a id="link-conta" onclick='clickDrop("conta")' class="btn"> -->
                        <button id="link-conta" onclick='clickDrop("conta")' class="btn">
                        <span>conta</span>
                        <!-- <div class="icons"><i class="fa-regular fa-user"></i></div> -->
                        <i class="fa-regular fa-user"></i>
                        </button>
                        <nav id="conta" class="dropdown-content">
                            <a href="screens/login_page.html">Minha conta</a>
                            <a href="screens/login_page.html">Registrar</a>
                        </nav>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <!-- <a id="link-carrinho" onclick='clickDrop("carrinho")' class="btn"> -->
                        <button id="link-carrinho" onclick='clickDrop("carrinho")' class="btn">
                            <span>carrinho</span>
                            <!-- <div class="icons"><i class="fas fa-shopping-cart"></i></div> -->
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