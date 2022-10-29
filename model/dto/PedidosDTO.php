<?php
class PedidosDTO
{
    protected static $codPedido, $tipoEntrega, $totalProduto, $totalPreco, $dataEnvio, $dataEntrega, $statusPagamento, $fk_usuarios_codUsuario, $fk_usuarios_codCliente;


    /**
     * Get the value of codPedido
     */ 
    public function getCodPedido()
    {
        return self::$codPedido;
    }

    /**
     * Set the value of codPedido
     *
     * @return self
     */ 
    public function setCodPedido($codPedido)
    {
        self::$codPedido = $codPedido;

        return self::class;
    }

    /**
     * Get the value of tipoEntrega
     */ 
    public function getTipoEntrega()
    {
        return self::$tipoEntrega;
    }

    /**
     * Set the value of tipoEntrega
     *
     * @return self
     */ 
    public function setTipoEntrega($tipoEntrega)
    {
        self::$tipoEntrega = $tipoEntrega;

        return self::class;
    }

    /**
     * Get the value of totalProduto
     */ 
    public function getTotalProduto()
    {
        return self::$totalProduto;
    }

    /**
     * Set the value of totalProduto
     *
     * @return self
     */ 
    public function setTotalProduto($totalProduto)
    {
        self::$totalProduto = $totalProduto;

        return self::class;
    }

    /**
     * Get the value of totalPreco
     */ 
    public function getTotalPreco()
    {
        return self::$totalPreco;
    }

    /**
     * Set the value of totalPreco
     *
     * @return self
     */ 
    public function setTotalPreco($totalPreco)
    {
        self::$totalPreco = $totalPreco;

        return self::class;
    }

    /**
     * Get the value of dataEnvio
     */ 
    public function getDataEnvio()
    {
        return self::$dataEnvio;
    }

    /**
     * Set the value of dataEnvio
     *
     * @return self
     */ 
    public function setDataEnvio($dataEnvio)
    {
        self::$dataEnvio = $dataEnvio;

        return self::class;
    }

    /**
     * Get the value of dataEntrega
     */ 
    public function getDataEntrega()
    {
        return self::$dataEntrega;
    }

    /**
     * Set the value of dataEntrega
     *
     * @return self
     */ 
    public function setDataEntrega($dataEntrega)
    {
        self::$dataEntrega = $dataEntrega;

        return self::class;
    }

    /**
     * Get the value of statusPagamento
     */ 
    public function getStatusPagamento()
    {
        return self::$statusPagamento;
    }

    /**
     * Set the value of statusPagamento
     *
     * @return self
     */ 
    public function setStatusPagamento($statusPagamento)
    {
        self::$statusPagamento = $statusPagamento;

        return self::class;
    }

    /**
     * Get the value of fk_usuarios_codUsuario
     */ 
    public function getFk_usuarios_codUsuario()
    {
        return self::$fk_usuarios_codUsuario;
    }

    /**
     * Set the value of fk_usuarios_codUsuario
     *
     * @return self
     */ 
    public function setFk_usuarios_codUsuario($fk_usuarios_codUsuario)
    {
        self::$fk_usuarios_codUsuario = $fk_usuarios_codUsuario;

        return self::class;
    }

    /**
     * Get the value of fk_usuarios_codCliente
     */ 
    public function getFk_usuarios_codCliente()
    {
        return self::$fk_usuarios_codCliente;
    }

    /**
     * Set the value of fk_usuarios_codCliente
     *
     * @return self
     */ 
    public function setFk_usuarios_codCliente($fk_usuarios_codCliente)
    {
        self::$fk_usuarios_codCliente = $fk_usuarios_codCliente;

        return self::class;
    }
}
