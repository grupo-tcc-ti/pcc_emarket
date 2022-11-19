<?php
class CarrinhoDTO
{
    protected static $codCarrinho, $quantidade, $fk_codUsuario, $fk_codCliente, $fk_codProduto;

	/**
	 * @return mixed
	 */
	public static function getCodCarrinho() {
		return self::$codCarrinho;
	}
	
	/**
	 * @param mixed $codCarrinho 
	 */
	public static function setCodCarrinho($codCarrinho) {
		self::$codCarrinho = $codCarrinho;
	}
	
	/**
	 * @return mixed
	 */
	public static function getQuantidade() {
		return self::$quantidade;
	}
	
	/**
	 * @param mixed $quantidade 
	 */
	public static function setQuantidade($quantidade) {
		self::$quantidade = $quantidade;
	}
	
	/**
	 * @return mixed
	 */
	public static function getFk_codUsuario() {
		return self::$fk_codUsuario;
	}
	
	/**
	 * @param mixed $fk_codUsuario 
	 */
	public static function setFk_codUsuario($fk_codUsuario) {
		self::$fk_codUsuario = $fk_codUsuario;
	}
	
	/**
	 * @return mixed
	 */
	public static function getFk_codCliente() {
		return self::$fk_codCliente;
	}
	
	/**
	 * @param mixed $fk_codCliente 
	 */
	public static function setFk_codCliente($fk_codCliente) {
		self::$fk_codCliente = $fk_codCliente;
	}
	
	/**
	 * @return mixed
	 */
	public static function getFk_codProduto() {
		return self::$fk_codProduto;
	}
	
	/**
	 * @param mixed $fk_codProduto 
	 */
	public static function setFk_codProduto($fk_codProduto) {
		self::$fk_codProduto = $fk_codProduto;
	}
}
