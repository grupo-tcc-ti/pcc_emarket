<?php

require_once 'conexao/Conexao.php';

class ClienteDAO
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }
    public function salvar (ClienteDTO $clienteDTO)
    {
        try
        {
            $sql = "INSERT INTO tb_cliente"
            ."(nome,cpf,datanascascimento,telefone)"
            ."VALUES(:nome,:cpf,:dtnasc,:tel)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":nome",$clienteDTO->getNome());
            $stmt->bindValue(":cpf",$clienteDTO->getCpf());
            $stmt->bindValue(":dtnasc",$clienteDTO->getDataNascimento());
            $stmt->bindValue(":tel",$clienteDTO->getTelefone());
            $stmt->execute();
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}

?>