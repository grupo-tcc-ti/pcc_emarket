<?php
if (!isset($pdo)) {
    include_once '../model/connect.php';
}
require_once '../model/dao/UsuariosDAO.php';
require_once '../model/dto/UsuariosDTO.php';

if (isset($_POST['register'])) {

    $usuarioDTO = new UsuariosDTO();
    (isset($_POST["usertype"])) ? $usuarioDTO->setUser_type($_POST["usertype"]) : '';
    (isset($_POST["nome"])) ? $usuarioDTO->setNome($_POST["nome"]) : '';
    (isset($_POST["email"])) ? $usuarioDTO->setEmail($_POST["email"]) : '';
    (isset($_POST["rsenha"])) ? $usuarioDTO->setSenha(array($_POST["senha"], $_POST["rsenha"])) : '';

    (isset($_POST["cpf"])) ? $usuarioDTO->setCpf($_POST["cpf"]) : '';
    (isset($_POST["rg"])) ? $usuarioDTO->setRg($_POST["rg"]) : '';
    (isset($_POST["ie"])) ? $usuarioDTO->setIe($_POST["ie"]) : '';
    (isset($_POST["cnpj"])) ? $usuarioDTO->setCnpj($_POST["cnpj"]) : '';

    (isset($_POST["telefone"])) ? $usuarioDTO->setTelefone($_POST["telefone"]) : '';
    (isset($_POST["cep"])) ? $usuarioDTO->setCep($_POST["cep"]) : '';
    (isset($_POST["estado"])) ? $usuarioDTO->setEstado($_POST["estado"]) : '';
    (isset($_POST["cidade"])) ? $usuarioDTO->setCidade($_POST["cidade"]) : '';
    (isset($_POST["endereco"])) ? $usuarioDTO->setEndereco($_POST["endereco"]) : '';
    (isset($_POST["numero"])) ? $usuarioDTO->setNumero($_POST["numero"]) : '';
    (isset($_POST["complemento"])) ? $usuarioDTO->setComplemento($_POST["complemento"]) : '';


    if (UsuariosDAO::cadastrarUsuario($usuarioDTO)) {
        Message::pop('Cadastro realizado com Sucesso!');
        Redirect::page(Redirect::directory($_SERVER['PHP_SELF']) . '/conta.php', 2);
    }
}
?>