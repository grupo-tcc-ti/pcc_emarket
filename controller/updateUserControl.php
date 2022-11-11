<?php
require_once '../model/connect.php';
require_once '../model/dao/UsuariosDAO.php';
require_once '../model/dto/UsuariosDTO.php';

if (isset($_POST['submit'])) {

    $usuarioDAO = UsuariosDAO::getUserByID(
        $user_id['type'],
        $user_id['id']
    );
    $updateData = new UsuariosDTO();
    // $updateData->setNome($_POST["nome"]);
    (isset($_POST["usuario"]))?$updateData->setNome($_POST["usuario"]):'';
    (isset($_POST["email"]))?$updateData->setEmail($_POST["email"]):'';
    $updateData->setSenha(
        array(
        'atual' => $_POST["senha_atual"], 
        'nova' => $_POST["senha_nova"],
        'confirma' => $_POST["senha_confirma"])
    );

    // UsuariosDAO::alterarUsuario($usuarioDAO, $updateData);
    $user = UsuariosDAO::alterarUsuario($usuarioDAO, $updateData);
    if (isset($user)) {
        if ($updateData->getUser_type() == 'admin') {
            Redirect::page('admin_contas.php', 2);
        } else {
            Redirect::page('../view/minha_conta.php', 2);
        }
    }
}
?>
