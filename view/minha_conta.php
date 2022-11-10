<?php
  session_start();
  require_once '../model/connect.php';
  require_once '../model/dao/UsuariosDAO.php';
  require_once '../model/dto/UsuariosDTO.php';
  if (!isset($_SESSION['client_id']['id']) ) {
      $client_header = 'conta.php';
      header('location:../view/'.$client_header);
  } else {
      $user_id = $_SESSION['client_id'];
  }
  $usuario = UsuariosDAO::getUserByID(
      $_SESSION['client_id']['type'],
      $_SESSION['client_id']['id']
  );
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/5e9d92adc0.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="../css/myacc_style.css">
    <?php require_once Path_Locale::head(); ?>
    <title>Minha Conta</title>
</head>

<body>
<?php
require_once '../controller/updateUserControl.php';
require_once Path_Locale::user_header();
?>
</div>
  <div class="main-content">
    <div class="container mt-7">
      <!-- Table -->
      <div class="row">
        <div class="col-xl-8 m-auto order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
              </div>
              <div class="col-8">
                <h3 class="mb-0">Minha Conta</h3>
              </div>
            </div>
            <div class="card-body">
              <form action="" method="post">
                <h6 class="heading-small text-muted mb-4">Informações do usuáiro</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="usuario">Usuário</label>
                        <input type="text" id="input-nome" name="usuario" class="form-control form-control-alternative" value="<?php echo $usuario['nome']?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                      <label class="form-control-label" for="email">Email</label>
                        <input type="email" id="input-email" name="email" class="form-control form-control-alternative" value="<?php echo $usuario['email']?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="senha_atual">Senha Atual</label>
                        <input type="text" id="input-senha-atual" name="senha_atual" class="form-control form-control-alternative" placeholder="<?php echo $usuario['senha']?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="senha_nova">Nova Senha</label>
                        <input type="text" id="input-senha-nova" name="senha_nova" class="form-control form-control-alternative">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="senha_confirma">Confime a Nova Senha</label>
                        <input type="text" id="input-senha-confirma" name="senha_confirma" class="form-control form-control-alternative">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <input type="submit" class="submitButton" value="Salvar" name="submit" onclick="return confirm('Você realmente deseja alterar os dados da sua conta?');">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="container mt-7">
      <!-- Table -->
      <div class="row">
        <div class="col-xl-8 m-auto order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
              </div>
              <div class="col-8">
                <h3 class="mb-0">Meu Endereço</h3>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">Informação para Contato</h6>
    <div class="pl-lg-4">
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group focused">
            <label class="form-control-label" for="first_name">Nome</label>
            <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="Ex: Sam">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group focused">
            <label class="form-control-label" for="last_name">Sobrenome</label>
            <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Ex: Winchester">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group focused">
            <label class="form-control-label" for="address">Endereço</label>
            <input id="input-address" class="form-control form-control-alternative" placeholder="Ex: Taguatinga L. Norte QNL 10 Casa 32" type="text">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <div class="form-group focused">
            <label class="form-control-label" for="city">Cidade</label>
            <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="Ex: Brasília">
          </div>
        </div>

        <div class="col-lg-4">
          <div class="form-group focused">
            <label class="form-control-label" for="country">País</label>
            <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Ex: Brasil">
          </div>
        </div>

        <div class="col-lg-4">
          <div class="form-group">
            <label class="form-control-label" for="country">CEP</label>
            <input type="number" id="input-postal-code" class="form-control form-control-alternative" placeholder="Ex: 72200000">
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
</div>
</div>
</div>
</div>
</div>

  <div id="footer">
    <?php
        require "footer.php";
    ?>
  </div>

  <script src="../js/script.js"></script>
</body>
</html>
