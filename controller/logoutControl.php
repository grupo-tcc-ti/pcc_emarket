<?php
// session_unset();
// session_destroy();
Message::pop('Até a próxima!');
if (isset($_GET['adminlogout'])) { //admin/admin_header-54, exclusivo*
    unset($_SESSION['admin_id']);
    Redirect::page('admin_login.php', 2);
}
if (isset($_GET['logout'])) { //view/user_header-67 e afins
    unset($_SESSION['client_id']);
    unset($_SESSION['last_visited']);
    // Redirect::page('home.php', 2);
    Redirect::page(Redirect::directory($_SERVER['PHP_SELF']), 2);
}
?>