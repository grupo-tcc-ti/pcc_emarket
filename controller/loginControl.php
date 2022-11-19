<?php
if (!isset($pdo)) {
    include_once '../model/connect.php';
}
require_once '../model/dao/UsuariosDAO.php';
require_once '../model/dto/UsuariosDTO.php';

if (isset($_POST['login'])) {

    $usuarioDTO = new UsuariosDTO;
    (isset($_POST["usuario"])) ? $usuarioDTO->setNome($_POST["usuario"]) : '';
    (isset($_POST["email"])) ? $usuarioDTO->setEmail($_POST["email"]) : '';
    $usuarioDTO->setSenha($_POST["senha"]);
    $usr = UsuariosDAO::login($usuarioDTO);
    if ($usr != null) {
        Message::pop('Bem vindo!');

        $_SESSION[$usr['session']] = array(
            'type' => $usr['type'],
            'id' => $usr['id']
        );

        if ($usr['type'] == 'admin') {
            Redirect::page('../admin/dashboard.php', 2);
        } else {
            Redirect::page('../view/home.php', 1);
        }
    } else {
        Message::pop('Usuário e/ou Senha incorretos!');
    }
}
?>
<!-- if ($usr['type']=='cliente') {
            Redirect::page('../view/home.php', 1);
        }
        else {
            Redirect::page('../admin/dashboard.php', 2);
        } -->