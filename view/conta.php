<?php
session_start();
require_once '../model/connect.php';
if (isset($_SESSION['client_id'])) {
  Message::pop('Sua sessão já foi iniciada!');
  Message::pop('Voce está sendo redirecionado....');
  Redirect::page('minha_conta.php', 2);
}
require_once '../controller/loginControl.php';
require_once '../controller/registerControl.php';
?>

<!DOCTYPE html>
<html lang="pt, en">

<head>
  <!-- <meta charset="UTF-8"> -->
  <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <!-- <link rel="stylesheet" href="../css/login_style.css"> -->
  <!-- <link rel="stylesheet" href="../css/style.css"> -->
  <!-- <script src="https://kit.fontawesome.com/5e9d92adc0.js" crossorigin="anonymous"></script> -->
  <?php require_once File_Path::head(); ?>
  <link rel="stylesheet" href="../css/conta.css" />
  <title>Login</title>
  <script>
    function required(inputtx) {
      if (inputtx.value.length == 0) {
        alert('message');
        return false;
      }
      return true;
    }
  </script>
</head>

<body>
  <div id="header">
    <?php require_once 'user_header.php'; ?>
  </div>
  <div class="login-register">
    <div class="container">
      <div class="forms">
        <div class="form login">
          <span class="title">Login</span>
          <!-- Login Form Sender -->
          <form action="#" method="post">
            <input type="hidden" name="usertype" value="cliente" />
            <div class="row">
              <input type="text" placeholder="Insira seu email" name="email" required value="usuario@email.com" />
              <!-- pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" -->
              <div class="icon"><i class="far fa-envelope"></i></div>
            </div>
            <div class="row">
              <!-- <input type="password" class="loginPwd" placeholder="Insira sua senha" name="" required/> -->
              <input type="password" class="input-field pwd" placeholder="Insira sua senha" name="senha" required
                value="1234" />
              <!--pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" -->
              <div class="icon"><i class="fas fa-lock"></i></div>
              <div class="toggleBtn">
                <div class="icon"><i class="far fa-eye-slash icontoggle"></i></div>
              </div>
            </div>
            <div class="checkbox-text">
              <div class="checkbox-content">
                <input type="checkbox" name="" id="keepLoggedIn" />
                <label for="keepLoggedIn" class="text">Permanecer conectado</label>
              </div>
              <a href="#" class="text">Esqueceu a senha?</a>
            </div>
            <div class="row button">
              <input type="submit" value="Logar" name="login" />
            </div>
          </form>
          <!-- Register Form Sender -->
          <div class="login-signup">
            <span class="text">Não é cadastrado? </span>
            <a href="#" class="text signup-link">Faça uma conta!</a>
          </div>
        </div>
        <div class="form signup">
          <span class="title">Crie sua Conta</span>
          <form action="#" method="post">
            <input type="hidden" name="usertype" value="cliente" />
            <div class="row">
              <input type="text" placeholder="Insira seu nome" name="nome" required />
              <div class="icon"><i class="fa-regular fa-user icon"></i></div>
            </div>
            <div class="row">
              <input type="text" placeholder="Insira seu email" name="email" required />
              <div class="icon"><i class="far fa-envelope icon"></i></div>
            </div>
            <div class="row">
              <!-- <input type="password" class="registerPwd" placeholder="Insira sua senha" name="" required/> -->
              <input type="password" class="input-field pwd" placeholder="Crie uma senha" name="senha" required />
              <div class="icon"><i class="fas fa-lock icon"></i></div>
              <button type="button" class="toggleBtn">
                <div class="icon"><i class="far fa-eye-slash icontoggle"></i></div>
              </button>
            </div>
            <div class="row">
              <!-- <input type="password" class="cRegisterPwd" placeholder="Confirme sua senha" name="" required/> -->
              <input type="password" class="input-field pwd" placeholder="Confirme a senha" name="rsenha" required />
              <div class="icon"><i class="fas fa-lock icon"></i></div>
              <button type="button" class="toggleBtn">
                <div class="icon"><i class="far fa-eye-slash icontoggle"></i></div>
              </button>
            </div>
            <div class="row button">
              <input type="submit" value="Registrar" name="register" />
            </div>
          </form>
          <div class="login-signup">
            <span class="text">Já possui conta? </span>
            <a href="#" class="text login-link">Faça login!</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once Redirect::directory($_SERVER['PHP_SELF']) . '/footer.html'; ?>
  <script src="../js/script.js"></script>
</body>

</html>