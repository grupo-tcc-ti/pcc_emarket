<?php
require_once '../model/dto/UsuarioDTO.php';
require_once '../model/dao/UsuarioDAO.php';

$email = $_POST["email"];
$senha = $_POST["senha"];

$UsuarioDTO = new UsuarioDTO();
$UsuarioDTO->setEmail( $email );
$UsuarioDTO->setSenha( $senha );

$UsuarioDAO    = new UsuarioDAO();
$usuarioLogado = $UsuarioDAO->login( $UsuarioDTO );

if ( $usuarioLogado != null ) {
    session_start();
    $_SESSION["login"] = $usuarioLogado->getId();
    $nome              = $usuarioLogado->getNome();
    $sql               = Conexao::getInstance();
    $sql_code          = "SELECT * FROM admins WHERE nome = '$nome'";
    $sql_query         = $sql->prepare( $sql_code );
    $sql_query->execute();
    $total = $sql_query->rowCount();

    if ( $total > 0 ) {
        $_SESSION["isAdmin"]    = "true";
        $_SESSION["nomeAdmin"]  = $nome;
        $_SESSION["senhaAdmin"] = sha1( $UsuarioDTO->getSenha() );
    } else {
        $_SESSION["isAdmin"] = "false";
    }

    header( "location:../screens/home.php" );
} else {
    session_destroy();
    header( "location:../screens/login_page.php?msg=usuário e/ou senha inválidos" );
}
