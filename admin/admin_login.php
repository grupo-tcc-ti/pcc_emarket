<?php
    include '../components/connect.php';
    require_once '../model/dto/adminDTO.php';
    require_once '../model/dao/adminDAO.php';
    session_start();

    $AdminDTO = new AdminDTO();

    if ( isset( $_SESSION["nomeAdmin"] ) && isset( $_SESSION["senhaAdmin"] ) ) {
        $mensagem[] = 'Sua sessão já foi iniciada!';
        $mensagem[] = 'Voce está sendo redirecionado....';

        $usuario = $_SESSION["nomeAdmin"];
        $senha   = $_SESSION['senhaAdmin'];

        $AdminDTO->setAdminNome( $_SESSION["nomeAdmin"] );
        $AdminDTO->setAdminSenha( $_SESSION["senhaAdmin"] );

        // var_dump( $_SESSION );
        // var_dump( $AdminDTO );

        $AdminDAO      = new AdminDAO();
        $usuarioLogado = $AdminDAO->login( $AdminDTO );

        if ( $usuarioLogado != null ) {
            $_SESSION['admin_id'] = $usuarioLogado->getAdminID();
            $hostname             = $_SERVER['HTTP_HOST'];
            $current_directory    = rtrim( dirname( $_SERVER['PHP_SELF'] ), '/' );
            $page                 = 'dashboard.php';

            header( 'refresh:1, url=http://' . $hostname . $current_directory . '/' . $page );
        } else {
            $mensagem[] = 'Nome de usuário ou senha incorreto!';
        }
    }

    if ( isset( $_POST['submit'] ) ) {

        $AdminDTO->setAdminNome( $_POST['usuario'] );
        $AdminDTO->setAdminSenha( sha1( $_POST['senha'] ) );

        // var_dump( $_SESSION );
        // var_dump( $AdminDTO );

        $AdminDAO      = new AdminDAO();
        $usuarioLogado = $AdminDAO->login( $AdminDTO );

        if ( $usuarioLogado != null ) {
            $_SESSION['admin_id'] = $usuarioLogado->getAdminID();
            $mensagem[]           = 'Bem Vindo';
            $hostname             = $_SERVER['HTTP_HOST'];
            $current_directory    = rtrim( dirname( $_SERVER['PHP_SELF'] ), '/' );
            $page                 = 'dashboard.php';

            if ( !isset( $_SESSION["nomeAdmin"] ) && !isset( $_SESSION["senhaAdmin"] ) ) {
                $_SESSION["nomeAdmin"]  = $AdminDTO->getAdminNome();
                $_SESSION["senhaAdmin"] = $AdminDTO->getAdminSenha();
            }

            header( 'refresh:1, url=http://' . $hostname . $current_directory . '/' . $page );
        } else {
            $mensagem[] = 'Nome de usuário ou senha incorreto!';
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-BR, en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_stylesheet.css">
    <title>Login do Administrador - Intranet</title>
</head>
<body>

<!-- <div class="mensagem">
<span>Sua sessão já foi iniciada!</span>
<i class="fas fa-times" onclick = "this.parentElement.remove();"></i>
</div> -->

<?php
    if ( isset( $mensagem ) ) {
        foreach ( $mensagem as $mensagem ) {
            echo '
        <div class="mensagem">
        <span>' . $mensagem . '</span>
        <i class="fas fa-times" onclick = "this.parentElement.remove();"></i>
        </div>
        ';
        }
    }
?>

<!-- Container do formulário de login do adminisrador -->

<section class="form-container">
    <form action="" method="post">
        <h3 class="heading">Credenciais de Login</h3>
        <p>Usuário de administrador predefinido: user = <span>admin</span> e senha <span>1234</span></p>
        <div class="flex">
        <div class="inputbox">
        <!-- <span class="title required-field">Usuario</span> -->
        <input type="text" name="usuario" class="box required-field" maxlength="20" required placeholder="Usuário*"
        oninput = "this.value = this.value.replace(/\s/g, '')" >
    </div>
        <div class="inputbox">
        <!-- <span class="title required-field">Senha</span> -->
        <input type="senha" name="senha" class="box required-field" maxlength="20" required placeholder="Senha*"
        oninput = "this.value = this.value.replace(/\s/g, '')" >
        </div>
        <input type="submit" value="Logar" class="btn" name="submit">
    </div>
    </form>
</section>

</body>
</html>