<?php
include '../model/connect.php';
include '../model/dao/ProdutosDAO.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    $admin_header = 'admin_login.php';
    header('location:../admin/'.$admin_header);
}

//####### Alterar produto starts ###########################
if (isset($_POST['alterar'])){
    ProdutosDAO::Alterar_Produto(
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
    $hostname = $_SERVER['HTTP_HOST'];
    $current_directory = rtrim(dirname($_SERVER['PHP_SELF']),'/');
    $page = 'produtos.php';
    unset($_SESSION['codProduto']);
    $mensagem[] = 'Ate mais!';
    header('refresh: 1, url=http://'.$hostname.$current_directory.'/'.$page);
    exit;
}
//#######Voltar###########################

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
    <title>Alterar Cadastro de Produtos</title>
</head>
<body>

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
            !is_array($fetch_produto['image'])?
            $fetched_imgs = explode(",", $fetch_produto['image'])
            :$fetched_imgs = implode($fetch_produto['image']); ?>
            <!-- print_r($fetched_imgs); -->
    <form action="" method="post" enctype="multipart/form-data"
    class="" name="alterar_form">
        <input type="hidden" name="codProduto" value='<?=$fetch_produto['codProduto'];?>'>
        <input type="hidden" name="nome_anterior" value='<?=$fetch_produto['nome'];?>'>
        <input type="hidden" name="image" value='<?=$fetched_imgs;?>'>
        <div class="image-container">
            <!-- Fazer script que rode as outras imagens -->
            <div class="main-image">
                <!-- Colocar imagem principal aqui -->
                <img src='<?=$fetched_imgs[0];?>' alt="">
                <!-- width="200px" height="200px" -->
            </div>

            <?php //....::PHP::..... starts ..
            foreach (array_slice($fetched_imgs, 0) as $img) {
            //....::PHP::..... ends .. ?>
            <div class="sub-image">
                <!-- Colocar um image array aqui -->
                <img src='<?php echo $img;?>' alt="">
            </div>
            <?php //....::PHP::..... starts ..
            } 
            //....::PHP::..... ends .. ?>
        </div>
        <span>Nome</span>
        <input type="text" name="nome" id="" class="box required-field" required
        maxlength="200" placeholder="Insira o nome a ser alterado"
        value="<?=$fetch_produto['nome']?>"><br>

        <span>Novo Preço</span>
        <input type="number" name="preco" id="" class="box required-field" required 
        min="0" max="9999999999" step="any" placeholder="Insira um novo preço para o produto" 
        onkeypress="if(this.value.length == 10) return false;"
        value="<?=$fetch_produto['preco']?>"><br><br>
            
        <span>Alterar Descrição</span>
        <textarea name="descricao" id="" cols="30" rows="10"  required
        placeholder="Descrições do produto (Max.: 1500 char.)" maxlength="1500">
            <?=$fetch_produto['descricao'];
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
    //....::PHP::..... ends .. ?>
</section>

<script src="../js/admin_script.js"></script>
</body>
</html>