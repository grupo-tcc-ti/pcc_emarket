<?php
require_once '../model/dto/_UsuarioDTO.php';
require_once '../model/dao/_UsuarioDAO.php';

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
    header( "location:../view/login_page.php" );
}
?>