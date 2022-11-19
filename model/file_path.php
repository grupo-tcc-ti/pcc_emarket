<?php
class File_Path
{
    private static $instance;
    public static function requireFolder($name)
    {
        foreach (glob($name . '/*.php') as $filename) {
            require_once $filename;
            // echo $filename . '<br>'; //debug
        }
    }
    public static function admin_header()
    {
        return '../admin/admin_header.php';
    }
    public static function user_header()
    {
        return '../view/user_header.php';
    }
    public static function head()
    {
        return '../view/head.html';
    }
    public static function conta()
    {
        return '../view/conta.php';
    }

}
?>