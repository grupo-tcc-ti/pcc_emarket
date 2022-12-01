<?php
session_start();
require_once '../model/connect.php';
// require_once '../model/dao/UsuariosDAO.php';
//undo requirefolder if fails!
File_Path::requireFolder('../model/dao');
File_Path::requireFolder('../model/dto');

if (isset($_GET['deletar'])) {
    $deletar_id = $_GET['deletar'];
    $deletar_mensagem = $pdo->prepare("DELETE FROM `mensagens` WHERE codMensagem = :mid");
    $deletar_mensagem->bindParam(':mid', $deletar_id);
    $deletar_mensagem->execute();
    header('location:mensagens.php');
}

?>

<!DOCTYPE html>
<html lang="pt, en">

<head>
    <?php require_once File_Path::head(); ?>
    <link rel="stylesheet" href="../css/admin_stylesheet.css">
    <title>Mensagens</title>
</head>

<body>

    <div class="header">
        <?php require_once File_Path::admin_header(); ?>
    </div>

    <section class="mensagens">

        <h1 class="head-list">Mensagens</h1>

        <?php
    $selecionar_mensagens = $pdo->prepare("SELECT * FROM `mensagens`");
    $selecionar_mensagens->execute();
    if ($selecionar_mensagens->rowCount() > 0) {
        while ($fetch_mensagens = $selecionar_mensagens->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <div class="listbox">
            <div class="itemfield">
                <p class="box">
                    <?php echo $fetch_mensagens['usuarios_codUsuario'] ?>
                </p>
            </div>
            <div class="itemfield">
                <p class="box">
                    <?php echo $fetch_mensagens['nome'] ?>
                </p>
            </div>
            <div class="itemfield">
                <p class="box">
                    <?php echo $fetch_mensagens['email'] ?>
                </p>
            </div>
            <div class="itemfield">
                <p class="box">
                    <?php echo $fetch_mensagens['telefone'] ?>
                </p>
            </div>
            <div class="itemfield">
                <p class="box">
                    <?php echo $fetch_mensagens['mesagem'] ?>
                </p>
            </div>
            <a href="<?php echo $_SERVER['PHP_SELF'] . '?deletar=' . $fetch_mensagem['codMensagem']; ?>"
                onclick="return confirm('deletar this mensagem?');" class="deletar-btn">deletar</a>
        </div>
        <?php
        }
    } else {
        echo '<p class="vazio">Sem mensagens...</p>';
    }
            ?>
    </section>

    <script src="../js/admin_script.js"></script>
</body>

</html>