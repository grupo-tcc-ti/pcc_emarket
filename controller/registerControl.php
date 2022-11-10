<?php
require_once '../model/connect.php';
// require_once '../model/dao/_UsuarioDAO.php';
require_once '../model/dao/UsuariosDAO.php';
// require_once '../model/dto/_UsuarioDTO.php';
require_once '../model/dto/UsuariosDTO.php';

if (isset($_POST['register'])) {
    
    // $usuarioDTO = new _usuarioDTO();
    $usuarioDTO = new UsuariosDTO();
    // $usuarioDTO->setUser_type($_POST["usertype"]);
    (isset($_POST["usertype"]))?$usuarioDTO->setUser_type($_POST["usertype"]):'';
    // $usuarioDTO->setNome($_POST["nome"]);
    (isset($_POST["nome"]))?$usuarioDTO->setNome($_POST["nome"]):'';
    // $usuarioDTO->setEmail($_POST["email"]);
    (isset($_POST["email"]))?$usuarioDTO->setEmail($_POST["email"]):'';
    // $usuarioDTO->setSenha(array($_POST["senha"], $_POST["rsenha"]));
    (isset($_POST["rsenha"]))?$usuarioDTO->setSenha(array($_POST["senha"], $_POST["rsenha"])):'';
    
    // $UsuarioDAO = new _UsuarioDAO();
    // $status     = UsuariosDAO::cadastrarUsuario( $usuarioDTO );
    
    UsuariosDAO::cadastrarUsuario($usuarioDTO);

    // Message::pop('Cadastro realizado com Sucesso!');
    
    // if ( $status != null ) {
    //     var_dump($status);
    //     // header('location:../view/login_page.php');
    //     // Redirect::page('admin_contas.php', 1);
    //     // Redirect::page('../view/login_page', 1);
    // }
    
    ($_POST["usertype"] == 'admin')?
    Redirect::page('admin_contas.php', 2)
    : Redirect::page('../view/login_page.php', 2);
}
?>
