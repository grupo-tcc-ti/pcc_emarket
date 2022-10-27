<?php
require_once '../model/dto/_UsuarioDTO.php';
require_once '../model/dao/_UsuarioDAO.php';
session_start();

$email = $_POST["email"];
$senha = $_POST["senha"];

$UsuarioDTO = new UsuarioDTO();
$UsuarioDTO->setEmail( $email );
$UsuarioDTO->setSenha( $senha );

$UsuarioDAO    = new UsuarioDAO();
$usuarioLogado = $UsuarioDAO->login( $UsuarioDTO );

var_dump( $usuarioLogado );

if ( $usuarioLogado != null ) {
    $_SESSION["loginID"] = $usuarioLogado->getId();
    $nome                = $usuarioLogado->getNome();
    $sql                 = Conexao::getInstance();
    $sql_code            = "SELECT * FROM usuarios WHERE nome = '$nome'";
    $sql_query           = $sql->prepare( $sql_code );
    $sql_query->execute();
    $fetchUser = $sql_query->fetch( PDO::FETCH_ASSOC );

    $type = $fetchUser["user_type"];

    if ( $type == "admin" ) {
        $_SESSION["isAdmin"]    = "true";
        $_SESSION["nomeAdmin"]  = $nome;
        $_SESSION["senhaAdmin"] = MD5( $UsuarioDTO->getSenha() );
    } else {
        $_SESSION["isAdmin"] = "false";
    }

    $_SESSION["nomeUsuario"]  = $usuarioLogado->getNome();
    $_SESSION["emailUsuario"] = $usuarioLogado->getEmail();
    $_SESSION["senhaUsuario"] = $usuarioLogado->getSenha();

    header( "location:../view/home.php" );
} else {
    session_destroy();
    header( "location:../view/login_page.php?msg=usuário e/ou senha inválidos" );
}
