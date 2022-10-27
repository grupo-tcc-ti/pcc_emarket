<?php
// require_once __DIR__ . '/../connect.php';
// include __DIR__ . '/../connect.php';
// include '../connect.php';

// require_once __DIR__ . '/../dto/UsuarioDTO.php';
// include __DIR__ . '/../dto/PedidosDTO.php';
if (!isset($pdo)){
    include '../model/connect.php'; //Caso a pagina ja possua um connect não precisa desse
}
class UsuariosDAO {
    protected static $inst;
    public static function QtyUsuarios($tipo = 'cliente') {
        try{
            $pdo = Connect::getInstance();
            if ($tipo == 'cliente') {$qry = ("SELECT * FROM `usuarios` WHERE codAdmin = 0 AND codCliente > 0");}
            else if ($tipo == 'admin') {$qry = ("SELECT * FROM `usuarios` WHERE codAdmin > 0 AND codCliente = 0");}
            $select_ = $pdo->prepare($qry);
            $select_->execute();
            return $select_->rowCount();
        }
        catch (PDOException $msg) {
            $message[] = $msg->getMessage();
            die();
        }
    }
    ###################################################################################################################
    public static function Cadastrar_Usuario($usuario, $email, $password, $rpassword, $usertype) {
        try {
            $pdo = Connect::getInstance();
            // $usuario = $_POST['usuario'];
            $usuario = filter_var($usuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $password = md5($_POST['password']);
            $password = filter_var(md5($password), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $rpassword = md5($_POST['rpassword']);
            $rpassword = filter_var(md5($rpassword), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $usertype = filter_var($usertype, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // $qry = "SELECT * FROM `usuarios` WHERE nome = ?";
            $qry = "SELECT * FROM `usuarios` WHERE nome = :nome";
            $select_ = $pdo->prepare($qry);
            $select_->bindParam(':nome', $usuario);
            // $select_->execute([$usuario]);
            $select_->execute();
            if ($select_->rowCount() > 0){
                $mensagem[] = 'Conta já existe!';
            } else if ($password != $rpassword) {
                $mensagem[] = 'Nome de usuário ou senha incorreto!';
            }
            else {
                // $insert_ = $pdo->prepare("INSERT INTO `usuarios` (nome, senha) VALUES (?, ?)");
                // "INSERT INTO `usuarios` (nome, senha)
                $qry_insert = '';
                if ($usertype == 'admin') {
                    $qry_insert = 
                        "INSERT INTO `usuarios` (`nome`, `email`, `senha`, `user_type`, `codCliente`, `codAdmin`)
                        VALUES (:usuario, :email, :rpassword, :usertype, 0, FLOOR(5 + RAND()*(100-1)))"
                        ;
                } else if ($usertype == 'cliente') {
                    $qry_insert = 
                        "INSERT INTO `usuarios` (`nome`, `email`, `senha`, `user_type`, `codCliente`, `codAdmin`)
                        VALUES (:usuario, :email, :rpassword, :usertype, FLOOR(5 + RAND()*(100-1)), 0)"
                        ;
                }
                $insert_ = $pdo->prepare($qry_insert);
                $insert_->bindParam(':usuario', $usuario);
                $insert_->bindParam(':email', $email);
                $insert_->bindParam(':rpassword', $rpassword);
                $insert_->bindValue(':usertype', $usertype);
                // $insert_->execute([$usuario, $rpassword]);
                $mensagem[] = 'Cadastro de Administrador realizado com Sucesso!';
                Redirect::page('admin_contas.php', 0);
                return $insert_->execute();
            }
        } catch (PDOException $msg) {
            echo $msg->getMessage();
            die();
        }
    }
    ###################################################################################################################
    public static function Alterar_Usuario($admin_id, $usuario, $senha_antiga, $nova_senha, $rnova_senha) {
        try {
            $pdo = Connect::getInstance();
            // $usuario = $_POST['usuario'];
            $usuario = filter_var($usuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $admin_id = filter_var($admin_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $select_ = $pdo->prepare("SELECT senha FROM `usuarios` WHERE codAdmin = :codAdmin");
            $select_->bindParam(':codAdmin', $admin_id);
            $select_->execute();
            $fetch_ = $select_->fetch(PDO::FETCH_ASSOC);
            $senha_anterior = $fetch_['senha']; //debug echo
            
            // $senha_antiga = md5($_POST['senha_antiga']); //input do usuario com a senha antiga
            $senha_antiga = filter_var(md5($senha_antiga), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // $nova_senha = md5($_POST['nova_senha']);
            $nova_senha = filter_var(md5($nova_senha), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // $rnova_senha = md5($_POST['rnova_senha']);
            $rnova_senha = filter_var(md5($rnova_senha), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // $campo_vazio = 'da39a3ee5e6b4b0d3255bfef95601890afd80709'; //sha1 vazio
            $campo_vazio = 'd41d8cd98f00b204e9800998ecf8427e'; //md5 vazio
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
                    // sleep(1);
                    $mensagem[] = 'Por favor insira uma nova senha!';
                } else {
                    $alterar_ = $pdo->prepare(
                        "UPDATE `usuarios` SET nome = :nome, senha = :senha 
                        WHERE codAdmin = :codAdmin"
                        );
                    $alterar_->bindParam(':nome', $usuario);
                    $alterar_->bindParam(':senha', $rnova_senha);
                    $alterar_->bindParam(':codAdmin', $admin_id);
                    $alterar_->execute();
                    $mensagem[] = 'A senha foi alterada com sucesso!';
                    $mensagem[] = 'Você será redirecionado ao dashboard!';
                    // sleep(1);
                    // header('location:../admin/dashboard.php');
                    Redirect::page('dashboard.php', 0);
                    exit(); 
                }
            }
        } catch (PDOException $msg) {
            echo $msg->getMessage();
        }
    }
    ###################################################################################################################
    public static function Deletar_Usuario($cod_admin) {
        try {
            $pdo = Connect::getInstance();
            // $cod_admin = $_GET['deletar'];
            $qry = "DELETE FROM `usuarios` WHERE codAdmin = :cod_admin";
            $deletar_admin = $pdo->prepare($qry) or die ("Não foi possivel achar a Conta Admin!");
            $deletar_admin->bindParam(':cod_admin', $cod_admin);
            $deletar_admin->execute();
            // header('location: admin_contas.php');
            Redirect::page('admin_contas.php',0);
        } catch (PDOException $msg) {
            echo $msg->getMessage();
        }
    }
}
?>