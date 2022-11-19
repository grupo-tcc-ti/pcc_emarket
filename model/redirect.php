<?php
class Redirect
{

    // Pegar hostname
    private static $hostname;
    // Pegar o diretorio atual com barra“/”
    private static $current_directory;

    // $page = 'page.php' Define o nome da pagina
    // $self = self caso esteja usando 'PHP_SELF'
    public static function page($page = 'page.php', $refresh_time = 0, $self = 'goto')
    {
        if (!isset(self::$hostname)) {
            self::$hostname = $_SERVER['HTTP_HOST'];
        }
        if (!isset(self::$current_directory)) {
            self::$current_directory = rtrim(dirname($_SERVER['PHP_SELF']), '/');
        }
        switch (true) {
            case ($refresh_time != 0):
                header('refresh:' . $refresh_time . ', url=http://' . self::$hostname . self::$current_directory . '/' . $page);
                break;
            case ($self == 'self'):
                header('refresh:' . $refresh_time . ', url=http://' . self::$hostname . self::trimPage($page));
                break;
            case ($refresh_time == 0):
                header('location: http://' . self::$hostname . self::$current_directory . '/' . $page);
                break;
            default:
                header('location: ' . Redirect::directory($_SERVER['PHP_SELF']));
                die();
        }

        // if ($refresh_time != 0) {
        //     header('refresh:' . $refresh_time . ', url=http://' . self::$hostname . self::$current_directory . '/' . $page);
        // } else if ($self == 'self') {
        //     header('refresh:' . $refresh_time . ', url=http://' . self::$hostname . self::trimPage($page));
        // } else {
        //     header('location: http://' . self::$hostname . self::$current_directory . '/' . $page);
        // }
    }
    public static function trimPage($page)
    {
        $trimmed = rtrim($page, '/');
        return $trimmed;
    }
    public static function directory($page)
    {
        $trimmed = rtrim(dirname($page), '/');
        return $trimmed;
    }
}

?>