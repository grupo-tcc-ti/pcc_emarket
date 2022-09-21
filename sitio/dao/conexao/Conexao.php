<?php 
abstract class Conexao
{
    private static $instance;
    /**
     * @return PDO
     */
    public static function getInstance()
    {
        try 
        {
            if (!isset (self::$instance))
            {
                self::$instance = new PDO ('mysql:host=127.0.0.1;dbname=emarket', 'root', '');
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXECPTION);
            }
            return self::$instance;
        } catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}
?>