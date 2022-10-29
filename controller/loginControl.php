<?php
require_once '../model/connect.php';
require_once '../model/dao/UsuariosDAO.php';
require_once '../model/dto/UsuariosDTO.php';

if (isset($_POST['submit'])) {

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
        if ($usr['type']=='cliente')
            Redirect::page('../view/home.php', 1);
        else 
            Redirect::page('dashboard.php', 1);
    } else {
        Message::pop('Usuário e/ou Senha incorretos!');
    }
}
?>
