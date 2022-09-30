<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:../components/admin_header.php');
}

if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = sha1($_POST['password']);
    $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $rpassword = sha1($_POST['rpassword']);
    $rpassword = filter_var($rpassword, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $qry = "SELECT * FROM `admins` WHERE nome = ?";
    $select_admin = $conn->prepare($qry);
    $select_admin->execute([$username]);
    if ($select_admin->rowCount() > 0){
        $message[] = 'Conta já existe!';
    } else if ($password != $rpassword) {
        $message[] = 'Nome de usuário ou senha incorreto!';
    }
    else {
        $insert_admin = $conn->prepare("INSERT INTO `admins` (nome, senha) VALUES (?, ?)");
        $insert_admin->execute([$username, $rpassword]);
        $message[] = 'Cadastro de Administrador realizado com Sucesso!';
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <title>Registrar Conta de Administrador</title>
</head>
<body>

<?php include '../components/admin_header.php';?>

<section class="form-container">
    <form action="" method="post">
        <h3>Criar Nova Conta - Administrador</h3><br><br><br>
        <input type="text" name="username" class="inputbox" maxlength="20" required placeholder="Usuário"
        oninput = "this.value = this.value.replace(/\s/g, '')" >
        <input type="password" name="password" class="inputbox" maxlength="20" required placeholder="Senha"
        oninput = "this.value = this.value.replace(/\s/g, '')" >
        <input type="password" name="rpassword" class="inputbox" maxlength="20" required placeholder="Repita a sua senha"
        oninput = "this.value = this.value.replace(/\s/g, '')" >
        <input type="submit" value="Cadastrar" class="btn" name="submit">
    </form>
</section>




















<script src="../js/admin_script.js"></script>
</body>
</html>