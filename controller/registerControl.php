<?php
require_once '../model/dto/UsuarioDTO.php';
require_once '../model/dao/UsuarioDAO.php';

$nome  = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];

$UsuarioDTO = new UsuarioDTO();
$UsuarioDTO->setNome( $nome );
$UsuarioDTO->setEmail( $email );
$UsuarioDTO->setSenha( $senha );

$UsuarioDAO = new UsuarioDAO();
$status     = $UsuarioDAO->register( $UsuarioDTO );

if ( $status != null ) {
    header( "location:../screens/login_page.php" );
}
?>