<?php
class UsuariosDTO
{
    protected static $codUsuario, $nome, $email, $senha, $user_type, $codCliente, $codAdmin, $salario, $admissao, $demissao, $telefone, $cpf, $rg, $cnpj, $ie, $cep, $estado, $cidade, $logradouro, $numero, $complemento;
    

    /**
     * Get the value of codUsuario
     */ 
    public static function getCodUsuario()
    {
        return self::$codUsuario;
    }
 
    /**
     * Set the value of codUsuario
     *
     * @return self
     */ 
    public static function setCodUsuario($codUsuario)
    {
        self::$codUsuario = $codUsuario;
    }

    /**
     * Get the value of nome
     */ 
    public static function getNome()
    {
        return self::$nome;
    }

    /**
     * Set the value of nome
     *
     * @return self
     */ 
    public static function setNome($nome)
    {
        self::$nome = $nome;
    }

    /**
     * Get the value of email
     */ 
    public static function getEmail()
    {
        return self::$email;
    }

    /**
     * Set the value of email
     *
     * @return self
     */ 
    public static function setEmail($email)
    {
        self::$email = $email;
    }

    /**
     * Get the value of senha
     */ 
    public static function getSenha()
    {
        return self::$senha;
    }

    /**
     * Set the value of senha
     *
     * @return self
     */ 
    public static function setSenha($senha)
    {
        self::$senha = $senha;
    }

    /**
     * Get the value of user_type
     */ 
    public static function getUser_type()
    {
        return self::$user_type;
    }

    /**
     * Set the value of user_type
     *
     * @return self
     */ 
    public static function setUser_type($user_type)
    {
        self::$user_type = $user_type;
    }

    /**
     * Get the value of codCliente
     */ 
    public static function getCodCliente()
    {
        return self::$codCliente;
    }

    /**
     * Set the value of codCliente
     *
     * @return self
     */ 
    public static function setCodCliente($codCliente)
    {
        self::$codCliente = $codCliente;
    }

    /**
     * Get the value of codAdmin
     */ 
    public static function getCodAdmin()
    {
        return self::$codAdmin;
    }

    /**
     * Set the value of codAdmin
     *
     * @return self
     */ 
    public static function setCodAdmin($codAdmin)
    {
        self::$codAdmin = $codAdmin;
    }

    /**
     * Get the value of salario
     */ 
    public static function getSalario()
    {
        return self::$salario;
    }

    /**
     * Set the value of salario
     *
     * @return self
     */ 
    public static function setSalario($salario)
    {
        self::$salario = $salario;
    }

    /**
     * Get the value of admissao
     */ 
    public static function getAdmissao()
    {
        return self::$admissao;
    }

    /**
     * Set the value of admissao
     *
     * @return self
     */ 
    public static function setAdmissao($admissao)
    {
        self::$admissao = $admissao;
    }

    /**
     * Get the value of demissao
     */ 
    public static function getDemissao()
    {
        return self::$demissao;
    }

    /**
     * Set the value of demissao
     *
     * @return self
     */ 
    public static function setDemissao($demissao)
    {
        self::$demissao = $demissao;
    }

    /**
     * Get the value of telefone
     */ 
    public static function getTelefone()
    {
        return self::$telefone;
    }

    /**
     * Set the value of telefone
     *
     * @return self
     */ 
    public static function setTelefone($telefone)
    {
        self::$telefone = $telefone;
    }

    /**
     * Get the value of cpf
     */ 
    public static function getCpf()
    {
        return self::$cpf;
    }

    /**
     * Set the value of cpf
     *
     * @return self
     */ 
    public static function setCpf($cpf)
    {
        self::$cpf = $cpf;
    }

    /**
     * Get the value of rg
     */ 
    public static function getRg()
    {
        return self::$rg;
    }

    /**
     * Set the value of rg
     *
     * @return self
     */ 
    public static function setRg($rg)
    {
        self::$rg = $rg;
    }

    /**
     * Get the value of cnpj
     */ 
    public static function getCnpj()
    {
        return self::$cnpj;
    }

    /**
     * Set the value of cnpj
     *
     * @return self
     */ 
    public static function setCnpj($cnpj)
    {
        self::$cnpj = $cnpj;
    }

    /**
     * Get the value of ie
     */ 
    public static function getIe()
    {
        return self::$ie;
    }

    /**
     * Set the value of ie
     *
     * @return self
     */ 
    public static function setIe($ie)
    {
        self::$ie = $ie;
    }

    /**
     * Get the value of cep
     */ 
    public static function getCep()
    {
        return self::$cep;
    }

    /**
     * Set the value of cep
     *
     * @return self
     */ 
    public static function setCep($cep)
    {
        self::$cep = $cep;
    }

    /**
     * Get the value of estado
     */ 
    public static function getEstado()
    {
        return self::$estado;
    }

    /**
     * Set the value of estado
     *
     * @return self
     */ 
    public static function setEstado($estado)
    {
        self::$estado = $estado;
    }

    /**
     * Get the value of cidade
     */ 
    public static function getCidade()
    {
        return self::$cidade;
    }

    /**
     * Set the value of cidade
     *
     * @return self
     */ 
    public static function setCidade($cidade)
    {
        self::$cidade = $cidade;
    }

    /**
     * Get the value of logradouro
     */ 
    public static function getLogradouro()
    {
        return self::$logradouro;
    }

    /**
     * Set the value of logradouro
     *
     * @return self
     */ 
    public static function setLogradouro($logradouro)
    {
        self::$logradouro = $logradouro;
    }

    /**
     * Get the value of numero
     */ 
    public static function getNumero()
    {
        return self::$numero;
    }

    /**
     * Set the value of numero
     *
     * @return self
     */ 
    public static function setNumero($numero)
    {
        self::$numero = $numero;;
    }

    /**
     * Get the value of complemento
     */ 
    public static function getComplemento()
    {
        return self::$complemento;
    }

    /**
     * Set the value of complemento
     *
     * @return self
     */ 
    public static function setComplemento($complemento)
    {
        self::$complemento = $complemento;s;
    }
}
