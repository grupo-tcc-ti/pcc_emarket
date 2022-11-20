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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
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