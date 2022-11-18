<?php
class UsuariosDTO
{
    protected static $codUsuario, $nome, $email, $senha, $user_type, $codCliente, $codAdmin, $salario, $admissao, $demissao, $telefone, $cpf, $rg, $cnpj, $ie, $cep, $estado, $cidade, $endereco, $numero, $complemento;

	/**
	 * @return mixed
	 */
	public static function getCodUsuario() {
		return self::$codUsuario;
	}
	
	/**
	 * @param mixed $codUsuario 
	 */
	public static function setCodUsuario($codUsuario) {
		self::$codUsuario = $codUsuario;
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
	public static function getSenha() {
		return self::$senha;
	}
	
	/**
	 * @param mixed $senha 
	 */
	public static function setSenha($senha) {
		self::$senha = $senha;
	}
	
	/**
	 * @return mixed
	 */
	public static function getUser_type() {
		return self::$user_type;
	}
	
	/**
	 * @param mixed $user_type 
	 */
	public static function setUser_type($user_type) {
		self::$user_type = $user_type;
	}
	
	/**
	 * @return mixed
	 */
	public static function getCodCliente() {
		return self::$codCliente;
	}
	
	/**
	 * @param mixed $codCliente 
	 */
	public static function setCodCliente($codCliente) {
		self::$codCliente = $codCliente;
	}
	
	/**
	 * @return mixed
	 */
	public static function getCodAdmin() {
		return self::$codAdmin;
	}
	
	/**
	 * @param mixed $codAdmin 
	 */
	public static function setCodAdmin($codAdmin) {
		self::$codAdmin = $codAdmin;
	}
	
	/**
	 * @return mixed
	 */
	public static function getSalario() {
		return self::$salario;
	}
	
	/**
	 * @param mixed $salario 
	 */
	public static function setSalario($salario) {
		self::$salario = $salario;
	}
	
	/**
	 * @return mixed
	 */
	public static function getAdmissao() {
		return self::$admissao;
	}
	
	/**
	 * @param mixed $admissao 
	 */
	public static function setAdmissao($admissao) {
		self::$admissao = $admissao;
	}
	
	/**
	 * @return mixed
	 */
	public static function getDemissao() {
		return self::$demissao;
	}
	
	/**
	 * @param mixed $demissao 
	 */
	public static function setDemissao($demissao) {
		self::$demissao = $demissao;
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
	public static function getCpf() {
		return self::$cpf;
	}
	
	/**
	 * @param mixed $cpf 
	 */
	public static function setCpf($cpf) {
		self::$cpf = $cpf;
	}
	
	/**
	 * @return mixed
	 */
	public static function getRg() {
		return self::$rg;
	}
	
	/**
	 * @param mixed $rg 
	 */
	public static function setRg($rg) {
		self::$rg = $rg;
	}
	
	/**
	 * @return mixed
	 */
	public static function getCnpj() {
		return self::$cnpj;
	}
	
	/**
	 * @param mixed $cnpj 
	 */
	public static function setCnpj($cnpj) {
		self::$cnpj = $cnpj;
	}
	
	/**
	 * @return mixed
	 */
	public static function getIe() {
		return self::$ie;
	}
	
	/**
	 * @param mixed $ie 
	 */
	public static function setIe($ie) {
		self::$ie = $ie;
	}
	
	/**
	 * @return mixed
	 */
	public static function getCep() {
		return self::$cep;
	}
	
	/**
	 * @param mixed $cep 
	 */
	public static function setCep($cep) {
		self::$cep = $cep;
	}
	
	/**
	 * @return mixed
	 */
	public static function getEstado() {
		return self::$estado;
	}
	
	/**
	 * @param mixed $estado 
	 */
	public static function setEstado($estado) {
		self::$estado = $estado;
	}
	
	/**
	 * @return mixed
	 */
	public static function getCidade() {
		return self::$cidade;
	}
	
	/**
	 * @param mixed $cidade 
	 */
	public static function setCidade($cidade) {
		self::$cidade = $cidade;
	}
	
	/**
	 * @return mixed
	 */
	public static function getEndereco() {
		return self::$endereco;
	}
	
	/**
	 * @param mixed $endereco 
	 */
	public static function setEndereco($endereco) {
		self::$endereco = $endereco;
	}
	
	/**
	 * @return mixed
	 */
	public static function getNumero() {
		return self::$numero;
	}
	
	/**
	 * @param mixed $numero 
	 */
	public static function setNumero($numero) {
		self::$numero = $numero;
	}
	
	/**
	 * @return mixed
	 */
	public static function getComplemento() {
		return self::$complemento;
	}
	
	/**
	 * @param mixed $complemento 
	 */
	public static function setComplemento($complemento) {
		self::$complemento = $complemento;
	}
}
