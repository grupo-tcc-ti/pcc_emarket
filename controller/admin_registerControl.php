<?php
require_once '../model/connect.php';
require_once '../model/dao/_UsuarioDAO.php';
require_once '../model/dto/_usuarioDTO.php';

if (isset($_POST['submit'])) {
    // $nome  = $_POST["nome"];
    // $email = $_POST["email"];
    // $senha = $_POST["senha"];
    
    // $usuarioDTO = new _usuarioDTO();
    $usuarioDTO = new UsuariosDTO();
    $usuarioDTO->setNome($_POST["nome"]);
    $usuarioDTO->setEmail($_POST["email"]);
    $usuarioDTO->setSenha(array($_POST["senha"], $_POST["rsenha"]));
    
    // $UsuarioDAO = new _UsuarioDAO();
    $status     = UsuariosDAO::cadastrarUsuario($usuarioDTO);
    
    if ($status != null ) {
        header('location:../view/login_page.php');
    }
}
?>
