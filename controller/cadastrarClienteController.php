<?php

    require_once '../dto/ClienteDTO.php';
    require_once '../dao/ClienteDAO.php';

    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $dataNascimento = $_POST["dtnas"];
    $telefone = $_POST["tel"];

    $ClienteDTO = new ClienteDTO();
    $ClienteDTO->setNome ($nome);
    $ClienteDTO->setCpf ($cpf);
    $ClienteDTO->setDataNascimento ($dataNascimento);
    $ClienteDTO->setTelefone ($telefone);

    $ClienteDAO = new ClienteDAO();
    $ClienteDAO->salvar($ClienteDTO);
?>