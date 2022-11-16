<?php
class CarrinhoDTO
{
    protected static $codCarrinho, $quantidade, $fk_usuarios_codUsuario, $fk_usuarios_codCliente, $fk_produtos_codProduto;


    /**
     * Get the value of codCarrinho
     */ 
    public static function getCodCarrinho()
    {
        return self::$codCarrinho;
    }

    /**
     * Set the value of codCarrinho
     *
     * @return self
     */ 
    public static function setCodCarrinho($codCarrinho)
    {
        self::$codCarrinho = $codCarrinho;

        
    }

    /**
     * Get the value of quantidade
     */ 
    public static function getQuantidade()
    {
        return self::$quantidade;
    }

    /**
     * Set the value of quantidade
     *
     * @return self
     */ 
    public static function setQuantidade($quantidade)
    {
        self::$quantidade = $quantidade;

        
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
     * Get the value of fk_produtos_codProduto
     */ 
    public static function getFk_produtos_codProduto()
    {
        return self::$fk_produtos_codProduto;
    }

    /**
     * Set the value of fk_produtos_codProduto
     *
     * @return self
     */ 
    public static function setFk_produtos_codProduto($fk_produtos_codProduto)
    {
        self::$fk_produtos_codProduto = $fk_produtos_codProduto;

        
    }
}
