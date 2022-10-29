<?php
if (!isset($pdo)) {
    require_once '../model/connect.php'; //Caso a pagina ja possua um connect não precisa desse
}
require_once '../model/dao/UsuariosDAO.php';
require_once '../model/dto/UsuariosDTO.php';
if (isset($_POST['submit'])) {
    // $usuario = $_POST['usuario'];
    // $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // // $senha = md5($_POST['senha']);
    // $senha = filter_var(md5($_POST['senha']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // $qry = "SELECT * FROM `usuarios` WHERE nome = :usuario AND senha = :senha";
    // $selecionar_admin = $pdo->prepare($qry);
    // $selecionar_admin->bindParam(':usuario', $usuario);
    // $selecionar_admin->bindParam(':senha', $senha);
    // $selecionar_admin->execute();
    // if ($selecionar_admin->rowCount() > 0) {
    //     $fetch_admin_ = $selecionar_admin->fetch(PDO::FETCH_ASSOC);
    //     $_SESSION['admin_id'] = array(
    //         'type' => $fetch_admin_['user_type'],
    //         'id' => $fetch_admin_['codAdmin']
    //     );
    //     // $mensagem[] = 'Bem Vindo';
    //     Message::pop('Seja Bem vindo!');
    //     Redirect::page('../admin/dashboard.php', 1);
    //     exit();
    // } else {
    //     // $mensagem[] = 'Nome de usuário ou senha incorreto!';
    //     Message::pop('Nome de usuário ou senha incorreto!');
    // }
    $usuarioDTO = new UsuariosDTO;
    (isset($_POST["usuario"]))?$usuarioDTO->setNome( $_POST["usuario"] ):'';
    // $usuarioDTO->setEmail($_POST["email"]);
    (isset($_POST["email"]))?$usuarioDTO->setEmail( $_POST["email"] ):'';
    $usuarioDTO->setSenha($_POST["senha"]);
    $usr = UsuariosDAO::login($usuarioDTO);
    if ($usr != null) {
    $_SESSION[$usr['session']] = array(
        'type' => $usr['type'], 
        'id' => $usr['id']);
        // var_dump($_SESSION[$usr['session']]);
        Message::pop('Bem vindo!');
        ($usr['type']=='cliente')?
        Redirect::page('../view/home.php', 1)
        :Redirect::page('dashboard.php', 1);

    } else {
        Message::pop('Usuário e/ou Senha incorretos!');
        ($usr['type']=='cliente')?
        Redirect::page('login_page.php', 1)
        :Redirect::page('dashboard.php', 1);
    }
}
?>