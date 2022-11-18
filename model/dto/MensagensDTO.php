<?php
class MensagensDTO
{
    protected static $codMensagem, $nome, $email, $telefone, $mensagem, $fk_usuarios_codUsuario, $fk_usuarios_codCliente, $fk_usuarios_codAdmin;

	/**
	 * @return mixed
	 */
	public static function getCodMensagem() {
		return self::$codMensagem;
	}
	
	/**
	 * @param mixed $codMensagem 
	 */
	public static function setCodMensagem($codMensagem) {
		self::$codMensagem = $codMensagem;
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
	public static function getEmail() {
		return self::$email;
	}
	
	/**
	 * @param mixed $email 
	 */
	public static function setEmail($email) {
		self::$email = $email;
	}
	
	/**
	 * @return mixed
	 */
	public static function getTelefone() {
		return self::$telefone;
	}
	
	/**
	 * @param mixed $telefone 
	 */
	public static function setTelefone($telefone) {
		self::$telefone = $telefone;
	}
	
	/**
	 * @return mixed
	 */
	public static function getMensagem() {
		return self::$mensagem;
	}
	
	/**
	 * @param mixed $mensagem 
	 */
	public static function setMensagem($mensagem) {
		self::$mensagem = $mensagem;
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
	public static function getFk_usuarios_codAdmin() {
		return self::$fk_usuarios_codAdmin;
	}
	
	/**
	 * @param mixed $fk_usuarios_codAdmin 
	 */
	public static function setFk_usuarios_codAdmin($fk_usuarios_codAdmin) {
		self::$fk_usuarios_codAdmin = $fk_usuarios_codAdmin;
	}
}
