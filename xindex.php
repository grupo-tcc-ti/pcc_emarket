<?php
    require_once './model/connect.php';
    // header("location:view/home.php");
?>
<!DOCTYPE html>
<html lang="pt-br, en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
</head>
<body>
    <?php
        Message::pop('Redirecting...');
        Redirect::page('./view/home.php', 1);
    ?>
</body>
</html>