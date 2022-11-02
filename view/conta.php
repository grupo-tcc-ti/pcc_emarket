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
    <!-- <meta charset="UTF-8"> -->
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <!-- <link rel="stylesheet" href="../css/login_style.css"> -->
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <!-- <script src="https://kit.fontawesome.com/5e9d92adc0.js" crossorigin="anonymous"></script> -->
    <?php require_once 'head.html'; ?>
    <link rel="stylesheet" href="../css/login.css" />
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
require_once '../controller/registerControl.php';
require_once Path_Locale::user_header();

?>
  <div class="conta">
    <div class="container">
        <div class="forms">
          <div class="form login">
            <span class="title">Login</span>
            <!-- Login Form Sender -->
            <form action="#" method="post">
              <input type="hidden" name="usertype" value="cliente">
              <div class="input-field">
                <input type="text" placeholder="Insira seu email" name="email" required value="usuario@email.com"/>
                <!-- pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" -->
                <i class="far fa-envelope icon"></i>
              </div>
              <div class="input-field">
                <!-- <input type="password" class="loginPwd" placeholder="Insira sua senha" name="" required/> -->
                <input type="password" class="password" placeholder="Insira sua senha" name="senha" required value="1234"/>
                <!--pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" -->
                <i class="fas fa-lock icon"></i>
                <i class="far fa-eye-slash togglePwd"></i>
                <!-- <i class="far fa-eye togglePwd"></i> -->
              </div>
              <div class="checkbox-text">
                <div class="checkbox-content">
                  <input type="checkbox" name="" id="keepLoggedIn">
                  <label for="keepLoggedIn" class="text">Permanecer conectado</label>
                </div>
                <a href="#" class="text">Esqueceu a senha?</a>
              </div >
              <div class="input-field button">
                <input type="submit" value="Logar" name="login">
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
            <input type="hidden" name="usertype" value="cliente">
              <div class="input-field">
                <input type="text" placeholder="Insira seu nome" name="usuario" required/>
                <i class="fa-regular fa-user icon"></i>
              </div>
              <div class="input-field">
                <input type="text" placeholder="Insira seu email" name="email" required/>
                <i class="far fa-envelope icon"></i>
              </div>
              <div class="input-field">
                <!-- <input type="password" class="registerPwd" placeholder="Insira sua senha" name="" required/> -->
                <input type="password" class="password" placeholder="Crie uma senha" name="senha" required/>
                <i class="fas fa-lock icon"></i>
                <i class="far fa-eye-slash togglePwd"></i>
              </div>
              <div class="input-field">
                <!-- <input type="password" class="cRegisterPwd" placeholder="Confirme sua senha" name="" required/> -->
                <input type="password" class="password" placeholder="Confirme a senha" name="rsenha" required/>
                <i class="fas fa-lock icon"></i>
                <i class="far fa-eye-slash togglePwd"></i>
              </div>
              <div class="input-field button">
                <input type="submit" value="Registrar" name="register">
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

  <div id="footer">
    <?php
        require_once "footer.php";
    ?>
  </div>


  <!-- <script src="../js/login_script.js"></script> -->
  <script src="../js/script.js"></script>

</body>
</html>
