<?php
session_start();
require_once '../model/connect.php';
(isset($_SESSION['client_id']))?
$user_id = $_SESSION['client_id']
:'';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login_style.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/5e9d92adc0.js" crossorigin="anonymous"></script>
    <title>Login</title>

    <script>
    function required(inputtx)
    {
      if (inputtx.value.length == 0)
      {
        alert("message");
        return false;
      }
      return true;
    }
    </script>
</head>

<body>

<?php
if (isset($user_id)) {
    Message::pop('Sua sessão já foi iniciada!');
    Message::pop('Voce está sendo redirecionado....');
    Redirect::page('home.php', 2);
}
require_once '../controller/loginControl.php';
require_once "header.php";
?>
  <div class="login-page">
    <div class="form">
      <!-- <form action="../controller/loginControl.php" method="POST" class="login-form" id="L"> -->
      <form method="POST" class="login-form" id="L">
        <!-- <input type="text" placeholder="email" name="email" id="email" class="email" onsubmit="required()"/> -->
        <input type="text" placeholder="email" name="email" id="email" class="email" required/>
        <!-- <input type="password" placeholder="senha" name="senha" id="senha" class="senha" onsubmit="required()"/> -->
        <input type="password" placeholder="senha" name="senha" id="senha" class="senha" required value="1234"/> <!-- Tirar value 1234 -->
        <input type="submit" class="submitButton" value="Login" name="submit">
        <p class="message"><a href="register_page.php">Recuperar senha</a></p>
        <p class="message">Não possuí registro? <a href="register_page.php">Registrar-se</a></p>
      </form>
    </div>
  </div>

  <div id="footer">
    <?php
        require_once "footer.php";
    ?>
  </div>


  <script src="../js/script.js"></script>

</body>
</html>
