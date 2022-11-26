<?php
if (!isset($pdo)) {
    include_once '../model/connect.php';
    //undo requirefolder if fails!
    File_Path::requireFolder('../model/dao');
    File_Path::requireFolder('../model/dto');
}

if (isset($_POST['submit'])) {
    (isset($_POST["admin_id"])) ? $uid = $_SESSION['admin_id']: '';
    (isset($_POST["client_id"])) ? $uid = $_SESSION['client_id']: '';
    $usuarioDAO = UsuariosDAO::getUserByID(
        $uid['type'],
        $uid['id']
    );
    $updateData = new UsuariosDTO();
    $updateData->setUser_type($uid['type']);
    (isset($_POST["usuario"])) ? $updateData->setNome($_POST["usuario"]) : '';
    (isset($_POST["email"])) ? $updateData->setEmail($_POST["email"]) : '';
    (isset($_POST["cpf"])) ? $updateData->setCpf($_POST["cpf"]) : '';
    (isset($_POST["rg"])) ? $updateData->setRg($_POST["rg"]) : '';
    (isset($_POST["ie"])) ? $updateData->setIe($_POST["ie"]) : '';
    (isset($_POST["cnpj"])) ? $updateData->setCnpj($_POST["cnpj"]) : '';
    (isset($_POST["telefone"])) ? $updateData->setTelefone($_POST["telefone"]) : '';

    (isset($_POST["senha_confirma"])) ? 
        $updateData->setSenha(
            array(
                'atual' => $_POST["senha_atual"],
                'nova' => $_POST["senha_nova"],
                'confirma' => $_POST["senha_confirma"]
            )
        ) : '';

    (isset($_POST["cep"])) ? $updateData->setCep($_POST["cep"]) : '';
    (isset($_POST["estado"])) ? $updateData->setEstado($_POST["estado"]) : '';
    (isset($_POST["cidade"])) ? $updateData->setCidade($_POST["cidade"]) : '';
    (isset($_POST["endereco"])) ? $updateData->setEndereco($_POST["endereco"]) : '';
    (isset($_POST["numero"])) ? $updateData->setNumero($_POST["numero"]) : '';
    (isset($_POST["complemento"])) ? $updateData->setComplemento($_POST["complemento"]) : '';

    if (!is_null(UsuariosDAO::alterarUsuario($usuarioDAO, $updateData))) {
        Message::pop('alteracao_terminou!');
        if ($updateData->getUser_type() == 'admin') {
            Redirect::page('admin_contas.php', 2);
        } else {
            Redirect::page(Redirect::directory($_SERVER['PHP_SELF']) . '/minha_conta.php', 2);
        }
    }
}
?>