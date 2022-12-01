<?php
require_once '../model/connect.php';
// require_once '../model/dao/ProdutosDAO.php';
//undo requirefolder if fails!
// F-ile_Path::requireFolder('../model/dao');
// F-ile_Path::requireFolder('../model/dto');
session_start();

//['admin_id'] no header
if (!isset($_SESSION['admin_id'])) {
    $admin_header = 'admin_login.php';
    header('location:../admin/' . $admin_header);
}
?>

<!DOCTYPE html>
<html lang="pt, en">

<head>
    <?php require_once File_Path::head(); ?>
    <link rel="stylesheet" href="../css/admin_stylesheet.css">
    <title>Alterar Cadastro de Produtos</title>
</head>

<body>
    <?php

//####### Alterar produto starts ###########################
if (isset($_POST['alterar'])) {
    ProdutosDAO::alterarProduto(
        $_POST['codProduto'],
        $_POST['nome'],
        $_POST['nome_anterior'],
        $_POST['descricao'],
        $_POST['preco'],
        $_FILES['image']
    );
}
//####### Alterar produto ends ###########################

//#######Voltar###########################
if (isset($_POST['voltar'])) {

    unset($_SESSION['codProduto']);
    Message::pop('Ate mais!');
    Redirect::page('produtos.php', 1);
    exit;
}
//#######Voltar###########################
?>

    <section class="alterar-produto">
        <h1 class="heading">Alterar Produto</h1>

        <?php //....::PHP::..... starts ..
    $alterar_id = $_SESSION['codProduto'];
    $mostrar_produtos = $pdo->prepare("SELECT * FROM  `produtos` WHERE codProduto = :cpid");
    $mostrar_produtos->bindParam(':cpid', $alterar_id);
    $mostrar_produtos->execute();
    // var_dump($_SESSION['codProduto']); //debug
    if ($mostrar_produtos->rowCount() > 0) {
        while ($fetch_produto = $mostrar_produtos->fetch(PDO::FETCH_ASSOC)) {
            !is_array($fetch_produto['image']) ? 
                $fetched_imgs = explode(",", $fetch_produto['image']) :
                $fetched_imgs = implode($fetch_produto['image']); ?>


        <form action="" method="post" enctype="multipart/form-data" class="" name="alterar_form">
            <input type="hidden" name="codProduto" value='<?php echo $fetch_produto['codProduto']; ?>'>
            <input type="hidden" name="nome_anterior" value='<?php echo $fetch_produto['nome']; ?>'>
            <input type="hidden" name="image" value='<?php echo $fetched_imgs; ?>'>
            <div class="image-container">
                <!-- Fazer script que rode as outras imagens -->
                <div class="main-image">
                    <!-- Colocar imagem principal aqui -->
                    <img src='<?php echo $fetched_imgs[0]; ?>' alt="">
                    <!-- width="200px" height="200px" -->
                </div>

                <?php //....::PHP::..... starts ..
            foreach (array_slice($fetched_imgs, 0) as $img) {
                //....::PHP::..... ends .. ?>
            <div class="sub-image">
                <!-- Colocar um image array aqui -->
                <img src='<?php echo $img; ?>' alt="">
            </div>
                <?php //....::PHP::..... starts ..
            }
            //....::PHP::..... ends .. ?>
        </div>
        <span>Nome</span>
        <input type="text" name="nome" id="" class="box required-field" required
        maxlength="200" placeholder="Insira o nome a ser alterado"
        value="<?php echo $fetch_produto['nome'] ?>"><br>

        <span>Novo Preço</span>
        <input type="number" name="preco" id="" class="box required-field" required 
        min="0" max="9999999999" step="any" placeholder="Insira um novo preço para o produto" 
        onkeypress="if(this.value.length == 10) return false;"
        value="<?php echo $fetch_produto['preco'] ?>"><br><br>
            
        <span>Alterar Descrição</span>
        <textarea name="descricao" id="" cols="30" rows="10"  required
        placeholder="Descrições do produto (Max.: 1500 char.)" maxlength="1500">
            <?php echo $fetch_produto['descricao'];
            //....::PHP::..... ends .. ?>
        </textarea><br>

        <span>Alterar Imagem(s)</span>
        <input type="file" name="image[]" id="" class="box required-field" multiple
        accept="image/jpg, image/jpeg, image/png, image/webp" ><br>

        <div class="flex-btn">
            <button type="submit" name="alterar" class="btn"
            >Alterar</button>
        </div><br>
    </form>
    <form action="" method="post">
        <button type="submit" name="voltar" class="option-btn"
        >Voltar</button>
    </form>
    
            <?php //....::PHP::..... starts ..
            // var_dump($alterar_id); //debug
            // unset($_SESSION['codProduto']);
        }
    } else {
        echo '<p class="vazio">Nenhum produto adicionado...</p>';
    }
    //....::PHP::..... ends ..
            ?>
    </section>

    <script src="../js/admin_script.js"></script>
</body>

</html>