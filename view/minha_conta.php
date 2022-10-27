<?php
    include '../model/connect.php';
    session_start();
    //var_dump( $_SESSION );

    $user_id = $_SESSION["loginID"];

    if ( !isset( $user_id ) ) {
        header( "location:../view/home.php" );
    }

    $getUsuarioDados = $conn->prepare( "SELECT * FROM usuarios WHERE codUsuario = ?" );
    $getUsuarioDados->execute( [$user_id] );
    $fetchUsuario = $getUsuarioDados->fetch( PDO::FETCH_ASSOC );
    $nomeAtual    = $fetchUsuario['nome'];
    $emailAtual   = $fetchUsuario['email'];
    $senhaAtual   = $fetchUsuario['senha'];

    if ( isset( $_POST['submit'] ) ) {
        $novoUsuario = $_POST['input-nome'];
        $novoEmail   = $_POST['input-email'];

        $senhaAtualDigitada = MD5( $_POST['input-senha-atual'] );
        $senhaNova          = MD5( $_POST['input-senha-nova'] );
        $senhaNovaConfirma  = MD5( $_POST['input-senha-confirma'] );

        // var_dump( $senhaAtual );
        // var_dump( $senhaAtualDigitada );

        // var_dump( $novoUsuario );
        // var_dump( $nomeAtual );

        $campo_vazio = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
        if ( empty( $senhaAtualDigitada ) || $senhaAtualDigitada == $campo_vazio ) {
            $message[] = "Por favor insira a sua senha atual!";
        } else if ( $senhaAtual != $senhaAtualDigitada ) {
            $message[] = "A senha atual está incorreta!";
        } else if ( $senhaAtualDigitada == $senhaNova ) {
            $message[] = "A senha atual é a mesma da nova!";
        } else if ( $senhaNova != $senhaNovaConfirma ) {
            $message[] = "As novas senhas não coincidem!";
        } else {
            if ( !empty( $novoUsuario ) && $novoUsuario != $nomeAtual ) {
                $alterarUsuario = $conn->prepare( "UPDATE usuarios SET nome = ? WHERE codUsuario = ?" );
                $alterarUsuario->execute( [$novoUsuario, $user_id] );
            }

            if ( !empty( $novoEmail ) && $novoEmail != $emailAtual ) {
                $alterarUsuario = $conn->prepare( "UPDATE usuarios SET email = ? WHERE codUsuario = ?" );
                $alterarUsuario->execute( [$novoEmail, $user_id] );
            }

            if ( !empty( $senhaNova ) && !empty( $senhaNovaConfirma ) && $senhaNova != $campo_vazio ) {
                $alterar_senha = $conn->prepare( "UPDATE usuarios SET senha = ? WHERE codUsuario = ?" );
                $alterar_senha->execute( [$senhaNova, $user_id] );
            } else {
                if ( !empty( $senhaNova ) && !empty( $senhaNovaConfirma ) && $senhaNova != $campo_vazio ) {
                    $message[] = 'Por favor insira uma nova senha!';
                }
            }

            $message[] = 'Seus dados foram alterados com sucesso!';

            Sleep( 2 );
            header( "Refresh:0" );
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../css/myacc_style.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/5e9d92adc0.js" crossorigin="anonymous"></script>
    <title>Minha Conta</title>
</head>

<body>
<div id="header">
  <?php
      include "header.php";
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
                        <label class="form-control-label" for="input-nome">Nome</label>
                        <?php if ( isset( $nomeAtual ) ) {?>
                        <input type="text" id="input-nome" name="input-nome" class="form-control form-control-alternative" value="<?=$nomeAtual?>">
                        <?php } else {?>
                        <input type="text" id="input-nome" name="input-nome" class="form-control form-control-alternative" value="">
                        <?php }?>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                      <label class="form-control-label" for="input-email">Email</label>
                      <?php if ( isset( $emailAtual ) ) {?>
                        <input type="email" id="input-email" name="input-email" class="form-control form-control-alternative" value="<?=$emailAtual?>">
                        <?php } else {?>
                          <input type="email" id="input-email"  name="input-email" class="form-control form-control-alternative" value="">
                        <?php }?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-senha-atual">Senha Atual</label>
                        <input type="text" id="input-senha-atual" name="input-senha-atual" class="form-control form-control-alternative">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-senha-nova">Nova Senha</label>
                        <input type="text" id="input-senha-nova" name="input-senha-nova" class="form-control form-control-alternative">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-senha-confirma">Confime a Nova Senha</label>
                        <input type="text" id="input-senha-confirma" name="input-senha-confirma" class="form-control form-control-alternative">
                      </div>
                    </div>
                  </div>
                </div>

                <hr class="my-4">
                <input type="submit" class="submitButton" value="Salvar" name="submit" onclick="return confirm('Você realmente deseja alterar os dados da sua conta?');">

                <?php
                    if ( isset( $message ) ) {
                        foreach ( $message as $message ) {
                            echo '
                    <div class="mensagem">
                    <span>' . $message . '</span>
                    </div>
                    ';
                        }
                    }
                ?>
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
            <label class="form-control-label" for="input-first-name">Nome</label>
            <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="Ex: Sam">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group focused">
            <label class="form-control-label" for="input-last-name">Sobrenome</label>
            <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Ex: Winchester">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group focused">
            <label class="form-control-label" for="input-address">Endereço</label>
            <input id="input-address" class="form-control form-control-alternative" placeholder="Ex: Taguatinga L. Norte QNL 10 Casa 32" type="text">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <div class="form-group focused">
            <label class="form-control-label" for="input-city">Cidade</label>
            <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="Ex: Brasília">
          </div>
        </div>

        <div class="col-lg-4">
          <div class="form-group focused">
            <label class="form-control-label" for="input-country">País</label>
            <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Ex: Brasil">
          </div>
        </div>

        <div class="col-lg-4">
          <div class="form-group">
            <label class="form-control-label" for="input-country">CEP</label>
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
        include "footer.php";
    ?>
  </div>

  <script src="../js/script.js"></script>
</body>
</html>