<?php
if (!isset($pdo)) {
    include_once '../model/connect.php';
}
require_once '../model/dao/_UsuariosDAO.php';
require_once '../model/dto/UsuariosDTO.php';

$usuarioDAO = UsuariosDAO::getUserByID(
    $user_id['type'],
    $user_id['id']
);

$updateData = new UsuariosDTO();

if (isset($_POST['update_conta'])) {
   
    (isset($_POST["usuario"]))?$updateData->setNome($_POST["usuario"]):'';
    (isset($_POST["email"]))?$updateData->setEmail($_POST["email"]):'';
    $updateData->setSenha(
        array(
        'atual' => $_POST["senha_atual"], 
        'nova' => $_POST["senha_nova"],
        'confirma' => $_POST["senha_confirma"])
    );

    // UsuariosDAO::alterarUsuario($usuarioDAO, $updateData);
    // $user = UsuariosDAO::alterarUsuario2($usuarioDAO, $updateData);
}

if (isset($_POST['update_addr'])) {

    (isset($_POST["cidade"])) ? $updateData->setCidade($_POST["cidade"]) : '';
    (isset($_POST["bairro"])) ? $updateData->setEndereco($_POST["bairro"]) : '';
    (isset($_POST["numero"])) ? $updateData->setNumero($_POST["numero"]) : '';
    (isset($_POST["cep"])) ? $updateData->setCep($_POST["cep"]) : '';
    (isset($_POST["telefone"])) ? $updateData->setTelefone($_POST["telefone"]) : '';
    (isset($_POST["CPF"])) ? $updateData->setCpf($_POST["CPF"]) : '';
    (isset($_POST["RG"])) ? $updateData->setRg($_POST["RG"]) : '';

    UsuariosDAO::alterarUsuario3($usuarioDAO, $updateData);
}
?>
