<?php
class CarrinhoDTO
{
    protected static $codCarrinho, $quantidade, $fk_usuarios_codUsuario, $fk_usuarios_codCliente, $fk_produtos_codProduto;
    

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
	public static function getFk_usuarios_codUsuario() {
		return self::$fk_usuarios_codUsuario;
	}
	
	/**
	 * @param mixed $fk_usuarios_codUsuario 
	 */
	public static function setFk_usuarios_codUsuario($fk_usuarios_codUsuario) {
		self::$fk_usuarios_codUsuario = $fk_usuarios_codUsuario;
	}
	
	/**
	 * @return mixed
	 */
	public static function getFk_usuarios_codCliente() {
		return self::$fk_usuarios_codCliente;
	}
	
	/**
	 * @param mixed $fk_usuarios_codCliente 
	 */
	public static function setFk_usuarios_codCliente($fk_usuarios_codCliente) {
		self::$fk_usuarios_codCliente = $fk_usuarios_codCliente;
	}
	
	/**
	 * @return mixed
	 */
	public static function getFk_produtos_codProduto() {
		return self::$fk_produtos_codProduto;
	}
	
	/**
	 * @param mixed $fk_produtos_codProduto 
	 */
	public static function setFk_produtos_codProduto($fk_produtos_codProduto) {
		self::$fk_produtos_codProduto = $fk_produtos_codProduto;
	}
}
