<?php
    session_start();
    require_once '../model/connect.php';
    require_once '../model/dao/UsuariosDAO.php';
    require_once '../model/dto/UsuariosDTO.php';
    if ( !isset( $_SESSION['client_id']['id'] ) ) {
        $client_header = Path_Locale::conta();
        header( 'location:../view/' . $client_header );
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
    <!-- <link rel="stylesheet" href="../css/myacc_style.css"> -->
    <link rel="stylesheet" href="../css/minhaconta.css">
    <?php require_once Path_Locale::head();?>
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
                        <input type="text" id="input-nome" name="usuario" class="form-control form-control-alternative" value="<?php echo $usuario['nome'] ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                      <label class="form-control-label" for="email">Email</label>
                        <input type="email" id="input-email" name="email" class="form-control form-control-alternative" value="<?php echo $usuario['email'] ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="senha_atual">Senha Atual</label>
                        <input type="text" id="input-senha-atual" name="senha_atual" class="form-control form-control-alternative">
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
                <input type="submit" class="submitButton" name="update_conta" value="Salvar" onclick="return confirm('Você realmente deseja alterar os dados da sua conta?');">
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
                <h3 class="mb-0">Informações do Usuario
                </h3>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">Meu Endereço</h6>
                <div class="pl-lg-4">
                  <div class="row">
                  <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="estado">Estado</label>
                      <select  class="form-control form-control-alternative" for="estado" id="estado" name="estado">
                        <option value="AC"                                           <?php if ( $usuario['estado'] == "AC" ) {
                                                   echo "selected";
                                           }
                                           ?>>Acre</option>
                        <option value="AL"                                           <?php if ( $usuario['estado'] == "AL" ) {
                                                   echo "selected";
                                           }
                                           ?>>Alagoas</option>
                        <option value="AP"                                           <?php if ( $usuario['estado'] == "AP" ) {
                                                   echo "selected";
                                           }
                                           ?>>Amapá</option>
                        <option value="AM"                                           <?php if ( $usuario['estado'] == "AM" ) {
                                                   echo "selected";
                                           }
                                           ?>>Amazonas</option>
                        <option value="BA"                                           <?php if ( $usuario['estado'] == "BA" ) {
                                                   echo "selected";
                                           }
                                           ?>>Bahia</option>
                        <option value="CE"                                           <?php if ( $usuario['estado'] == "CE" ) {
                                                   echo "selected";
                                           }
                                           ?>>Ceará</option>
                        <option value="DF"                                           <?php if ( $usuario['estado'] == "DF" ) {
                                                   echo "selected";
                                           }
                                           ?>>Distrito Federal</option>
                        <option value="ES"                                           <?php if ( $usuario['estado'] == "ES" ) {
                                                   echo "selected";
                                           }
                                           ?>>Espírito Santo</option>
                        <option value="GO"                                           <?php if ( $usuario['estado'] == "GO" ) {
                                                   echo "selected";
                                           }
                                           ?>>Goiás</option>
                        <option value="MA"                                           <?php if ( $usuario['estado'] == "MA" ) {
                                                   echo "selected";
                                           }
                                           ?>>Maranhão</option>
                        <option value="MT"                                           <?php if ( $usuario['estado'] == "MT" ) {
                                                   echo "selected";
                                           }
                                           ?>>Mato Grosso</option>
                        <option value="MS"                                           <?php if ( $usuario['estado'] == "MS" ) {
                                                   echo "selected";
                                           }
                                           ?>>Mato Grosso do Sul</option>
                        <option value="MG"                                           <?php if ( $usuario['estado'] == "MG" ) {
                                                   echo "selected";
                                           }
                                           ?>>Minas Gerais</option>
                        <option value="PA"                                           <?php if ( $usuario['estado'] == "PA" ) {
                                                   echo "selected";
                                           }
                                           ?>>Pará</option>
                        <option value="PB"                                           <?php if ( $usuario['estado'] == "PB" ) {
                                                   echo "selected";
                                           }
                                           ?>>Paraíba</option>
                        <option value="PR"                                           <?php if ( $usuario['estado'] == "PR" ) {
                                                   echo "selected";
                                           }
                                           ?>>Paraná</option>
                        <option value="PE"                                           <?php if ( $usuario['estado'] == "PE" ) {
                                                   echo "selected";
                                           }
                                           ?>>Pernambuco</option>
                        <option value="PI"                                           <?php if ( $usuario['estado'] == "PI" ) {
                                                   echo "selected";
                                           }
                                           ?>>Piauí</option>
                        <option value="RJ"                                           <?php if ( $usuario['estado'] == "RJ" ) {
                                                   echo "selected";
                                           }
                                           ?>>Rio de Janeiro</option>
                        <option value="RN"                                           <?php if ( $usuario['estado'] == "RN" ) {
                                                   echo "selected";
                                           }
                                           ?>>Rio Grande do Norte</option>
                        <option value="RS"                                           <?php if ( $usuario['estado'] == "RS" ) {
                                                   echo "selected";
                                           }
                                           ?>>Rio Grande do Sul</option>
                        <option value="RO"                                           <?php if ( $usuario['estado'] == "RO" ) {
                                                   echo "selected";
                                           }
                                           ?>>Rondônia</option>
                        <option value="RR"                                           <?php if ( $usuario['estado'] == "RR" ) {
                                                   echo "selected";
                                           }
                                           ?>>Roraima</option>
                        <option value="SC"                                           <?php if ( $usuario['estado'] == "SC" ) {
                                                   echo "selected";
                                           }
                                           ?>>Santa Catarina</option>
                        <option value="SP"                                           <?php if ( $usuario['estado'] == "SP" ) {
                                                   echo "selected";
                                           }
                                           ?>>São Paulo</option>
                        <option value="SE"                                           <?php if ( $usuario['estado'] == "SE" ) {
                                                   echo "selected";
                                           }
                                           ?>>Sergipe</option>
                        <option value="TO"                                           <?php if ( $usuario['estado'] == "TO" ) {
                                                   echo "selected";
                                           }
                                           ?>>Tocantins</option>
                        <option value="EX"                                           <?php if ( $usuario['estado'] == "EX" ) {
                                                   echo "selected";
                                           }
                                           ?>>Estrangeiro</option>
                      </select>
                      </div>
                  </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="cidade">Cidade</label>
                        <input type="text" id="input-cidade" name="cidade" class="form-control form-control-alternative" value="<?php echo $usuario['cidade'] ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                      <label class="form-control-label" for="bairro">Bairro</label>
                        <input type="text" id="input-bairro" name="bairro" class="form-control form-control-alternative" value="<?php echo $usuario['logradouro'] ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                      <label class="form-control-label" for="numero">Numero</label>
                        <input type="number" id="input-numero" name="numero" class="form-control form-control-alternative" value="<?php echo $usuario['numero'] ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                      <label class="form-control-label" for="cep">CEP</label>
                        <input type="number" id="input-cep" name="cep" class="form-control form-control-alternative" value="<?php echo $usuario['cep'] ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                      <label class="form-control-label" for="telefone">Telefone</label>
                        <input type="number" id="input-telefone" name="telefone" class="form-control form-control-alternative" value="<?php echo $usuario['telefone'] ?>">
                      </div>
                    </div>
                  </div>
                  <hr class="my-4">
                  <h6 class="heading-small text-muted mb-4">Dados Pessoais</h6>
                  <div class="row">
                  <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="CPF">CPF</label>
                        <input type="text" id="input-CPF" name="CPF" class="form-control form-control-alternative" value="<?php echo $usuario['cpf'] ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="RG">RG</label>
                        <input type="text" id="input-RG" name="RG" class="form-control form-control-alternative" value="<?php echo $usuario['rg'] ?>">
                      </div>
                    </div>
                  </div>

                  <hr class="my-4">
                <input type="submit" class="submitButton" name="update_addr" value="Salvar" onclick="return confirm('Você realmente deseja alterar os dados da sua conta?');">
                </div>
               </div>
            </form>
           </div>
        </div>
      </div>
  </div>
</div>

    <?php require_once '../view/footer.html';?>

  <script src="../js/script.js"></script>
</body>
</html>
