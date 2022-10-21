<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login_style.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/5e9d92adc0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"> </script>
    <title>Login</title>
</head>

<body>
  
<div id="header">
  <?php
    include "header.php";
  ?>
</div>

  <div class="login-page">
    <div class="form">
      <form action="../controller/loginControl.php" method="POST" class="login-form" id="L">
        <input type="text" placeholder="email" name="email" id="email" class="email"/>
        <input type="password" placeholder="senha" name="senha" id="senha" class="senha"/>
        <button>login</button>
        <p class="message">Não possuí registro? <a href="#">Registrar-se</a></p>
      </form>
  
      <form action="../controller/registerControl.php" method="POST" class="register-form" id="R">
        <input type="text" placeholder="nome" name="nome" id="nome" class="nome"/>
        <input type="password" placeholder="senha" name="senha" id="senha" class="senha"/>
        <input type="text" placeholder="email" name="email" id="email" class="email"/>
        <button type="submit">Registrar</button>
        <p class="message">Já possuí um registro? <a href="#">Logar-se</a></p>
      </form>
    </div>
  </div>

  <div id="footer">
    <?php
        include "footer.php";
    ?>
  </div>

  <script>
    $('.message a').click(function(){
    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
   });
  </script>
  <script src="../js/script.js"></script>

</body>
</html>