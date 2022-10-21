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
            $sql  = "SELECT * FROM usuarios WHERE email =? AND senha=?";
            $stmt = $this->con->prepare( $sql );
            $stmt->bindValue( 1, $Cliente->getEmail() );
            $stmt->bindValue( 2, MD5($Cliente->getSenha()) );
            $stmt->execute();
            $fetchUser = $stmt->fetch( PDO::FETCH_ASSOC );

          
            if ( $fetchUser != NULL ) {
                $usuario = new ClienteDTO();
                $usuario->setEmail( $fetchUser["email"] );
                $usuario->setNome( $fetchUser["nome"] );
                $usuario->setId($fetchUser["codUsuario"]);
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
            $stmt->bindValue( 3, MD5($usuarioDTO->getSenha()) );

            return $stmt->execute();

        } catch ( PDOException $e ) {
            echo $e->getMessage();
            die();
        }
    }
}
?>