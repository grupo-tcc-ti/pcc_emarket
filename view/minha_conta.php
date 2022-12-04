<?php
session_start();
require_once '../model/connect.php';
// require_once '../model/dao/UsuariosDAO.php';
// require_once '../model/dto/UsuariosDTO.php';
//undo requirefolder if fails!
File_Path::requireFolder('../model/dao');
File_Path::requireFolder('../model/dto');

if (!isset($_SESSION['client_id'])) {
  header('location: conta.php');
}
$usuario = UsuariosDAO::getUserByID(
  $_SESSION['client_id']['type'], $_SESSION['client_id']['id']
);
require_once '../controller/updateUserControl.php';
?>

<!DOCTYPE html>
<html lang="pt, en">

<head>
  <?php require_once File_Path::head(); ?>
  <link rel="stylesheet" href="../css/minhaconta.css" />
  <title>Minha Conta</title>
</head>

<body>
  <div id="header">
    <?php require_once 'user_header.php'; ?>
  </div>
  <div id="minha-conta">
    <section class="wrapper">
      <div class="account-header">
        <p class="">Minha Conta</p>
      </div>
      <div class="account-sections">
        <form action="" method="post">
          <input type="hidden" name="client_id" wfd-invisible="true" />
          <div class="section account-info">
            <div class="public-view">
              <input type="file" name="pfp" id="" />
              <img src="../image/pfps/pic-1.png" alt="" />
            </div>
            <div class="account-data">
              <div class="account-subtitle">
                <p class="">Informações da Conta</p>
              </div>
              <div class="row">
                <label class="input-label" for="usuario">Usuário</label>
              </div>
              <div class="row icon">
                <i class="fas fa-user"></i>
                <input type="text" name="usuario" class="input-field" value="<?php echo $usuario['nome'] ?>" />
              </div>
              <div class="row">
                <label class="input-label" for="email">Email</label>
              </div>
              <div class="row icon">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="input-field" value="<?php echo $usuario['email'] ?>" />
              </div>
              <div class="row">
                <label class="input-label" for="senha_atual">Senha Atual</label>
              </div>
              <div class="row icon">
                <i class="fas fa-lock"></i>
                <input type="password" name="senha_atual" class="input-field pwd" />
                <button type="button" class="toggleBtn">
                  <i class="far fa-eye-slash icontoggle"></i>
                </button>
              </div>
              <div class="row">
                <label class="input-label" for="senha_nova">Nova Senha</label>
              </div>
              <div class="row icon">
                <input type="password" name="senha_nova" class="input-field pwd"
                  placeholder="&#8226;&#8226;&#8226;&#8226;" />
                <button type="button" class="toggleBtn">
                  <i class="far fa-eye-slash icontoggle"></i>
                </button>
              </div>
              <div class="row">
                <label class="input-label" for="senha_confirma">Confime a Nova Senha</label>
              </div>
              <div class="row icon">
                <input type="password" name="senha_confirma" class="input-field pwd"
                  placeholder="&#8226;&#8226;&#8226;&#8226;" />
                <button type="button" class="toggleBtn">
                  <i class="far fa-eye-slash icontoggle"></i>
                </button>
              </div>
              <div class="row line">
                <hr class="" />
              </div>

              <div class="row">
                <input type="submit" class="submitButton" name="submit" value="Alterar Conta"
                  onclick="return confirm('Você realmente deseja alterar os dados da sua conta?');" />
              </div>
            </div>
          </div>
        </form>



        <form action="" method="post">
          <div class="section address-info">
            <input type="hidden" name="client_id" wfd-invisible="true" />
            <div class="account-subtitle">
              <p class="">Informações do Usuario</p>
            </div>
            <div class="row">
              <p class="account-subtitle t2">Dados Pessoais</p>
            </div>

            <div class="row">
              <label class="input-label" for="telefone">Telefone</label>

              <input type="number" name="telefone" class="input-field" value="<?php echo $usuario['telefone'] ?>" />
            </div>

            <!-- tipo pessoa starts -->
            <?php if (!empty($usuario['cnpj'])) {
              preg_match('/^([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{4})([0-9]{2})$/', $usuario['cnpj'], $value);
              $cnpj = $value[1] . '.' . $value[2] . '.' . $value[3] . '/' . $value[4] . '-' . $value[5];
            ?>
            <div class="row">
              <label class="input-label" for="cnpj">CNPJ</label>
              <input type="text" name="cpf" class="input-field" placeholder="<?php
              // echo ($usuario['cnpj']) 
              echo $cnpj;
              ?>" />
            </div>
            <?php } else {
              preg_match('/^([0-9]{3})([0-9]{3})([0-9]{3})([0-9]{2})$/', $usuario['cpf'], $value);
              $cpf = $value[1] . '.' . $value[2] . '.' . $value[3] . '-' . $value[4];
              preg_match('/^([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{1})$/', $usuario['rg'], $value);
              $rg = $value[1] . '.' . $value[2] . '.' . $value[3] . '-' . $value[4];
            ?>
            <div class="row">
              <label class="input-label" for="cpf">CPF</label>
              <input type="text" name="cpf" class="input-field" placeholder="<?php echo $cpf; ?>" />
            </div>
            <div class="row">
              <label class="input-label" for="rg">RG</label>
              <input type="text" name="rg" class="input-field" placeholder="<?php echo $rg; ?>" />
            </div>
            <?php } ?>
            <!-- tipo pessoa ends -->

            <div class="row line">
              <hr class="" />
            </div>

            <div class="user-info">
              <div class="row">
                <p class="account-subtitle t2">Meu Endereço</p>
              </div>
              <div class="row">
                <label class="input-label" for="cep">CEP</label>

                <input type="number" name="cep" class="input-field" value="<?php echo $usuario['cep'] ?>" />
              </div>
              <div class="row">
                <label class="input-label" for="estado">Estado</label>

                <select class="input-field" name="estado">
                  <?php
                  // foreach ($estados as $key => $val) {
                  foreach (ArrayList::$estados as $key => $val) {
                    if ($usuario['estado'] == $key) {
                      echo "<option value='$key' selected disabled>$val</option>";
                      continue;
                    }
                    echo "<option value='$key'>$val</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="row">
                <label class="input-label" for="cidade">Cidade</label>

                <input type="text" name="cidade" class="input-field" value="<?php echo $usuario['cidade'] ?>" />
              </div>

              <div class="row">
                <label class="input-label" for="bairro">Endereço</label>

                <input type="text" name="endereco" class="input-field" value="<?php echo $usuario['endereco'] ?>" />
              </div>
              <div class="row">
                <label class="input-label" for="numero">Número</label>

                <input type="number" name="numero" class="input-field" value="<?php echo $usuario['numero'] ?>" />
              </div>

              <div class="row">
                <label class="input-label" for="complemento">Complemento</label>

                <input type="text" name="complemento" class="input-field"
                  value="<?php echo $usuario['complemento'] ?>" />
              </div>

              <div class="row line">
                <hr class="" />
              </div>

              <div class="row">
                <input type="submit" class="submitButton" name="submit" value="Alterar Dados"
                  onclick="return confirm('Você realmente deseja alterar os dados da sua conta?');" />
              </div>
            </div>
          </div>
        </form>

      </div>
    </section>
  </div>

  <?php require_once Redirect::directory($_SERVER['PHP_SELF']) . '/footer.html'; ?>

  <script src="../js/script.js"></script>
</body>

</html>