<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

// $my_form = $_COOKIE["add_produto_form"];
// // decode from JSON
// $my_form = json_decode($my_form);
// // get single value
// $name = $my_form->name;
// print_r($name);

if (!isset($admin_id)) {
    header('location:../components/admin_header.php');
}

// Cadastrar produto ###################################################################
if (isset($_POST['add_produto'])) {
    $nome = $_POST['nome'];
    $nome = filter_var($nome, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $descricao = $_POST['descricao'];
    $descricao = filter_var($descricao, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $preco = $_POST['preco'];
    $preco = filter_var($preco, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $select_produtos = $conn->prepare("SELECT * FROM `produtos` WHERE nome = :nome");
    $select_produtos->bindParam(':nome', $nome);
    $select_produtos->execute();

    // $name_valid = $path_valid = $size_valid = false;

    //Verifica se produto com mesmo nome
    if ($select_produtos->rowCount() > 0) {
        $message[] = 'Um produto com o mesmo nome ja existe!';
        $name_valid = false;
    } else { $name_valid = true;}
    //continua procedimento
    $image = array();
    if ($_FILES['image']['error']==0){
        $prod_path = "../image/produtos_teste/";
        
        if (is_array($_FILES['image']['name'])){
            $total_imgfiles = count($_FILES['image']['name']); //Contar o numero de arquivos na array
        //Loop através da array image
            for ($i = 0; $i < $total_imgfiles; $i++) {
                $image[$i] = $prod_path.$_FILES['image']['name'][$i]; //O nome original do arquivo na máquina do cliente.
                // $image[$i] = array_filter($image[$i]);
                $image[$i] = filter_var($image[$i], FILTER_SANITIZE_FULL_SPECIAL_CHARS); //filtrar processo de arquivos e caracteres especiais
                //O caminho temporario do arquivos é armazenado
                //tmp_name O nome temporário com o qual o arquivo enviado foi armazenado no servidor.
                $image_tmp = $_FILES['image']['tmp_name'][$i];
                //Verifica se caminho vazio
                if ($image_tmp != "") {
                    //Configura novo caminho
                    $image_folder = $prod_path . $_FILES['image']['name'][$i];
                    //O arquivo e enviado ao caminho temporario
                    if (move_uploaded_file($image_tmp, $image_folder)) {$path_valid = true;}
                }
                //Verifica o tamanho do arquivo
                $image_size = $_FILES['image']['size'][$i]; //O tamanho, em bytes, do arquivo enviado.
                if ($image_size > 2000000) {
                    $message[] = 'Tamanho do arquivo é maior que o permitido!';
                    $size_valid = false;
                } else { $size_valid = true;}
            }
        } else {
            $image = $prod_path.$_FILES['image']['name'];
            $image = filter_var($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $image_tmp = $_FILES['image']['tmp_name'];
            if ($image_tmp != "") {
                //Configura novo caminho
                $image_folder = $prod_path . $_FILES['image']['name'];
                //O arquivo e enviado ao caminho temporario
                if (move_uploaded_file($image_tmp, $image_folder)) {$path_valid = true;}
            }
            //Verifica o tamanho do arquivo
            $image_size = $_FILES['image']['size']; //O tamanho, em bytes, do arquivo enviado.
            if ($image_size > 2000000) {
                $message[] = 'Tamanho do arquivo é maior que o permitido!';
                $size_valid = false;
            } else { $size_valid = true;}
        }
    }
    
    // else if ($_FILES['image']['error']==4){$path_valid = true; $size_valid = true;}
    // $path_valid = true; $size_valid = true;
    
    //Confirma se imagens validas
    if ($name_valid && $path_valid && $size_valid) {
        //Insere o produto
        $inserir_produto = $conn->prepare("INSERT INTO `produtos` (nome, descricao, preco, image)
    VALUES (:nome, :descricao, :preco, :image)");
        $inserir_produto->bindParam(":nome", $nome);
        $inserir_produto->bindParam(":descricao", $descricao);
        $inserir_produto->bindParam(":preco", $preco);
        $inserir_produto->bindValue(":image", is_array($image)?implode(',', $image):$image);
        $inserir_produto->execute();
        $message[] = 'Produto adicionado com sucesso!';
    }
}

// Deletar produto ###################################################################
if(isset($_GET['delete_prod'])){
    
    $delete_id = $_GET['delete_prod'];
    $del_prod_img = $conn->prepare("SELECT * FROM `produtos` WHERE codProduto = :id"); //_img
    $del_prod_img->bindParam(':id', $delete_id);
    $del_prod_img->execute();
    /* Unlink image from product*/
    $fetch_del_img = $del_prod_img->fetch(PDO::FETCH_ASSOC);
    if ($fetch_del_img['image']) {
        $fetched_imgs = explode(",", $fetch_del_img['image']);
        foreach ($fetched_imgs as $prod_img){
            // echo($prod_img);
            // unlink($prod_img);
            if(file_exists($prod_img)){
                echo($prod_img.':image_unlinked');
                // unlink($prod_img);
            }else{echo($prod_img.':no');}
        }
    }
    /* Delete produto db */
    $del_prod = $conn->prepare("DELETE FROM `produtos` WHERE codProduto = :id");
    $del_prod->bindParam(':id', $delete_id);
    $del_prod->execute();

    /* Delete produto cart and wishlist*/
    $del_prod_cart_wlist = $conn->prepare("DELETE FROM `carrinho` WHERE :fk_id = :id");
    $del_prod_cart_wlist = $conn->prepare("DELETE FROM `listadedesejo` WHERE :fk_id = :id");
    $del_prod_cart_wlist->bindParam(':id', $delete_id);
    $del_prod_cart_wlist->bindValue(':fk_id', 'produtos_codProduto');
    $del_prod_cart_wlist->execute();
    header('location: produtos.php');
}


?>

<!DOCTYPE html>
<html lang="pt-BR, en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <title>Cadastro de Produtos</title>
</head>
<body>
<?php include '../components/admin_header.php';?>


<section class="add-produtos">
    <form action="" name="add_produto_form" method="post" enctype="multipart/form-data" > <!-- onsubmit="return clearForm(this)" -->
        <h1 class="heading">Adicionar Produto</h1>
        <div class="flex">
            <div class="inputbox">
                <span class="prod-title required-field">Nome do Produto</span>
                <input type="text" name="nome" class="box" required
                placeholder="Ex.: Placa de Vídeo Nvidia Geforce RTX..." maxlength="100">
            </div><br>
            <div class="inputbox">
                <span class="prod-title required-field">Preço do Produto</span>
                <input type="number" name="preco" class="box" required
                placeholder="Ex.: R$ 3,999.00" min="0" max="9999999999" step="any" onclick="if(this.value.length == 100) return false;">
            </div><br>
            <div class="inputbox">
                <span class="prod-title required-field">Imagens</span>
                <!-- <label for="input-file" class="btn">Enviar Imagens</label> Implementar mais coisas depois-->
                <input type="file" name="image" class="box" id="input-file" required
                accept="image/jpg, image/jpeg, image/png, image/webp" multiple>
            </div><br>
            <div class="inputbox">
                <span class="prod-title required-field">Descrição do Produto</span>
                <textarea name="descricao" class="box" required cols="50" rows="10"
                placeholder="Descrições do produto (Max.: 1500 char.)" maxlength="1500" ></textarea>
            </div><br>
            <input type="submit" value="Adicionar Produto" name="add_produto" class="btn">
        </div>
    </form>
</section>

<h3 class="heading">Lista de Produtos</h3>
<section class="mostrar-produtos">
    <div class="box-container">
        <?php
    $mostrar_produtos = $conn->prepare("SELECT * FROM  `produtos`");
    $mostrar_produtos->execute();
    if ($mostrar_produtos->rowCount() > 0) {
        while ($fetch_produto = $mostrar_produtos->fetch(PDO::FETCH_ASSOC)) {
            $fetched_imgs = explode(",", $fetch_produto['image']);
            ?>
            <div class="box">
                <img src='<?=$fetched_imgs[0];?>' alt="">
                <div class="nome"><?=$fetch_produto['nome'];?></div>
                <div class="preco">R$ <?=$fetch_produto['preco'];?></div>
                <div class="descricao"><?=$fetch_produto['descricao'];?></div>
                <form action="" method="get" name="prod_mgmt" class="prod_mgmt">
                <div class="flex-btn">
                    <button type="submit" name="update_prod" value="<?=$fetch_produto['codProduto'];?>" class="option-btn"
                    onclick="return confirm('Você confirma as alterações?');"
                    >Alterar</button>
                </div>
                <div class="flex-btn">
                    <!-- Aproach #1 -->
                    <!-- <a href='produtos.php?delete_prod=<?=$fetch_produto['codProduto'];?>' class="delete-btn"
                    onclick="return confirm('Deseja mesmo excluir o produto?');">
                    Deletar</a> -->
                    <!-- Aproach #2 -->
                    <button type="submit" name="delete_prod" value="<?=$fetch_produto['codProduto'];?>" class="delete-btn"
                    onclick="return confirm('Deseja mesmo excluir o produto?');"
                    >Deletar</button>
                </div>
                </form>
            </div>
        <?php
        }
    } else {
    echo '<p class="vazio">Nenhum produto adicionado...</p>';
    }
    ?>
    </div>
</section>


<!-- https://www.w3schools.com/PHP/func_string_join.asp -->
<!-- https://www.educba.com/array-in-sql/ -->




<script src="../js/admin_script.js"></script>
</body>
</html>
<!-- https://www.amazon.com/LG-43NANO75UPA-Alexa-Built-NanoCell/dp/B08WHSH4JH/ref=sr_1_1?crid=2HCT7TB38NMWH&keywords=smart+tv&qid=1664969634&qu=eyJxc2MiOiI2Ljk3IiwicXNhIjoiNi42MCIsInFzcCI6IjUuOTUifQ%3D%3D&refinements=p_36%3A8589204011&rnid=8589203011&s=tv&sprefix=smart+t%2Caps%2C253&sr=1-1
    Visor nano 4k de verdade: dê vida aos seus programas favoritos com NanoCell vibrante. Veja a imagem natural e realista com Nano Color aprimorada por um bilhão de cores ricas. Dimensões da TV sem suporte (L x A x P)-96,8 x 56,3 x 5,8 cm
Processador Quad Core 4K: Nosso processador Quad Core 4K oferece uma experiência de visualização suave e nítida com maior contraste, cor e preto. Fonte de alimentação (tensão, Hz): CA 100~240V 50-60Hz, consumo de energia: 55W
Experiência em cinema doméstico: veja e sinta que você está em ação com Active HDR. Veja os filmes exatamente como os diretores pretendem com o Modo Filmmaker. E com acesso integrado aos canais Netflix, Prime Video, Apple TV Plus, Disney Plus e LG, seu conteúdo favorito está ao seu alcance.
Melhor jogo: experimente jogos em NanoCell. O Game Optimizer dá a você acesso mais fácil a todas as suas configurações de jogo e você terá o modo automático de baixa latência mais HGiG para uma imagem detalhada do jogo.
Auxiliar do Google e Alex embutido: não há necessidade de um dispositivo extra – basta pedir música, clima, notícias, sua lista de compras da Amazon e muito mais. Além disso, controle convenientemente sua casa conectada e dispositivos inteligentes. -->