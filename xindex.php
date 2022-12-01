<?php
require_once './model/connect.php';
?>
<!DOCTYPE html>
<html lang="pt, en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./font/stylesheet.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="shortcut icon" href="./image/favicon.ico" type="./image/x-icon" />
    <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css" />
    <script src="./assets/fontawesome/js/all.min.js"></script>
    <script src="./assets/jquery/jquery-3.6.1.js"></script>

    <title>Redirecting...</title>
</head>

<body>
    <?php
    Message::pop('Redirecting...');
    Redirect::page('./view', 2);
    // Redirect::page('./techgrifo.com.br', 2);
    ?>
</body>

</html>