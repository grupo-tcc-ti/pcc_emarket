<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:../components/admin_header.php');
}

if (isset($_POST['add_produto'])){
    $nome = $_POST['nome'];
    $nome = filter_var($nome, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $descricao = $_POST['descricao'];
    $descricao = filter_var($descricao, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $preco = $_POST['preco'];
    $preco = filter_var($preco, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $select_produtos = $conn->prepare("SELECT * FROM `produtos` WHERE nome = ?");
    $select_produtos->execute([$nome]);

    $name_valid = $path_valid = $size_valid = false;

    //Verifica se produto com mesmo nome
    if ($select_produtos->rowCount() > 0) {
        $message[] = 'Um produto com o mesmo nome ja existe!';
        $name_valid = false;
    } 
    else { $name_valid = true; }
    //continua procedimento
    $image = array_filter($_FILES['image']['name']); //O nome original do arquivo na máquina do cliente.
    $image = filter_var($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS); //filtrar processo de arquivos e caracteres especiais
    $total_imgfiles = count($_FILES['image']['name']); //Contar o numero de arquivos na array
    //Loop através da array image
    for( $i=0 ; $i < $total_imgfiles ; $i++ ) {
        //O caminho temporario do arquivos é armazenado
        //tmp_name O nome temporário com o qual o arquivo enviado foi armazenado no servidor.
        $image_tmp = $_FILES['image']['tmp_name'][$i];
        //Verifica se caminho vazio
        if ($image_tmp != ""){
            //Configura novo caminho
            $image_folder = "../uploaded_imgs/".$_FILES['image']['name'][$i];
            //O arquivo e enviado ao caminho temporario 
            if(move_uploaded_file($image_tmp, $image_folder)) { $path_valid = true; }
        }
        //Verifica o tamanho do arquivo
        $image_size = $_FILES['image']['size'][$i]; //O tamanho, em bytes, do arquivo enviado. 
        if ($image_size > 2000000){
            $message[] = 'Tamanho do arquivo é maior que o permitido!';
            $size_valid = false;
        }else {$size_valid = true;}
    }
    //Confirma se imagens validas
    if ($name_valid && $path_valid && $size_valid){
    //insere o produto
    $inserir_produto = $conn->prepare("INSERT INTO `produtos` (nome, descricao, preco, image)
    VALUES (?,?,?,?)");
    $inserir_produto->execute([$nome, $descricao, $preco, $image]);
    $message[] = 'Produto adicionado com sucesso!';
    }
    // $image_tmp_folder = '../uploaded_imgs/'.$image; //old
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
    <form action="" method="post" enctype="multipart/form-data">
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
                <!-- <label for="input-file" class="btn">Enviar Imagens</label> -->
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

<script src="../js/admin_script.js"></script>
</body>
</html>
<!-- Visor nano 4k de verdade: dê vida aos seus programas favoritos com NanoCell vibrante. Veja a imagem natural e realista com Nano Color aprimorada por um bilhão de cores ricas. Dimensões da TV sem suporte (L x A x P)-96,8 x 56,3 x 5,8 cm
Processador Quad Core 4K: Nosso processador Quad Core 4K oferece uma experiência de visualização suave e nítida com maior contraste, cor e preto. Fonte de alimentação (tensão, Hz): CA 100~240V 50-60Hz, consumo de energia: 55W
Experiência em cinema doméstico: veja e sinta que você está em ação com Active HDR. Veja os filmes exatamente como os diretores pretendem com o Modo Filmmaker. E com acesso integrado aos canais Netflix, Prime Video, Apple TV Plus, Disney Plus e LG, seu conteúdo favorito está ao seu alcance.
Melhor jogo: experimente jogos em NanoCell. O Game Optimizer dá a você acesso mais fácil a todas as suas configurações de jogo e você terá o modo automático de baixa latência mais HGiG para uma imagem detalhada do jogo.
Auxiliar do Google e Alex embutido: não há necessidade de um dispositivo extra – basta pedir música, clima, notícias, sua lista de compras da Amazon e muito mais. Além disso, controle convenientemente sua casa conectada e dispositivos inteligentes. -->