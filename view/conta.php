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
              <input type="text" placeholder="Insira seu nome" name="nome" pattern="[a-zA-Z0-9_]{6,255}" required
                value="gabs_teste" />
              <div class="icon"><i class="fa-regular fa-user icon"></i></div>
            </div>
            <div class="row">
              <input type="text" placeholder="Insira seu email" name="email"
                pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
              <div class="icon"><i class="far fa-envelope icon"></i></div>
            </div>
            <div class="row">
              <!-- <input type="password" class="registerPwd" placeholder="Insira sua senha" name="" required/> -->
              <input type="password" class="input-field pwd" placeholder="Crie uma senha" name="senha"
                pattern="[a-zA-Z0-9_]{4,16}" required/>
              <div class="icon"><i class="fas fa-lock icon"></i></div>
              <button type="button" class="toggleBtn">
                <div class="icon"><i class="far fa-eye-slash icontoggle"></i></div>
              </button>
            </div>
            <div class="row">
              <!-- <input type="password" class="cRegisterPwd" placeholder="Confirme sua senha" name="" required/> -->
              <input type="password" class="input-field pwd" placeholder="Confirme a senha" name="rsenha"
                pattern="[a-zA-Z0-9_]{4,16}" required/>
              <div class="icon"><i class="fas fa-lock icon"></i></div>
              <button type="button" class="toggleBtn">
                <div class="icon"><i class="far fa-eye-slash icontoggle"></i></div>
              </button>
            </div>


            <br />
            <div class="user-info">

              <div class="t1">
                <p class="">Informações Pessoais</p>
              </div>
              <br />
              <p class="t2">Dados Pessoais</p>

              <hr class="line" />

              <div class="row">
                <label class="input-label" for="telefone">Telefone</label>

                <input type="tel" name="telefone" class="input-field" placeholder="(61) 9 8765-4321"
                  value="(61)98765-4321" pattern="[(0-9)]{4}[9]{0,1}[0-9-]{8,10}$" required />
              </div>

              <select class="input-field" id="pessoa_tipo" name="pessoa">
                <option value="pf">Pessoa Física</option>
                <option value="pj">Pessoa Jurídica</option>
              </select>

              <div class="cred-pessoa">
                <div class="row">
                  <label class="input-label" for="cpf">CPF</label>
                  <input type="text" name="cpf" class="input-field" placeholder="123.456.789-10" value="123.456.789-10"
                    pattern="[0-9.]{9,11}[-][0-9]{1,2}" min="11" max="11" required />
                </div>
                <div class="row">
                  <label class="input-label" for="rg">RG</label>
                  <input type="text" name="rg" class="input-field" placeholder="12.345.678-9" value="12.345.678-9"
                    pattern="[0-9.]{8,10}[-][0-9]{1}" min="10" max="10" required />
                </div>
              </div>

            </div>
            <div class="address-info">
              <p class="t2">Endereço</p>

              <hr class="line" />

              <div class="row">
                <label class="input-label" for="cep">CEP</label>

                <input type="text" name="cep" class="input-field" placeholder="123456-789" value="123456-789"
                  pattern="[0-9]{6}[-][0-9]{2,3}" min="9" required />
              </div>

              <div class="row">
                <label class="input-label" for="estado">Estado</label>

                <select class="input-field" name="estado" required>
                  <?php
                  foreach (ArrayList::$estados as $key => $val) {
                    if ($key == 'DF') {
                      echo "<option value='$key' selected>$val</option>";
                      continue;
                    }
                    echo "<option value='$key'>$val</option>";
                  }
                  ?>
                </select>
              </div>

              <div class="row">
                <label class="input-label" for="cidade">Cidade</label>

                <input type="text" name="cidade" class="input-field" placeholder="Monte das Palmeiras"
                  value="Monte das Palmeiras" max="255" required />
              </div>

              <div class="row">
                <label class="input-label" for="bairro">Endereço</label>

                <input type="text" name="endereco" class="input-field" placeholder="Quadra 15 Lote 70"
                  value="Quadra 15 Lote 70" max="255" required />
              </div>

              <div class="row">
                <label class="input-label" for="numero">Número</label>

                <input type="number" name="numero" class="input-field" placeholder="2" value="2" min="1" ax="255"
                  required />
              </div>

              <div class="row">
                <label class="input-label" for="complemento">Complemento</label>

                <input type="text" name="complemento" class="input-field" placeholder="Sem Complemento"
                  value="Sem Complemento" required />
              </div>

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