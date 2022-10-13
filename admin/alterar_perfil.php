<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    $admin_header = 'admin_header.php';
    header('location:../components/'.$admin_header);
}

if (isset($_POST['submit'])) {
    $usuario = $_POST['usuario'];
    $usuario = filter_var($usuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $alterar_usuario = $conn->prepare("UPDATE `admins` SET nome = ? WHERE codAdmin = ?");
    $alterar_usuario->execute([$usuario, $admin_id]);

    $select_senha_antiga = $conn->prepare("SELECT senha FROM `admins` WHERE codAdmin = ?");
    $select_senha_antiga->execute([$admin_id]);
    $fetch_senha_antiga = $select_senha_antiga->fetch(PDO::FETCH_ASSOC);
    $senha_anterior = $fetch_senha_antiga['senha']; //debug echo
    
    $senha_antiga = sha1($_POST['senha_antiga']); //input do usuario com a senha antiga
    $senha_antiga = filter_var($senha_antiga, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    $nova_senha = sha1($_POST['nova_senha']);
    $nova_senha = filter_var($nova_senha, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    $rnova_senha = sha1($_POST['rnova_senha']);
    $rnova_senha = filter_var($rnova_senha, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    $campo_vazio = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    if (empty($senha_antiga) ||
        $senha_antiga == $campo_vazio) {
        $mensagem[] = "Por favor insira a senha antiga!";
    }else if($senha_antiga != $senha_anterior){
        $mensagem[] = "A senha antiga está incorreta!";
    }else if($senha_anterior == $nova_senha){
        $mensagem[] = "A senha antiga é a mesma da atual!";
    }else if($nova_senha != $rnova_senha){
        $mensagem[] = "As novas senhas não coincidem!";
    }else{
        if (empty($nova_senha) && empty($rnova_senha) ||
        $nova_senha == $campo_vazio && $rnova_senha == $campo_vazio){
            sleep(1);
            $mensagem[] = 'Por favor insira uma nova senha!';
        } else {
            $alterar_senha = $conn->prepare("UPDATE `admins` SET senha = ? WHERE codAdmin = ?");
            $alterar_senha->execute([$rnova_senha, $admin_id]);
            $mensagem[] = 'A senha foi alterada com sucesso!';
            $mensagem[] = 'Você será redirecionado ao dashboard!';
            sleep(1);
            header('location:../admin/dashboard.php');
            exit(); 
        }
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
    <title>Alterar Perfil - Administrador</title>
</head>
<body>

<?php include '../components/admin_header.php';?>

<section class="form-container">
    <form action="" method="post">
        <h3 class="heading">Alterar Perfil - Administrador</h3><br><br><br>
        <div class="flex">
            <div class="inputbox">
            <span class="title required-field">Usuario</span>
            <!-- <input type="text" name="usuario" class="inputbox" maxlength="20" placeholder="Usuário" required -->
            <input type="text" name="usuario" class="box" maxlength="20" placeholder="Usuário" required
            oninput = "this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_perfil['nome']; ?>">
            </div>
            <div class="inputbox">
            <span class="title required-field">Senha Anterior</span>
            <!-- <input type="password" name="senha_antiga" class="inputbox" maxlength="20" placeholder="Digite a Senha Anterior"  -->
            <input type="password" name="senha_antiga" class="box" maxlength="20" placeholder="Digite a Senha Anterior"
            oninput = "this.value = this.value.replace(/\s/g, '')" >
            </div>
            <div class="inputbox">
            <span class="title required-field">Nova Senha</span>
            <!-- <input type="password" name="nova_senha" class="inputbox" maxlength="20" placeholder="Digite a Nova Senha"  -->
            <input type="password" name="nova_senha" class="box" maxlength="20" placeholder="Digite a Nova Senha"
            oninput = "this.value = this.value.replace(/\s/g, '')" >
            </div>
            <div class="inputbox">
            <span class="title required-field">Repita a Nova Senha</span>
            <!-- <input type="password" name="rnova_senha" class="inputbox" maxlength="20" placeholder="Repita a sua Nova Senha"  -->
            <input type="password" name="rnova_senha" class="box" maxlength="20" placeholder="Repita a sua Nova Senha"
            oninput = "this.value = this.value.replace(/\s/g, '')" >
            </div>
            <input type="submit" value="Alterar" class="btn" name="submit">
        </div>
    </form>
</section>

<script src="../js/admin_script.js"></script>
</body>
</html>