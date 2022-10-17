<?php

class ClienteDTO {
    private $id, $nome, $email, $senha, $telefone, $cpf, $datanascimento, $tipo;

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome( $x ) {
        $this->nome = $x;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail( $x ) {
        $this->email = $x;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha( $x ) {
        $this->senha = $x;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf( $x ) {
        $this->cpf = $x;
    }

    public function getDatanascimento() {
        return $this->datanascimento;
    }

    public function setDatanascimento( $x ) {
        $this->datanascimento = $x;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone( $x ) {
        $this->telefone = $x;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo( $x ) {
        $this->tipo = $x;
    }
}

?>