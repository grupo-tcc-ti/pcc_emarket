<?php
// session_unset();
// session_destroy();
Message::pop('Até a próxima!');
if(isset($_GET['adminlogout'])) {
    unset($_SESSION['admin_id']);
    Redirect::page('admin_login.php', 2);
}
if(isset($_GET['logout'])) {
    if (isset($_SESSION['client_id'])) {
        unset($_SESSION['client_id']);
    }

    if (isset($_SESSION['admin_id'])) {
        unset($_SESSION['admin_id']);
    }
    // Redirect::page('home.php', 2);
    Redirect::page(Redirect::directory($_SERVER['PHP_SELF']), 2);
}
?>
