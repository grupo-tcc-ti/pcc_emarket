<?php
require_once 'redirect.php';
require_once 'path_locale.php';
require 'popup_msg.php';
class Connect
{
    private static $instance;

    private static $db_name  = 'mysql:host=localhost; dbname=emarket';
    private static $username = 'root';
    private static $password = '';

    public static function getInstance()
    {
        try {
            if (!isset(self::$instance) ) {
                self::$instance = new PDO(self::$db_name, self::$username, self::$password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch ( PDOException $msg ) {
            echo "Erro ao conectar :: " . $msg->getMessage();
        }
        return self::$instance;
    }

    /**
     * Set the value of db_name
     *
     * @return self
     */
    public function setDb_name( $db_name = 'emarket' )
    {
        $this->db_name = 'mysql:host=localhost; dbname=' . $db_name;

        return $this;
    }

    /**
     * Set the value of username
     *
     * @return self
     */
    public function setUsername( $username = 'root' )
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the value of password
     *
     * @return self
     */
    public function setPassword( $password = '' )
    {
        $this->password = $password;

        return $this;
    }
}

$pdo = Connect::getInstance();
// $conn = Connect::getInstance();
?>
