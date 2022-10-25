<?php
    session_start();
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
              <form>
                <h6 class="heading-small text-muted mb-4">Informações do usuáiro</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Nome</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Ex: Sam Winchester">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email</label>
                        <input type="email" id="input-email" class="form-control form-control-alternative" placeholder="Ex: Sam@example.com">
                      </div>
                    </div>
                  </div>
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
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Informação para Contato</h6>
                <div class="pl-lg-4">
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
                <hr class="my-4">
              </form>
            </div>
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