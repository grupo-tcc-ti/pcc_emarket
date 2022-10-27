<?php
require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../dto/UsuarioDTO.php';

class UsuarioDAO {
    private $con;

    public function __construct() {
        $this->con = Conexao::getInstance(); //connect on function call
    }

    public function login( UsuarioDTO $Cliente ) {
        try {
            $sql  = "SELECT * FROM usuarios WHERE email =? AND senha=?";
            $stmt = $this->con->prepare( $sql );
            $stmt->bindValue( 1, $Cliente->getEmail() );
            $stmt->bindValue( 2, sha1( $Cliente->getSenha() ) );
            $stmt->execute();
            $fetchUser = $stmt->fetch( PDO::FETCH_ASSOC );

            if ( $fetchUser ) {
                $usuario = new UsuarioDTO();
                $usuario->setEmail( $fetchUser["email"] );
                $usuario->setNome( $fetchUser["nome"] );
                $usuario->setId( $fetchUser["codUsuario"] );
                $usuario->setSenha( sha1( $Cliente->getSenha() ) );
                return $usuario;
            }

            return null;

        } catch ( PDOException $e ) {
            echo $e->getMessage();
            die();
        }
    }

    public function register( UsuarioDTO $usuarioDTO ) {
        try {
            $sql = "INSERT INTO usuarios (nome, email, senha) ";
            $sql .= " VALUES(?, ?, ?)";
            $stmt = $this->con->prepare( $sql );
            $stmt->bindValue( 1, $usuarioDTO->getNome() );
            $stmt->bindValue( 2, $usuarioDTO->getEmail() );
            $stmt->bindValue( 3, sha1( $usuarioDTO->getSenha() ) );

            return $stmt->execute();

        } catch ( PDOException $e ) {
            echo $e->getMessage();
            die();
        }
    }
}
?>