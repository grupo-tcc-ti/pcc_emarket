<?php
session_start();
require_once '../model/connect.php';
require_once '../model/dao/ProdutosDAO.php';
require_once '../model/dao/UsuariosDAO.php';
// include aqui!


if (isset($_POST['add_produto'])) {
    ProdutosDAO::cadastrarProduto($_POST['nome'], $_POST['descricao'], $_POST['preco'], $_FILES['image']);
}

if (isset($_POST['alterar_prod'])) {
    $_SESSION['codProduto'] = $_POST['alterar_prod'];
    Redirect::page('alterar_produto.php', 0);
}

if (isset($_POST['deletar_prod'])) {
    ProdutosDAO::deletarProduto($_POST['deletar_prod']);
}

require_once Path_Locale::admin_header();
?>

<!DOCTYPE html>
<html lang="pt, en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_stylesheet.css">
    <title>Cadastro de Produtos</title>
</head>

<body>
    <!-- <php require_once Path_Locale::admin_header();?> -->


    <!-- <section class="add-produtos"> -->
    <section class="form-container">
        <!-- style="display: none;"> -->
        <form class="add-produto" action="" name="add_produto_form" method="POST" enctype="multipart/form-data">
            <!-- onsubmit="return clearForm(this)" -->
            <h1 class="heading">Adicionar Produto</h1>
            <!-- <h3>Adicionar Produto</h3> -->
            <div class="flex">
                <div class="inputbox">
                    <span class="title required-field">Nome do Produto</span>
                    <input type="text" name="nome" class="box" required
                        placeholder="Ex.: Placa de Vídeo Nvidia Geforce RTX..." maxlength="200">
                </div><br>
                <div class="inputbox">
                    <span class="title required-field">Preço do Produto</span>
                    <input type="number" name="preco" class="box" required placeholder="Ex.: R$ 3,999.00" min="0"
                        max="9999999999" step="any" onclick="if(this.value.length == 100) return false;">
                </div><br>
                <div class="inputbox">
                    <span class="title required-field">Imagens</span>
                    <!-- <label for="input-file" class="btn">Enviar Imagens</label> Implementar mais coisas depois-->
                    <input type="file" name="image[]" class="box" id="input-file" required
                        accept="image/jpg, image/jpeg, image/png, image/webp" multiple>
                </div><br>
                <div class="inputbox">
                    <span class="title required-field">Descrição do Produto</span>
                    <textarea name="descricao" class="box" cols="50" rows="10" required
                        placeholder="Descrições do produto (Max.: 1500 char.)" maxlength="1500"></textarea>
                </div><br>
                <input type="submit" value="Adicionar Produto" name="add_produto" class="btn">
            </div>
        </form>
    </section>

    <h3 class="head-list">Lista de Produtos</h3>
    <section class="mostrar-produtos">
        <?php
            $mostrar_prods = $pdo->prepare("SELECT * FROM  `produtos`");
            $mostrar_prods->execute();
            if ($mostrar_prods->rowCount() > 0) {
                while ($fetch_prod = $mostrar_prods->fetch(PDO::FETCH_ASSOC)) {
                    $fetched_imgs = explode(",", $fetch_prod['image']);
            ?>
        <div class="box">
            <img src='<?php echo $fetched_imgs[0]; ?>' alt="">
            <div class="nome">
                <?php echo $fetch_prod['nome']; ?>
            </div>
            <div class="preco">R$
                <?php echo $fetch_prod['preco']; ?>
            </div>
            <div class="descricao">
                <?php echo $fetch_prod['descricao']; ?>
            </div>
            <form action="" method="POST" name="prod_mgmt" class="prod_mgmt">
                <div class="flex-btn">
                    <button type="submit" name="alterar_prod" value="<?php echo $fetch_prod['codProduto']; ?>"
                        class="option-btn" onclick="return confirm('Fazer alterações neste produto?');">Alterar</button>
                </div>
                <div class="flex-btn">
                    <!-- Aproach #1 -->
                    <!-- <a href='produtos.php?deletar_prod=<?php echo $fetch_prod['codProduto']; ?>' class="delete-btn"
                    onclick="return confirm('Deseja mesmo excluir o produto?');">
                    Deletar</a> -->
                    <!-- Aproach #2 -->
                    <button type="submit" name="deletar_prod" value="<?php echo $fetch_prod['codProduto']; ?>"
                        class="delete-btn" onclick="return confirm('Deseja mesmo excluir o produto?');">Deletar</button>
                </div>
            </form>
        </div>
        <?php
                }
            } else {
                echo '<p class="vazio">Nenhum produto adicionado...</p>';
            }
            ?>
    </section>


    <script src="../js/admin_script.js"></script>
</body>

</html>
<!-- 
    https://www.amazon.com/LG-43NANO75UPA-Alexa-Built-NanoCell/dp/B08WHSH4JH/ref=sr_1_1?crid=2HCT7TB38NMWH&keywords=smart+tv&qid=1664969634&qu=eyJxc2MiOiI2Ljk3IiwicXNhIjoiNi42MCIsInFzcCI6IjUuOTUifQ%3D%3D&refinements=p_36%3A8589204011&rnid=8589203011&s=tv&sprefix=smart+t%2Caps%2C253&sr=1-1
    https://www.amazon.com/-/pt/dp/B096BK7W5M/ref=sr_1_6?keywords=smartwatch&qid=1665190856&qu=eyJxc2MiOiI2LjY1IiwicXNhIjoiNS44MSIsInFzcCI6IjQuNTMifQ%3D%3D&refinements=p_36%3A1253506011&rnid=386442011&s=electronics&sprefix=smat%2Celectronics%2C332&sr=1-6
-->