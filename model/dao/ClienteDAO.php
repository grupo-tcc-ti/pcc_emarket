<?php
require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../dto/ClienteDTO.php';

class ClienteDAO {
    private $con;

    public function __construct() {
        $this->con = Conexao::getInstance(); //connect on function call
    }

    public function login( ClienteDTO $Cliente ) {
        try {
            $sql  = "Select * from usuarios where email =? AND senha=?";
            $stmt = $this->con->prepare( $sql );
            $stmt->bindValue( 1, $Cliente->getEmail() );
            $stmt->bindValue( 2, MD5( $Cliente->getSenha() ) );
            $stmt->execute();
            $usuarioFetch = $stmt->fetch( PDO::FETCH_ASSOC );

            if ( $usuarioFetch != NULL ) {
                $usuario = new ClienteDTO();
                $usuario->setEmail( $usuarioFetch["codUsuario"] );
                $usuario->setNome( $usuarioFetch["nome"] );

                return $usuario;
            }

        } catch ( PDOException $e ) {
            echo $e->getMessage();
            die();
        }
    }

    public function register( ClienteDTO $usuarioDTO ) {
        try {
            $sql = "INSERT INTO usuarios (nome, email, senha) ";
            $sql .= " VALUES(?, ?, ?)";
            $stmt = $this->con->prepare( $sql );
            $stmt->bindValue( 1, $usuarioDTO->getNome() );
            $stmt->bindValue( 2, $usuarioDTO->getEmail() );
            $stmt->bindValue( 3, $usuarioDTO->getSenha() );

            return $stmt->execute();

        } catch ( PDOException $e ) {
            echo $e->getMessage();
            die();
        }
    }
}
?>