<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:../components/admin_header.php');
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

<section class="add-produtos"></section>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="flex">
            <div class="inputBox">
                <span required-field>Nome do Produto</span>
                <input type="text" name="nome" required
                palceholder="Insira o nome do produto" maxlength="100" class="box">
            </div>
            <div class="inputBox"></div>
            <span required-field>Preço do Produto</span>
            <input type="number" name="preco" class="box" required
            placeholder="Insira o preço do produto" min="0" max="9999999999" onclick="if(this.value.length == 100) return false;">
        </div>
        <div class="inputBox">
            <span required-field>Imagens</span>
            <input type="file" name="image" class="box" required
            accept="image/jpg, image/jpeg, image/png, image/webp" multiple>
        </div>
        <div class="inputBox">
            <span required-field>Descrição do Produto</span>
            <textarea name="descricao" class="box" cols="30" rows="10"required
            placeholder="Insira as descrições do produto" maxlength="500"></textarea>
        </div>
        <input type="submit" value="Adicionar Produto" name="add_produto" class="btn">
    </form>
</section>

<script src="../js/admin_script.js"></script>
</body>
</html>