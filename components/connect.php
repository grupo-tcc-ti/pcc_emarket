<?php
$db_name = 'mysql:host=localhost; dbname=emarket';
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_name, $user_name, $user_password);

class Connect {
    private static $instance;
    private $pdo;

    private static $db_name = 'mysql:host=localhost; dbname=emarket';
    private static $username = 'root';
    private static $password = '';


    private function __construct(
        // PDO $driver
    ){
        // $this->pdo = $driver;
        
    }

    public static function getInstance() {
        try {
            if (!isset(self::$instance)) {
                // self::$instance = new PDO('mysql:host=localhost; dbname=emarket', 'root', '');
                self::$instance = new PDO(self::$db_name, self::$username, self::$password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: ".$msg->getMessage();
        }
        return self::$instance;
    }

    /**
     * Set the value of db_name
     *
     * @return  self
     */ 
    public function setDb_name($db_name)
    {
        $this->db_name = $db_name;

        return $this;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}

?>