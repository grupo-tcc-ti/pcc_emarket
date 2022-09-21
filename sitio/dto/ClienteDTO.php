<?php

class ClienteDTO
{
    private $id, $nome, $cpf, $datanascimento, $telefone;

    /* *
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /* *
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /* *
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /* *
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /* *
     * Get the value of cpf
     */ 
    public function getCpf()
    {
        return $this->cpf;
    }

    /* *
     * Set the value of cpf
     *
     * @return  self
     */ 
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /* *
     * Get the value of datanascimento
     */ 
    public function getDatanascimento()
    {
        return $this->datanascimento;
    }

    /* *
     * Set the value of datanascimento
     *
     * @return  self
     */ 
    public function setDatanascimento($datanascimento)
    {
        $this->datanascimento = $datanascimento;

        return $this;
    }

    /* *
     * Get the value of telefone
     */ 
    public function getTelefone()
    {
        return $this->telefone;
    }

    /* *
     * Set the value of telefone
     *
     * @return  self
     */ 
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }
}


?>