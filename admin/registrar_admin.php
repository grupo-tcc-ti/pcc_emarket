<?php
include '../model/connect.php';
include '../model/dao/UsuariosDAO.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    $admin_header = 'admin_header.php';
    header('location:../admin/'.$admin_header);
}

if (isset($_POST['submit'])){
    // $username = $_POST['username'];
    // $username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // $password = md5($_POST['password']);
    // $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // $rpassword = md5($_POST['rpassword']);
    // $rpassword = filter_var($rpassword, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // $qry = "SELECT * FROM `usuarios` WHERE nome = ?";
    // $select_admin = $pdo->prepare($qry);
    // $select_admin->execute([$username]);
    // if ($select_admin->rowCount() > 0){
    //     $mensagem[] = 'Conta já existe!';
    // } else if ($password != $rpassword) {
    //     $mensagem[] = 'Nome de usuário ou senha incorreto!';
    // }
    // else {
    //     $insert_admin = $pdo->prepare("INSERT INTO `usuarios` (nome, senha) VALUES (?, ?)");
    //     $insert_admin->execute([$username, $rpassword]);
    //     $mensagem[] = 'Cadastro de Administrador realizado com Sucesso!';
    // }
    UsuariosDAO::Cadastrar_Usuario(
        $_POST['username'],
        $_POST['email'],
        $_POST['password'],
        $_POST['rpassword'],
        $_POST['usertype']
    );
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
    <title>Registrar Conta de Administrador</title>
</head>
<body>

<?php include Admin_Header::component();?>

<section class="form-container">
    <form action="" method="post">
        <h3 class="heading">Criar Nova Conta - Administrador</h3><br><br><br>
        <input type="hidden" name="usertype" value="admin">
        <div class="flex">
            <div class="inputbox">
                <span class="title required-field">Usuário</span>
                <input type="text" name="username" class="box" maxlength="255" required placeholder="Digite o nome do Usuário"
                oninput = "this.value = this.value.replace(/\s/g, '')" >
            </div>
            <div class="inputbox">
                <span class="title required-field">Email</span>
                <input type="email" name="email" class="box" maxlength="255" required placeholder="Insira um email válido"
                oninput = "this.value = this.value.replace(/\s/g, '')" >
            </div>
            <div class="inputbox">
                <span class="title required-field">Senha</span>
                <input type="password" name="password" class="box" maxlength="50" required placeholder="Digite a Senha"
                oninput = "this.value = this.value.replace(/\s/g, '')" >
            </div>
            <div class="inputbox">
                <span class="title required-field">Confirme a Senha</span>
                <input type="password" name="rpassword" class="box" maxlength="50" required placeholder="Confirme a senha"
                oninput = "this.value = this.value.replace(/\s/g, '')" >
            </div>
        <input type="submit" value="Cadastrar" class="btn" name="submit">
        </div>
    </form>
</section>




















<script src="../js/admin_script.js"></script>
</body>
</html>