<?php
/*
 * Essa classe representa o modelo da tabela.
 * DTO - Data Transfer Object
 */
class ProdutoDTO {
    private $idProduto;
    private $descricao;
    private $valorUnitario;
    private $codigo;
    private $imagem;
    
    public function getIdProduto() {
        return $this->idProduto;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getValorUnitario() {
        return $this->valorUnitario;
    }
    
    public function getCodigo() {
        return $this->codigo;
    }
    
    public function getImagem() {
        return $this->imagem;
    }
    

    public function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setValorUnitario($valorUnitario) {
        $this->valorUnitario = $valorUnitario;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

}
