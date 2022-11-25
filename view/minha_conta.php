<?php
session_start();
require_once '../model/connect.php';
// require_once '../model/dao/UsuariosDAO.php';
// require_once '../model/dto/UsuariosDTO.php';
//undo requirefolder if fails!
File_Path::requireFolder('../model/dao');
File_Path::requireFolder('../model/dto');

if (!isset($_SESSION['client_id'])) {
  // $client_header = File_Path::conta();
  // header('location:../view/' . $client_header);
  header('location: conta.php');
}
$usuario = UsuariosDAO::getUserByID(
  $_SESSION['client_id']['type'], $_SESSION['client_id']['id']
);
require_once '../controller/updateUserControl.php';
?>

<!DOCTYPE html>
<html lang="pt-br, en">

<head>
  <!-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/5e9d92adc0.js" crossorigin="anonymous"></script> -->
  <!-- <link rel="stylesheet" href="../css/myacc_style.css"> -->
  <link rel="stylesheet" href="../css/minhaconta.css" />
  <?php require_once File_Path::head(); ?>
  <title>Minha Conta</title>
</head>

<body>
  <?php require_once 'user_header.php'; ?>
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
                <input type="password" name="senha_atual" class="input-field" value="<?php echo $usuario['senha'] ?>" />
              </div>
              <div class="row">
                <label class="input-label" for="senha_nova">Nova Senha</label>
              </div>
              <div class="row">
                <input type="password" name="senha_nova" class="input-field" />
              </div>
              <div class="row">
                <label class="input-label" for="senha_confirma">Confime a Nova Senha</label>
              </div>
              <div class="row">
                <input type="password" name="senha_confirma" class="input-field" />
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

            <div class="row">
              <label class="input-label" for="cpf">CPF</label>

              <input type="text" name="cpf" class="input-field" value="<?php echo $usuario['cpf'] ?>" />
            </div>
            <div class="row">
              <label class="input-label" for="rg">RG</label>

              <input type="text" name="rg" class="input-field" value="<?php echo $usuario['rg'] ?>" />
            </div>

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

                <input type="text" name="bairro" class="input-field" value="<?php echo $usuario['endereco'] ?>" />
              </div>
              <div class="row">
                <label class="input-label" for="numero">Número</label>

                <input type="number" name="numero" class="input-field" value="<?php echo $usuario['numero'] ?>" />
              </div>

              <div class="row">
                <label class="input-label" for="cidade">Complemento</label>

                <input type="text" name="cidade" class="input-field" value="Sem Complemento" />
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