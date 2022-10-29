<?php
require_once __DIR__ . '/../_connection.php';
require_once __DIR__ . '/../dto/_AdminDTO.php';

class _AdminDAO
{
    private $con;

    public function __construct()
    {
        $this->con = _Conexao::getInstance(); //connect on function call
    }

    public function login( _AdminDTO $Admin )
    {
        try {
            // $sql  = "SELECT * FROM usuarios WHERE email =? AND senha=?";
            // $stmt = $this->con->prepare( $sql );
            // $stmt->bindValue( 1, $Cliente->getEmail() );
            // $stmt->bindValue( 2, MD5( $Cliente->getSenha() ) );
            // $stmt->execute();

            $usuario = $Admin->getAdminNome();
            $senha   = $Admin->getAdminSenha();

            $sql       = "SELECT * FROM admins WHERE nome =? AND senha =?";
            $sql_query = $this->con->prepare($sql);
            $sql_query->bindParam(1, $usuario);
            $sql_query->bindParam(2, $senha);
            $sql_query->execute();
            $sql_fetch = $sql_query->fetch(PDO::FETCH_ASSOC);

            if ($sql_fetch != null ) {
                $admin = new _AdminDTO();
                $admin->setAdminID($sql_fetch["codAdmin"]);
                $_SESSION['admin_id'] = $sql_fetch['codAdmin'];
                return $admin;
            } else {
                $mensagem[] = 'Nome de usuário ou senha incorreto!';
            }

            return null;

        } catch ( PDOException $e ) {
            session_destroy();
            echo $e->getMessage();
            die();
        }
    }

    public function register( _AdminDTO $adminDTO )
    {
        try {
            $sql = "INSERT INTO admins (nome, senha) ";
            $sql .= " VALUES(?, ?)";
            $sql_query = $this->con->prepare($sql);
            $sql_query->bindValue(1, $adminDTO->getAdminNome());
            $sql_query->bindValue(2, $adminDTO->getAdminSenha());

            return $sql_query->execute();

        } catch ( PDOException $e ) {
            session_destroy();
            echo $e->getMessage();
            die();
        }
    }
}
?>
