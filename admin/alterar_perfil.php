<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:../components/admin_header.php');
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $updt_username = $conn->prepare("UPDATE `admins` SET nome = ? WHERE codAdmin = ?");
    $updt_username->execute([$username, $admin_id]);

    $select_old_password = $conn->prepare("SELECT senha FROM `admins` WHERE codAdmin = ?");
    $select_old_password->execute([$admin_id]);
    $fetch_old_password = $select_old_password->fetch(PDO::FETCH_ASSOC);
    echo $prev_password = $fetch_old_password['senha'];
    $old_password = sha1($_POST['old_password']);
    $old_password = filter_var($old_password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    $new_password = sha1($_POST['new_password']);
    $new_password = filter_var($new_password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    $rnew_password = sha1($_POST['rnew_password']);
    $rnew_password = filter_var($rnew_password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    $empty_field = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    if (empty($old_password) ||
        $old_password == $empty_field) {
        $message[] = "Por favor insira a senha antiga!";
    }else if($old_password != $prev_password){
        $message[] = "A senha antiga está incorreta!";
    }else if($prev_password == $new_password){
        $message[] = "A senha antiga é a mesma da atual!";
    }else if($new_password != $rnew_password){
        $message[] = "As novas senhas não coincidem!";
    }else{
        if (empty($new_password) && empty($rnew_password) ||
        $new_password == $empty_field && $rnew_password == $empty_field){
            sleep(1);
            $message[] = 'Por favor insira uma nova senha!';
        } else {
            $alterar_senha = $conn->prepare("UPDATE `admins` SET senha = ? WHERE codAdmin = ?");
            $alterar_senha->execute([$rnew_password, $admin_id]);
            $message[] = 'A senha foi alterada com sucesso!';
            $message[] = 'Você será redirecionado ao dashboard!';
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <title>Alterar Perfil - Administrador</title>
</head>
<body>

<?php include '../components/admin_header.php';?>

<section class="form-container">
    <form action="" method="post">
        <h3>Alterar Perfil - Administrador</h3><br><br><br>
        <input type="text" name="username" class="inputbox" maxlength="20" placeholder="Usuário" required
        oninput = "this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile['nome']; ?>">
        <input type="password" name="old_password" class="inputbox" maxlength="20" placeholder="Digite a Senha Anterior" 
        oninput = "this.value = this.value.replace(/\s/g, '')" >
        <input type="password" name="new_password" class="inputbox" maxlength="20" placeholder="Digite a Nova Senha" 
        oninput = "this.value = this.value.replace(/\s/g, '')" >
        <input type="password" name="rnew_password" class="inputbox" maxlength="20" placeholder="Repita a sua Nova Senha" 
        oninput = "this.value = this.value.replace(/\s/g, '')" >
        <input type="submit" value="Alterar" class="btn" name="submit">
    </form>
</section>

<script src="../js/admin_script.js"></script>
</body>
</html>