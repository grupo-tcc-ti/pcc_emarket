<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    $admin_header = 'admin_login.php';
    header('location:../components/'.$admin_header);
}

$user_id = 'codUsuario';
if (isset($_GET['deletar'])) {
    $deletar_id = $_GET['deletar'];
    var_dump($deletar_id);
    $qry = "DELETE pd, usr
    -- msg, ldd, crt,
    
    -- FROM  `mensagens` as msg
    -- JOIN
    -- `listadedesejo` AS ldd
    -- ON ldd.usuarios_codUsuario = msg.usuarios_codUsuario

    -- JOIN
    -- `carrinho` AS crt
    -- ON crt.usuarios_codUsuario = ldd.usuarios_codUsuario

    -- JOIN
    -- `pedidos` AS pd
    -- ON pd.usuarios_codUsuario = crt.usuarios_codUsuario

    from `pedidos` AS pd
    JOIN
    `usuarios` AS usr
    ON  usr.codUsuario = pd.usuarios_codUsuario
    WHERE pd.usuarios_codUsuario = :uid
    ";

    $deletar_usuario = $conn->prepare($qry);
    $deletar_usuario->bindParam(':uid', $deletar_id);
    $deletar_usuario->execute();

    header('location: users_contas.php');

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
    <title>Contas de Usuários</title>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<h1 class="head-list">Contas de Usuários</h1>
<section class="contas">
    <?php
        $qry = ("SELECT * FROM `usuarios`");
        $selecionar_usuarios = $conn->prepare($qry);
        // $selecionar_usuarios->bindParam(':', $codUsuarios);
        $selecionar_usuarios->execute();
        if ($selecionar_usuarios->rowCount() > 0){
            while ($fetch_contas = $selecionar_usuarios->fetch(PDO::FETCH_ASSOC)){
                ?>
            <div class="gridbox">
                <div class="itemfield">
                    <span class="title">Usuário - ID</span>
                    <p class="box"><?=$fetch_contas[$user_id]?></p>
                </div>
                <div class="itemfield">
                    <span class="title">Nome</span>
                    <p class="box"><?=$fetch_contas['nome']?></p>
                </div>
                <div class="itemfield">
                    <span class="title">Email</span>
                    <p class="box"><?=$fetch_contas['email']?></p>
                </div>
                <div class="flex-btn">
                    <a href="<?=$_SERVER['PHP_SELF'].'?deletar='.$fetch_contas[$user_id];?>"
                    class="delete-btn" onclick="return confirm('Deseja excluir esta conta de Usuário?');"
                    >Deletar</a>
                </div>
            </div>
            <?php
            
                }
            } else {
                echo '<p class="vazio">Nenhuma conta de Usuário encontrada!</span>';
            }
        ?>
</section>

<script src="../js/admin_script.js"></script>
</body>
</html>