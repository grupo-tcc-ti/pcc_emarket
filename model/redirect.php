<?php
class Redirect
{

    // Pegar hostname
    private static $hostname;
    // Pegar o diretorio atual com barra“/”
    private static $current_directory;

    // $page = 'page.php' Define o nome da pagina
    public static function page($page = 'page.php', $refresh_time)
    {
        if (!isset(self::$hostname)) {
            self::$hostname = $_SERVER['HTTP_HOST'];
        }
        if (!isset(self::$current_directory)) {
            self::$current_directory = rtrim(dirname($_SERVER['PHP_SELF']), '/');
        }
        if (!isset($refresh_time) || $refresh_time == 0) {
            header('location: http://' . self::$hostname . self::$current_directory . '/' . $page);
        } else {
            header('refresh:' . $refresh_time . ', url=http://' . self::$hostname . self::$current_directory . '/' . $page);
        }

    }
}

?>