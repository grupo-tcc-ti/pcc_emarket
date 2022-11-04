<?php
require_once '../model/connect.php';
require_once '../model/dao/UsuariosDAO.php';
require_once '../model/dto/UsuariosDTO.php';

if (isset($_POST['login'])) {

    $usuarioDTO = new UsuariosDTO;
    (isset($_POST["usuario"]))?$usuarioDTO->setNome( $_POST["usuario"] ):'';
    // $usuarioDTO->setEmail($_POST["email"]);
    (isset($_POST["email"]))?$usuarioDTO->setEmail( $_POST["email"] ):'';
    $usuarioDTO->setSenha($_POST["senha"]);
    $usr = UsuariosDAO::login($usuarioDTO);
    if ($usr != null) {
    Message::pop('Bem vindo!');

    $_SESSION[$usr['session']] = array(
        'type' => $usr['type'], 
        'id' => $usr['id']);

    // $_SESSION["currentUser"] = array(
    //     'type' => $usr['type'], 
    //     'id' => $usr['id']);

        if ($usr['type']=='cliente') {
            Redirect::page('../view/home.php', 1);
            $_SESSION["isAdmin"] = false;
        }
        else {
            Redirect::page('../admin/dashboard.php', 2);
            $_SESSION["isAdmin"] = true;
        }
        //var_dump($_SESSION);
    } else {
        Message::pop('Usuário e/ou Senha incorretos!');
    }
}
?>
