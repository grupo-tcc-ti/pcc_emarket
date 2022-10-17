<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    $admin_header = 'admin_login.php';
    header('location:../components/'.$admin_header);
} 

if (isset($_GET['deletar'])){
    // echo ':yes-yeeted-and-deleted!'; //debug
    $cod_admin = $_GET['deletar'];
    $qry = "DELETE FROM `admins` WHERE codAdmin = :id";
    $deletar_admin = $conn->prepare($qry) or die ("Não foi possivel achar a Conta Admin!");
    $deletar_admin->bindParam(':id', $cod_admin);
    $deletar_admin->execute();
    header('location: admin_contas.php');
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
    <title>Contas de Administradores</title>
</head>
<body>
    <?php include '../components/admin_header.php'; ?>

    <section class="admin-contas register-admin">
        <div class="gridbox">
            <div class="itemfield">
                <span class="title">Adicionar novo Administador</span>
                <a href="registrar_admin.php" class="option-btn">Registrar Administrador</a>
            </div>
        </div>
    </section>

    <section class="admin-contas ">
        <?php
            $qry = "SELECT * FROM `admins`";
            $selecionar_contas = $conn->prepare($qry);
            $selecionar_contas->execute();
            if($selecionar_contas->rowCount() > 0) {
                while ($fetch_contas += $selecionar_contas->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="gridbox">
        <div class="itemfield">
            <span class="title">Admin - ID : </span>
            <p class="box"><?=$fetch_contas['codAdmin'];?></p> 
        </div>
        <div class="itemfield">
            <span class="title">Admin - Nome : </span>
            <p class="box"><?=$fetch_contas['nome'];?></p>
        </div>
            <div class="flex-btn">
                <?php if ($fetch_contas['codAdmin'] == $admin_id) {
                    $_POST['alterar'] = $fetch_contas['codAdmin'];
                    echo '<a href="alterar_perfil.php" class="option-btn"
                    onclick="return confirm(`Deseja fazer alterações nesta Conta?`)">Alterar</a>';
                }
                ?>
                <a href="admin_contas.php?deletar=<?=$fetch_contas['codAdmin'];?>" class="delete-btn"
                onclick="send(this.form);  return confirm(`Deseja deletar esta conta Admin?`);"
                >Deletar</a>
            </div>
        </div>
        <?php
        // send(this.form); 
                }
            } else {
                echo '<p class="vazio">Nenhum conta de Administrador encontrada!</span>';
            }
        ?>
    </section>



<script src="../js/admin_script.js"></script>
</body>
</html>