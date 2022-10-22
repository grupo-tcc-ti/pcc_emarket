<?php
require_once '../model/dto/ClienteDTO.php';
require_once '../model/dao/ClienteDAO.php';

$email = $_POST["email"];
$senha = $_POST["senha"];

$ClienteDTO = new ClienteDTO();
$ClienteDTO->setEmail( $email );
$ClienteDTO->setSenha( $senha );

$ClienteDAO    = new ClienteDAO();
$usuarioLogado = $ClienteDAO->login( $ClienteDTO );

if ( $usuarioLogado != null ) {
    session_start();
    $_SESSION["login"] = $usuarioLogado->getId();

    header( "location:../screens/home.php" );
//    echo "<script>";
//    echo "window.location.href = '../view/login.php'";
//    echo "</script>";
} else {
    header( "location:../screens/login_page.php?msg=usuário e/ou senha inválidos" );
}
