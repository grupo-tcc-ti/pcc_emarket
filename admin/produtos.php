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

// Adicionar produto starts ###################################################################
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

    $name_valid = $path_valid = $size_valid = $upload_valid = false;

    //Verifica se produto com mesmo nome
    if ($select_produtos->rowCount() > 0) {
        $message[] = 'Um produto com o mesmo nome ja existe!';
        $name_valid = false;
    } else { $name_valid = true;}


    //Image handling procedure starts --------->
    $fetched_imgs = $image = array();
    $prod_path = "../image/produtos_teste/";
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
                    $message[] = 'Tamanho do arquivo é maior que o permitido!';
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
                $message[] = 'Tamanho do arquivo é maior que o permitido!';
                $size_valid = false;
            } else { $size_valid = true;
                // echo $size_valid.':singleimg_size'."\n"; //debug
            }
        }
    }
    //Image handling procedure ends--------->

    // $path_valid = true; $size_valid = true;  //debug force true
    // echo $name_valid.':last_name   '; //debug
    // echo $path_valid.':last_path   '; //debug
    // echo $size_valid.':last_size   '; //debug

    //Confirma se imagens validas
    if ($name_valid && $path_valid && $size_valid && $upload_valid) {
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
// Adicionar produto ends ###################################################################

// Deletar produto starts ###################################################################
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
    /* Deleta produto do banco */
    $del_prod = $conn->prepare("DELETE FROM `produtos` WHERE codProduto = :id");
    $del_prod->bindParam(':id', $delete_id);
    $del_prod->execute();

    /* Deleta produto do carrinho e listadedesejo*/
    $del_prod_cart_wlist = $conn->prepare("DELETE FROM `carrinho` WHERE :fk_id = :id");
    $del_prod_cart_wlist = $conn->prepare("DELETE FROM `listadedesejo` WHERE :fk_id = :id");
    $del_prod_cart_wlist->bindParam(':id', $delete_id);
    $del_prod_cart_wlist->bindValue(':fk_id', 'produtos_codProduto');
    $del_prod_cart_wlist->execute();
    header('location: produtos.php');
}
// Deletar produto ends ###################################################################

function debugImgArr($img_name = ''){
    $image = array();
    if (UPLOAD_ERR_OK === $_FILES[$img_name]['error']){echo 'no errorok        ';}else{echo 'errorok        ';}
    if ($_FILES[$img_name]['error'] == 0){echo 'no error0        ';}else{echo 'error0        ';}
    if (isset($_FILES[$img_name]) && $_FILES[$img_name]["error"] == 0){
        if (is_array($_FILES[$img_name]['name'])) {
            $total_imgfiles = count($_FILES[$img_name]['name']); //Contar o numero de arquivos na array
            echo $image.':is array with:'.$total_imgfiles.' imgfiles';
        }
    } else {
    echo $image.':not array';
    $image_name     = $_FILES[$img_name]["name"];
    $image_type     = $_FILES[$img_name]["type"];
    $image_size     = $_FILES[$img_name]["size"];
    $image_tmp_name = $_FILES[$img_name]["tmp_name"];
    $image_error = $_FILES[$img_name]["error"];
    
    echo "<div style='text-align: center; background: #4CB974;
    padding: 30px 0 10px 0; font-size: 20px; color: #fff'>
    File Name: " . $image_name . "</div>";
    
    echo "<div style='text-align: center; background: #4CB974;
    padding: 10px; font-size: 20px; color: #fff'>
    File Type: " . $image_type . "</div>";
    
    echo "<div style='text-align: center; background: #4CB974;
    padding: 10px; font-size: 20px; color: #fff'>
    File Size: " . $image_size . "</div>";
    
    echo "<div style='text-align: center; background: #4CB974;
    padding: 10px; font-size: 20px; color: #fff'>
    File Error: " . $image_error . "</div>";
    
    echo "<div style='text-align: center; background: #4CB974;
    padding: 10px; font-size: 20px; color: #fff'>
    File Temporary Name: " . $image_tmp_name . "</div>";
    }
}

// if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
// } else {
// throw new UploadException($_FILES['file']['error']);
// }
class UploadException extends Exception
{
    public function __construct($code) {
        $msg = $this->codeToMessage($code);
        parent::__construct($msg, $code);
    }

    private function codeToMessage($code)
    {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                $msg = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $msg = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                break;
            case UPLOAD_ERR_PARTIAL:
                $msg = "The uploaded file was only partially uploaded";
                break;
            case UPLOAD_ERR_NO_FILE:
                $msg = "No file was uploaded";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $msg = "Missing a temporary folder";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $msg = "Failed to write file to disk";
                break;
            case UPLOAD_ERR_EXTENSION:
                $msg = "File upload stopped by extension";
                break;
            default:
                $msg = "Unknown upload error";
                break;
        }
        return $msg;
    }
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
                placeholder="Ex.: Placa de Vídeo Nvidia Geforce RTX..." maxlength="200">
            </div><br>
            <div class="inputbox">
                <span class="prod-title required-field">Preço do Produto</span>
                <input type="number" name="preco" class="box" required
                placeholder="Ex.: R$ 3,999.00" min="0" max="9999999999" step="any" onclick="if(this.value.length == 100) return false;">
            </div><br>
            <div class="inputbox">
                <span class="prod-title required-field">Imagens</span>
                <!-- <label for="input-file" class="btn">Enviar Imagens</label> Implementar mais coisas depois-->
                <input type="file" name="image[]" class="box" id="input-file" required
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


<script src="../js/admin_script.js"></script>
</body>
</html>
<!-- 
    https://www.amazon.com/LG-43NANO75UPA-Alexa-Built-NanoCell/dp/B08WHSH4JH/ref=sr_1_1?crid=2HCT7TB38NMWH&keywords=smart+tv&qid=1664969634&qu=eyJxc2MiOiI2Ljk3IiwicXNhIjoiNi42MCIsInFzcCI6IjUuOTUifQ%3D%3D&refinements=p_36%3A8589204011&rnid=8589203011&s=tv&sprefix=smart+t%2Caps%2C253&sr=1-1
    https://www.amazon.com/-/pt/dp/B096BK7W5M/ref=sr_1_6?keywords=smartwatch&qid=1665190856&qu=eyJxc2MiOiI2LjY1IiwicXNhIjoiNS44MSIsInFzcCI6IjQuNTMifQ%3D%3D&refinements=p_36%3A1253506011&rnid=386442011&s=electronics&sprefix=smat%2Celectronics%2C332&sr=1-6
-->