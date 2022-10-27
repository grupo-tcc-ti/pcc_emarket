<?php
if (!isset($pdo)){
    include '../model/connect.php'; //Caso a pagina ja possua um connect não precisa desse
}
if (isset($_POST['submit'])){
    $usuario = $_POST['usuario'];
    $usuario = filter_var($usuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $senha = md5($_POST['senha']);
    $senha = filter_var($senha, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // $qry = "SELECT * FROM `admins` WHERE nome = ? AND senha = ?";
    $qry = "SELECT * FROM `usuarios` WHERE nome = :usuario AND senha = :senha";
    $selecionar_admin = $pdo->prepare($qry);
    $selecionar_admin->bindParam(':usuario', $usuario);
    $selecionar_admin->bindParam(':senha', $senha);
    $selecionar_admin->execute();
    if ($selecionar_admin->rowCount() > 0){
        $fetch_admin_id = $selecionar_admin->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin_id'] = $fetch_admin_id['codAdmin'];
        $mensagem[] = 'Bem Vindo';
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