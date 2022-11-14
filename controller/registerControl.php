<?php
if (!isset($pdo)) {
    include_once '../model/connect.php';
}
require_once '../model/dao/UsuariosDAO.php';
require_once '../model/dto/UsuariosDTO.php';

if (isset($_POST['register'])) {
    
    $usuarioDTO = new UsuariosDTO();
    (isset($_POST["usertype"]))?$usuarioDTO->setUser_type($_POST["usertype"]):'';
    (isset($_POST["nome"]))?$usuarioDTO->setNome($_POST["nome"]):'';
    (isset($_POST["email"]))?$usuarioDTO->setEmail($_POST["email"]):'';
    (isset($_POST["rsenha"]))?$usuarioDTO->setSenha(array($_POST["senha"], $_POST["rsenha"])):'';
    
    UsuariosDAO::cadastrarUsuario($usuarioDTO);
    if ($usuarioDTO->getUser_type() == 'admin') {
        // Redirect::page('admin_contas.php', 2);
        var_dump($usuarioDTO->getUser_type());
    } else {
        var_dump($usuarioDTO->getUser_type());
        Redirect::page('../view/minha_conta.php', 2);
    }
}
?>
