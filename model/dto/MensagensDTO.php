<?php
class MensagensDTO
{
    protected static $codMensagem, $nome, $email, $telefone, $mensagem, $fk_usuarios_codUsuario, $fk_usuarios_codCliente, $fk_usuarios_codAdmin;

    /**
     * Get the value of codMensagem
     */ 
    public static function getCodMensagem()
    {
        return self::$codMensagem;
    }

    /**
     * Set the value of codMensagem
     *
     * @return self
     */ 
    public static function setCodMensagem($codMensagem)
    {
        self::$codMensagem = $codMensagem;

        
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
     * Get the value of mensagem
     */ 
    public static function getMensagem()
    {
        return self::$mensagem;
    }

    /**
     * Set the value of mensagem
     *
     * @return self
     */ 
    public static function setMensagem($mensagem)
    {
        self::$mensagem = $mensagem;

        
    }

    /**
     * Get the value of fk_usuarios_codUsuario
     */ 
    public static function getFk_usuarios_codUsuario()
    {
        return self::$fk_usuarios_codUsuario;
    }

    /**
     * Set the value of fk_usuarios_codUsuario
     *
     * @return self
     */ 
    public static function setFk_usuarios_codUsuario($fk_usuarios_codUsuario)
    {
        self::$fk_usuarios_codUsuario = $fk_usuarios_codUsuario;

        
    }

    /**
     * Get the value of fk_usuarios_codCliente
     */ 
    public static function getFk_usuarios_codCliente()
    {
        return self::$fk_usuarios_codCliente;
    }

    /**
     * Set the value of fk_usuarios_codCliente
     *
     * @return self
     */ 
    public static function setFk_usuarios_codCliente($fk_usuarios_codCliente)
    {
        self::$fk_usuarios_codCliente = $fk_usuarios_codCliente;

        
    }

    /**
     * Get the value of fk_usuarios_codAdmin
     */ 
    public static function getFk_usuarios_codAdmin()
    {
        return self::$fk_usuarios_codAdmin;
    }

    /**
     * Set the value of fk_usuarios_codAdmin
     *
     * @return self
     */ 
    public static function setFk_usuarios_codAdmin($fk_usuarios_codAdmin)
    {
        self::$fk_usuarios_codAdmin = $fk_usuarios_codAdmin;

        
    }
}
