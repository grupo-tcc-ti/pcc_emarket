<?php
require_once '../model/dto/ClienteDTO.php';
require_once '../model/dao/ClienteDAO.php';

$nome  = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];

$ClienteDTO = new ClienteDTO();
$ClienteDTO->setNome( $nome );
$ClienteDTO->setEmail( $email );
$ClienteDTO->setSenha( $senha );

$ClienteDAO = new ClienteDAO();
$status     = $ClienteDAO->register( $ClienteDTO );

if ( $status != null ) {
    header( "location:../screens/login_page.php" );
}
?>