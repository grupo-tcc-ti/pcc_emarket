<?php
include '../components/connect.php';
session_start();

(empty($_SESSION['admin_id']))?:$admin_id = $_SESSION['admin_id'];


if (isset($admin_id)) {
    // echo print_r($_SESSION).':loggedin'; //debug
    $mensagem[] = 'Sua sessão já foi iniciada!';
    $mensagem[] = 'Voce está sendo redirecionado....';
    // Pegar hostname
    $hostname = $_SERVER['HTTP_HOST'];
    // Pegar o diretorio atual com barra“/”
    $current_directory = rtrim(dirname($_SERVER['PHP_SELF']), '/');
    // Define o nome da pagina
    $page = 'dashboard.php';
    header('refresh:3, url=http://'.$hostname.$current_directory.'/'.$page);
}

if (isset($_POST['submit'])){
    $usuario = $_POST['usuario'];
    $usuario = filter_var($usuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $senha = sha1($_POST['senha']);
    $senha = filter_var($senha, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // $qry = "SELECT * FROM `admins` WHERE nome = ? AND senha = ?";
    $qry = "SELECT * FROM `admins` WHERE nome = :usuario AND senha = :senha";
    $selecionar_admin = $conn->prepare($qry);
    $selecionar_admin->bindParam(':usuario', $usuario);
    $selecionar_admin->bindParam(':senha', $senha);
    $selecionar_admin->execute();
    if ($selecionar_admin->rowCount() > 0){
        $fetch_admin_id = $selecionar_admin->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin_id'] = $fetch_admin_id['codAdmin'];
        $mensagem[] = 'Bem Vindo';
        // header('location: dashboard.php');

        // Pegar hostname
        $hostname = $_SERVER['HTTP_HOST'];
        // Pegar o diretorio atual com barra“/”
        $current_directory = rtrim(dirname($_SERVER['PHP_SELF']), '/');
        // Define o nome da pagina
        $page = 'dashboard.php';

        header('refresh:1, url=http://'.$hostname.$current_directory.'/'.$page);
        exit;
    } else {
        $mensagem[] = 'Nome de usuário ou senha incorreto!';
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
    
<!-- <div class="mensagem">
<span>Sua sessão já foi iniciada!</span>
<i class="fas fa-times" onclick = "this.parentElement.remove();"></i>
</div> -->

<?php
if (isset($mensagem)){
    foreach ($mensagem as $mensagem) {
        echo '
        <div class="mensagem">
        <span>'.$mensagem.'</span>
        <i class="fas fa-times" onclick = "this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<!-- Container do formulário de login do adminisrador -->

<section class="form-container">
    <form action="" method="post">
        <h3 class="heading">Credenciais de Login</h3>
        <p>Usuário de administrador predefinido: user = <span>admin</span> e senha <span>1234</span></p>
        <div class="flex">
        <div class="inputbox">
        <span class="title required-field">Usuario</span>
        <input type="text" name="usuario" class="box" maxlength="20" required placeholder="Usuário"
        oninput = "this.value = this.value.replace(/\s/g, '')" >
    </div>
        <div class="inputbox">
        <span class="title required-field">Senha</span>
        <input type="senha" name="senha" class="box" maxlength="20" required placeholder="Senha"
        oninput = "this.value = this.value.replace(/\s/g, '')" >
        </div>
        <input type="submit" value="Logar" class="btn" name="submit">
    </div>
    </form>
</section>

</body>
</html>