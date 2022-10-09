<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    $admin_header = 'admin_login.php';
    header('location:../components/'.$admin_header);
}

//####### Alterar produto starts ###########################
if (isset($_POST['alterar'])){
    $codProduto = $_POST['codProduto'];
    $codProduto = filter_var($codProduto, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nome = $_POST['nome'];
    $nome = filter_var($nome, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nome_anterior = $_POST['nome_anterior'];
    $nome_anterior = filter_var($nome_anterior, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $descricao = $_POST['descricao'];
    $descricao = filter_var($descricao, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $preco = $_POST['preco'];
    $preco = filter_var($preco, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //Image handling procedure starts --------->
    $name_valid = $path_valid = $size_valid = $upload_valid = false;
    $fetched_imgs = $image = array();
    $prod_path = "../image/produtos_teste/";

    
    //Verifica se produto com mesmo nome
    if ($nome == $nome_anterior) {
        $mensagem[] = 'O nome do produto é o mesmo que o anterior!';
        $name_valid = false;
        // echo ':name_invalid:'; //debug
    } else {
        $name_valid = true;
        // echo ':name_valid:'; //debug
    }

    if (isset($_FILES['image'])){
        $image_error = $_FILES['image']['error'];
        foreach ($image_error as $image_error){
            if ($image_error != 0) {
            $upload_valid = false;
            // echo 'upload_invalid:';
            }
            else {
                $upload_valid = true;
                // echo 'upload_valid:';
            }
        }
        
        if (is_array($_FILES['image']['name']) && $upload_valid){
            // echo ':isarray'."\n"; //debug
            $files_img = array_filter($_FILES['image']);
            // print_r($prod_path.$files_img['name'][1].':ispath'."\n"); //debug
            //Loop através da array image
            for ($i = 0; $i < count($files_img['name']); $i++) {
                // echo ':isforeach        '."\n"; //debug
                $image[$i] = $prod_path.$files_img['name'][$i]; //O nome original do arquivo na máquina do cliente.
                $image[$i] = filter_var($image[$i], FILTER_SANITIZE_FULL_SPECIAL_CHARS); //filtrar processo de arquivos e caracteres especiais
                //O caminho temporario do arquivos é armazenado
                //tmp_name O nome temporário com o qual o arquivo enviado foi armazenado no servidor.
                $image_tmp = $files_img['tmp_name'][$i];
                //Verifica se caminho vazio
                if ($image_tmp != "") {
                    //Configura novo caminho
                    $image_folder = $prod_path . $files_img['name'][$i];
                    //O arquivo e enviado ao caminho temporario
                    if (move_uploaded_file($image_tmp, $image_folder)) {
                        $path_valid = true;
                        // echo $size_valid.':arrayimg_path'."\n"; //debug
                    }
                }
                //Verifica o tamanho do arquivo
                $image_size = $files_img['size'][$i]; //O tamanho, em bytes, do arquivo enviado.
                if ($image_size > 2000000) {
                    $mensagem[] = 'Tamanho do arquivo é maior que o permitido!';
                    $size_valid = false;
                } else { $size_valid = true; 
                    // echo $size_valid.':arrayimg_size'."\n"; //debug
                }
            }
        } else if (!is_array($files_img['name']) && $upload_valid){
            // echo ':isstring'."\n"; //debug
            $image = $prod_path.$files_img['name'];
            $image = filter_var($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $image_tmp = $files_img['tmp_name'];
            if ($image_tmp != "") {
                //Configura novo caminho
                $image_folder = $prod_path . $files_img['name'];
                //O arquivo e enviado ao caminho temporario
                if (move_uploaded_file($image_tmp, $image_folder)) {
                    $path_valid = true;
                    // echo $size_valid.':singleimg_path'."\n"; //debug
                }
            }
            //Verifica o tamanho do arquivo
            $image_size = $files_img['size']; //O tamanho, em bytes, do arquivo enviado.
            if ($image_size > 2000000) {
                $mensagem[] = 'Tamanho do arquivo é maior que o permitido!';
                $size_valid = false;
            } else { $size_valid = true;
                // echo $size_valid.':singleimg_size'."\n"; //debug
            }
        }
    }
    //Image handling procedure ends--------->
    
    // var_dump($codProduto); //debug
    // echo $name_valid.':last_name   '; //debug
    // echo $path_valid.':last_path   '; //debug
    // echo $size_valid.':last_size   '; //debug
    if ($name_valid && $path_valid && $size_valid && $upload_valid) {
    $alterar_prod = $conn->prepare("UPDATE `produtos` 
    SET nome = :nome, descricao = :descricao, preco = :preco, image = :image
    WHERE codProduto = :cpid");
    $alterar_prod->bindParam(':nome', $nome);
    $alterar_prod->bindParam(':descricao', $descricao);
    $alterar_prod->bindParam(':preco', $preco);
    $alterar_prod->bindValue(":image", is_array($image)?implode(',', $image):$image);
    $alterar_prod->bindParam(':cpid', $codProduto);
    $alterar_prod->execute();
    $hostname = $_SERVER['HTTP_HOST'];
    $current_directory = rtrim(dirname($_SERVER['PHP_SELF']),'/');
    $page = 'alterar_produto.php';
    $mensagem[] = 'Produto alterado com sucesso!';
    // header('refresh: 1, url=http://'.$hostname.$current_directory.'/'.$page);
    // exit;
    }
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
    $mostrar_produtos = $conn->prepare("SELECT * FROM  `produtos` WHERE codProduto = :cpid");
    $mostrar_produtos->bindParam(':cpid', $alterar_id);
    $mostrar_produtos->execute();
    // var_dump($_SESSION['codProduto']); //debug
    if ($mostrar_produtos->rowCount() > 0) {
        while ($fetch_produto = $mostrar_produtos->fetch(PDO::FETCH_ASSOC)) {
            $fetched_imgs = explode(",", $fetch_produto['image']); ?>
            <!-- print_r($fetched_imgs); -->
    <form action="" method="post" enctype="multipart/form-data"
    class="" name="alterar_form">
        <input type="hidden" name="codProduto" value='<?=$fetch_produto['codProduto'];?>'>
        <input type="hidden" name="nome_anterior" value='<?=$fetch_produto['nome'];?>'>
        <input type="hidden" name="image[]" value='<?=$fetched_imgs;?>'>
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
        maxlength="200" placeholder="Insira o nome a ser alterado"><br>

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
        <input type="file" name="image[]" id="" class="box required-field" multiple required 
        accept="image/jpg, image/jpeg, image/png, image/webp" ><br>

        <div class="flex-btn">
            <button type="submit" name="alterar" class="btn"
            >Alterar</button>
            <!-- <a href="produtos.php" class="option-btn">Voltar</a> -->
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