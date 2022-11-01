<?php
session_start();
require_once '../model/connect.php';

$user_id = $_SESSION['admin_id'];

if (!isset($user_id)) {
    $admin_header = 'admin_login.php';
    header('location:../admin/'.$admin_header);
}

if(isset($_GET['deletar'])) {
    $deletar_id = $_GET['deletar'];
    $deletar_mensagem = $pdo->prepare("DELETE FROM `mensagens` WHERE codMensagem = :mid");
    $deletar_mensagem->bindParam(':mid', $deletar_id);
    $deletar_mensagem->execute();
    header('location:mensagens.php');
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
    <title>Mensagens</title>
</head>
<body>

<?php require_once Path_Locale::admin_header(); ?>

<section class="mensagens">

<h1 class="head-list">Mensagens</h1>

    <?php
        $selecionar_mensagens = $pdo->prepare("SELECT * FROM `mensagens`");
        $selecionar_mensagens->execute();
    if($selecionar_mensagens->rowCount() > 0) {
        while($fetch_mensagens = $selecionar_mensagens->fetch(PDO::FETCH_ASSOC)){
            ?>
    <div class="listbox">
    <div class="itemfield">
        <p class="box"><?php echo $fetch_mensagens['usuarios_codUsuario']?></p>
    </div>
    <div class="itemfield">
        <p class="box"><?php echo $fetch_mensagens['nome']?></p>
    </div>
    <div class="itemfield">
        <p class="box"><?php echo $fetch_mensagens['email']?></p>
    </div>
    <div class="itemfield">
        <p class="box"><?php echo $fetch_mensagens['telefone']?></p>
    </div>
    <div class="itemfield">
        <p class="box"><?php echo $fetch_mensagens['mesagem']?></p>
    </div>
    <a href="<?php echo $_SERVER['PHP_SELF'].'?deletar='.$fetch_mensagem['codMensagem']; ?>" onclick="return confirm('deletar this mensagem?');" class="deletar-btn">deletar</a>
    </div>
            <?php
        }
    }else{
        echo '<p class="vazio">Sem mensagens...</p>';
    }
    ?>
</section>

<script src="../js/admin_script.js"></script>
</body>
</html>
