<?php
class ProdutosDTO
{
    protected static $codProduto, $nome, $descricao, $detalhes, $preco, $image;


    /**
     * Get the value of codProduto
     */ 
    public static function getCodProduto()
    {
        return self::$codProduto;
    }

    /**
     * Set the value of codProduto
     *
     * @return self
     */ 
    public static function setCodProduto($codProduto)
    {
        self::$codProduto = $codProduto;
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
     * Get the value of descricao
     */ 
    public static function getDescricao()
    {
        return self::$descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return self
     */ 
    public static function setDescricao($descricao)
    {
        self::$descricao = $descricao;
    }

    /**
     * Get the value of detalhes
     */ 
    public static function getDetalhes()
    {
        return self::$detalhes;
    }

    /**
     * Set the value of detalhes
     *
     * @return self
     */ 
    public static function setDetalhes($detalhes)
    {
        self::$detalhes = $detalhes;
    }

    /**
     * Get the value of preco
     */ 
    public static function getPreco()
    {
        return self::$preco;
    }

    /**
     * Set the value of preco
     *
     * @return self
     */ 
    public static function setPreco($preco)
    {
        self::$preco = $preco;
    }

    /**
     * Get the value of image
     */ 
    public static function getImage()
    {
        return self::$image;
    }

    /**
     * Set the value of image
     *
     * @return self
     */ 
    public static function setImage($image)
    {
        self::$image = $image;
    }
}
