<?php
class Path_Locale
{
    private static $instance;
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