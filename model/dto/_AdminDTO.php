<?php

class _AdminDTO
{
    private $adminID, $nome, $senha;

    public function getAdminID()
    {
        return $this->adminID;
    }

    public function setAdminID( $x )
    {
        $this->adminID = $x;
    }

    public function getAdminNome()
    {
        return $this->nome;
    }

    public function setAdminNome( $x )
    {
        $this->nome = $x;
    }

    public function getAdminSenha()
    {
        return $this->senha;
    }

    public function setAdminSenha( $x )
    {
        $this->senha = $x;
    }
}

?>
