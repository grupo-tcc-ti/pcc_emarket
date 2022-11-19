<?php
require_once './model/connect.php';
?>
<!DOCTYPE html>
<html lang="pt, en">

<head>
    <!-- <meta charset="UTF-8"> -->
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <?php require_once __DIR__ . Path_Locale::head(); ?>
    <link rel="shortcut icon" href="./image/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <title>Redirecting...</title>
</head>

<body>
    <?php
    Message::pop('Redirecting...');
    Redirect::page('./view/home.php', 2);
    ?>
</body>

</html>