<?php
class PedidosDTO
{
    protected static $codPedido, $tipoEntrega, $totalProduto, $totalPreco, $dataEnvio, $dataEntrega, $statusPagamento, $fk_usuarios_codUsuario, $fk_usuarios_codCliente;

	/**
	 * @return mixed
	 */
	public static function getCodPedido() {
		return self::$codPedido;
	}
	
	/**
	 * @param mixed $codPedido 
	 */
	public static function setCodPedido($codPedido) {
		self::$codPedido = $codPedido;
	}
	
	/**
	 * @return mixed
	 */
	public static function getTipoEntrega() {
		return self::$tipoEntrega;
	}
	
	/**
	 * @param mixed $tipoEntrega 
	 */
	public static function setTipoEntrega($tipoEntrega) {
		self::$tipoEntrega = $tipoEntrega;
	}
	
	/**
	 * @return mixed
	 */
	public static function getTotalProduto() {
		return self::$totalProduto;
	}
	
	/**
	 * @param mixed $totalProduto 
	 */
	public static function setTotalProduto($totalProduto) {
		self::$totalProduto = $totalProduto;
	}
	
	/**
	 * @return mixed
	 */
	public static function getTotalPreco() {
		return self::$totalPreco;
	}
	
	/**
	 * @param mixed $totalPreco 
	 */
	public static function setTotalPreco($totalPreco) {
		self::$totalPreco = $totalPreco;
	}
	
	/**
	 * @return mixed
	 */
	public static function getDataEnvio() {
		return self::$dataEnvio;
	}
	
	/**
	 * @param mixed $dataEnvio 
	 */
	public static function setDataEnvio($dataEnvio) {
		self::$dataEnvio = $dataEnvio;
	}
	
	/**
	 * @return mixed
	 */
	public static function getDataEntrega() {
		return self::$dataEntrega;
	}
	
	/**
	 * @param mixed $dataEntrega 
	 */
	public static function setDataEntrega($dataEntrega) {
		self::$dataEntrega = $dataEntrega;
	}
	
	/**
	 * @return mixed
	 */
	public static function getStatusPagamento() {
		return self::$statusPagamento;
	}
	
	/**
	 * @param mixed $statusPagamento 
	 */
	public static function setStatusPagamento($statusPagamento) {
		self::$statusPagamento = $statusPagamento;
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
}
