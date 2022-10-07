<?php
include '../components/connect.php';
session_start();

if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = sha1($_POST['password']);
    $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $qry = "SELECT * FROM `admins` WHERE nome = ? AND senha = ?";
    $select_admin = $conn->prepare($qry);
    $select_admin->execute([$username, $password]);
    if ($select_admin->rowCount() > 0){
        $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin_id'] = $fetch_admin_id['codAdmin'];
        header('location: dashboard.php');
        $message[] = 'Bem Vindo';
    } else {
        $message[] = 'Nome de usuário ou senha incorreto!';
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
    <title>Login do Administrador - Intranet</title>
</head>
<body>


<?php
if (isset($message)){
    foreach ($message as $message) {
        echo '
        <div class="message">
        <span>'.$message.'</span>
        <i class="fas fa-times" onclick = "this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<!-- Container do formulário de login do adminisrador -->

<section class="form-container">
    <form action="" method="post">
        <h3>Credenciais de Login</h3>
        <p>Usuário de administrador predefinido: user = <span>admin</span> e senha <span>1234</span></p>
        <input type="text" name="username" class="inputbox" maxlength="20" required placeholder="Usuário"
        oninput = "this.value = this.value.replace(/\s/g, '')" >
        <input type="password" name="password" class="inputbox" maxlength="20" required placeholder="Senha"
        oninput = "this.value = this.value.replace(/\s/g, '')" >
        <input type="submit" value="Logar" class="btn" name="submit">
    </form>
</section>

</body>
</html>