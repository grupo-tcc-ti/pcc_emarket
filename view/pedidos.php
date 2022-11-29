<?php
session_start();
require_once '../model/connect.php';
//undo requirefolder if fails!
File_Path::requireFolder('../model/dao');
File_Path::requireFolder('../model/dto');
if (!isset($_SESSION['client_id'])) {
    header('location: conta.php');
}
$usuario = UsuariosDAO::getUserByID(
    $_SESSION['client_id']['type'], $_SESSION['client_id']['id']
);
(!isset($pageTitle)) ? $pageTitle = 'Emarket' : $pageTitle;
// require_once 'wishlist_card.php';
require_once '../controller/navigationControl.php'; // important!
?>

<!DOCTYPE html>
<html lang="pt, en">

<head>
    <?php require_once File_Path::head(); ?>
    <link rel="stylesheet" href="../css/home.css" />
    <link rel="stylesheet" href="../css/quickview.css" />
    <title>
        <?php echo $pageTitle; ?>
    </title>
</head>

<body>
    <div id="header">
        <?php require_once 'user_header.php'; ?>
    </div>



    <?php require_once Redirect::directory($_SERVER['PHP_SELF']) . '/footer.html'; ?>

    <script src="../js/swiper-bundle.min.js"></script>

    <script src="../js/script.js"></script>

</body>

</html>