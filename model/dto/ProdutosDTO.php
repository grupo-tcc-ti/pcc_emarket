<?php
class ProdutosDTO
{
    protected static $codProduto, $nome, $descricao, $detalhes, $preco, $image;

	/**
	 * @return mixed
	 */
	public static function getCodProduto() {
		return self::$codProduto;
	}
	
	/**
	 * @param mixed $codProduto 
	 */
	public static function setCodProduto($codProduto) {
		self::$codProduto = $codProduto;
	}
	
	/**
	 * @return mixed
	 */
	public static function getNome() {
		return self::$nome;
	}
	
	/**
	 * @param mixed $nome 
	 */
	public static function setNome($nome) {
		self::$nome = $nome;
	}
	
	/**
	 * @return mixed
	 */
	public static function getDescricao() {
		return self::$descricao;
	}
	
	/**
	 * @param mixed $descricao 
	 */
	public static function setDescricao($descricao) {
		self::$descricao = $descricao;
	}
	
	/**
	 * @return mixed
	 */
	public static function getDetalhes() {
		return self::$detalhes;
	}
	
	/**
	 * @param mixed $detalhes 
	 */
	public static function setDetalhes($detalhes) {
		self::$detalhes = $detalhes;
	}
	
	/**
	 * @return mixed
	 */
	public static function getPreco() {
		return self::$preco;
	}
	
	/**
	 * @param mixed $preco 
	 */
	public static function setPreco($preco) {
		self::$preco = $preco;
	}
	
	/**
	 * @return mixed
	 */
	public static function getImage() {
		return self::$image;
	}
	
	/**
	 * @param mixed $image 
	 */
	public static function setImage($image) {
		self::$image = $image;
	}
}
