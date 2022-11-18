<?php
/**
 * UsuarioDTO
 *
 * CRUD Usuario
 *
 * @category   Model
 * @package    PackageName
 * @subpackage Theme_Name_Here
 * @author     Your Name <yourname@example.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://yoursite.com
 * @since      1.0.0
 */
if (!isset($pdo)) {
    /**
     * Case page doesn't have connection to database
     */
    include_once __DIR__ . '/../connect.php';
}
class UsuariosDAO
{
    private static $pdo;
    private static function connect()
    {
        if (!isset(self::$pdo)) {
            self::$pdo = Connect::getInstance();
        }
        return self::$pdo;
    }
    /**
     * Quantificar Usuarios
     *
     * Fazer Contagem de usuários no sistema.
     *
     * @param string $tipo Inserir o tipo usuario 'admin', 'usuario' e 'cliente'
     *
     * @return void
     */
    public static function qtyUsuarios($tipo = 'cliente')
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            if ($tipo == 'cliente') {
                $qry = ("SELECT * FROM `usuarios` WHERE codAdmin = 0 AND codCliente > 0");
            } else if ($tipo == 'admin') {
                $qry = ("SELECT * FROM `usuarios` WHERE codAdmin > 0 AND codCliente = 0");
            }
            $select_ = self::connect()->prepare($qry);
            $select_->execute();
            echo $select_->rowCount();
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
    //
    public static function listarUsuarios()
    {
        try {
            // $con = Connect::getInstance(); //renameit case fails
            $qry = "SELECT * FROM `usuarios` ORDER BY nome";
            $select_ = self::connect()->prepare($qry);
            $select_->execute();
            $usuarios = $select_->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios;
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
        }

    }
    public static function listarUsuariosTipo($user = 'cliente')
    {
        try {
            // $con = Connect::getInstance(); //renameit case fails
            $qry = "SELECT * FROM `usuarios` WHERE user_type = :user ORDER BY nome";
            $select_ = self::connect()->prepare($qry);
            $select_->bindParam(':user', $user);
            $select_->execute();
            $usuarios = $select_->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios;
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
        }

    }
    //
    public static function getUserByID($type, $id)
    {
        try {
            // $con = Connect::getInstance(); //renameit case fails
            if ($type == 'admin') {
                $columnName = 'codAdmin';
                $parseColumn = 'codCliente';
            } else {
                $columnName = 'codCliente';
                $parseColumn = 'codAdmin';
            }
            $qry = "SELECT * from `usuarios` WHERE " . $columnName . " = :uid";
            $select_ = self::connect()->prepare($qry);
            $select_->bindParam(':uid', $id);
            $select_->execute();
            return $select_->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
        }
    }
    //
    public static function cadastrarUsuario(UsuariosDTO $usuarioDTO)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $usuario = filter_var($usuarioDTO->getNome(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_var($usuarioDTO->getEmail(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_var(md5($usuarioDTO->getSenha()[0]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $rpassword = filter_var(md5($usuarioDTO->getSenha()[1]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $usertype = filter_var($usuarioDTO->getUser_type(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $qry = "SELECT * FROM `usuarios` WHERE nome = :nome";
            $select_ = self::connect()->prepare($qry);
            $select_->bindParam(':nome', $usuario);
            $select_->execute();
            if ($select_->rowCount() > 0) {
                Message::pop('Conta já existe!');
            } else if ($password != $rpassword) {
                Message::pop('Nome de usuário ou senha incorreto!');
            } else {
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
                $insert_ = self::connect()->prepare($qry_insert);
                $insert_->bindParam(':usuario', $usuario);
                $insert_->bindParam(':email', $email);
                $insert_->bindParam(':rpassword', $rpassword);
                $insert_->bindValue(':usertype', $usertype);
                Message::pop('Cadastro realizado com Sucesso!');
                $insert_->execute();
            }
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
    //

    public static function alterarUsuario($usuarioDAO, UsuariosDTO $updateData)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            if (filter_var($usuarioDAO['user_type'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) == 'admin') {
                $columnName = 'codAdmin';
                $user_id = filter_var($usuarioDAO['codAdmin'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            } else if (filter_var($usuarioDAO['user_type'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) == 'cliente') {
                $columnName = 'codCliente';
                $user_id = filter_var($usuarioDAO['codCliente'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }


            $usuario = filter_var($updateData->getNome(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_var($updateData->getEmail(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($usuario != null) {
                $cred = $usuario;
                $qry = "UPDATE `usuarios` SET `nome` = :cred, `senha` = :senha WHERE $columnName = :uid";
            } else if ($usuario != null && $email != null) {
                $cred = $email;
                $qry = "UPDATE `usuarios` SET `email` = :cred, `senha` = :senha WHERE $columnName = :uid";
            } else {
                // $cred = $email;
                // $qry = "UPDATE `usuarios` SET `email` = :cred, `senha` = :senha WHERE $columnName = :uid";
                $cred = null;
                $qry = "UPDATE `usuarios` SET WHERE $columnName = :uid";
            }

            $select_ = self::connect()->prepare("SELECT * FROM `usuarios` WHERE $columnName = :uid");
            $select_->bindParam(':uid', $user_id);
            $select_->execute();
            $senha_anterior = $select_->fetch(PDO::FETCH_ASSOC)['senha'];

            $updateList = array(
                // ':nome' => filter_var($updateData->getNome(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                // ':email' => filter_var($updateData->getEmail(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                // ':senha' => filter_var($updateData->getSenha(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                ':salario' => filter_var($updateData->getSalario(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                ':admissao' => filter_var($updateData->getAdmissao(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                ':demissao' => filter_var($updateData->getDemissao(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                ':telefone' => filter_var($updateData->getTelefone(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                ':cpf' => filter_var($updateData->getCpf(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                ':rg' => filter_var($updateData->getRg(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                ':cnpj' => filter_var($updateData->getCnpj(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                ':ie' => filter_var($updateData->getIe(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                ':cep' => filter_var($updateData->getCep(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                ':estado' => filter_var($updateData->getEstado(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                ':cidade' => filter_var($updateData->getCidade(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                ':endereco' => filter_var($updateData->getEndereco(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                ':numero' => filter_var($updateData->getNumero(), FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                ':complemento' => filter_var($updateData->getComplemento(), FILTER_SANITIZE_FULL_SPECIAL_CHARS)
            );
            $undo_qry = $qry;
            $new_bind = [];
            foreach ($updateList as $key => $value) {
                $new_qry;
                $save_qry = $qry;
                $qry = substr($qry, 0, strpos($qry, "WHERE")) . trim($key, ':') . ' = ' . $key . ', ' . substr($qry, strpos($qry, "WHERE "));
                if (!empty($value)) {
                    $new_qry = $qry;
                    $new_bind[$key] = $value;
                } else {
                    $qry = $save_qry;
                }
                if (array_key_last($updateList) == $key) {
                    if (isset($new_qry)) {
                        if (!is_null($new_qry)) {
                            $qry = $new_qry;
                            $qry = substr($qry, 0, strrpos($qry, ", WHERE")) . ' ' . substr($qry, strpos($qry, "WHERE "));
                        }
                    } else {
                        $qry = $undo_qry;
                        if ($qry == "UPDATE `usuarios` SET WHERE $columnName = :uid") {
                            // die('Query not affected!');
                            return;
                        }
                    }
                }
            }

            $alterar_ = self::connect()->prepare($qry) or die('Não foi possivel fazer as alterações');
            (!is_null($cred)) ? $alterar_->bindParam(':cred', $cred) : '';
            $alterar_->bindParam(':uid', $user_id);
            foreach ($new_bind as $col => $val) {
                // echo var_dump($col).'<br>'; //debug
                // echo var_dump($val).'<br>'; //debug
                $alterar_->bindValue($col, $val);
            }

            if ($updateData->getSenha() != null) {
                $senha_atual = filter_var(md5($updateData->getSenha()['atual']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $nova_senha = filter_var(md5($updateData->getSenha()['nova']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $confirma_senha = filter_var(md5($updateData->getSenha()['confirma']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $alterar_->bindParam(':senha', $senha_anterior);
                // $campo_vazio = 'da39a3ee5e6b4b0d3255bfef95601890afd80709'; //sha1 vazio
                $campo_vazio = 'd41d8cd98f00b204e9800998ecf8427e'; //md5 vazio
                if (
                    empty($senha_atual)
                    || $senha_atual == $campo_vazio
                ) {
                    Message::pop("Por favor insira uma senha!");
                } else if ($senha_atual != $senha_anterior) {
                    Message::pop("A senha anterior está incorreta!");
                } else if ($nova_senha != $confirma_senha) {
                    Message::pop("As senhas não coincidem!");
                } else if ($senha_anterior == $nova_senha) {
                    Message::pop("A senha anterior é a mesma da atual!");
                } else {
                    if (
                        empty($nova_senha) && empty($rnova_senha)
                        || $nova_senha == $campo_vazio && $rnova_senha == $campo_vazio
                    ) {
                        Message::pop("Por favor insira uma nova senha!");
                    } else {
                        $alterar_->bindParam(':senha', $confirma_senha);
                    }
                }
            }

            return $alterar_->execute();
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
    //
    public static function deletarAdmin($cod_admin)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $qry = "DELETE FROM `usuarios` WHERE codAdmin = :cod_admin";
            $deletar_admin = self::connect()->prepare($qry) or die("Não foi possivel achar a Conta Admin!");
            $deletar_admin->bindParam(':cod_admin', $cod_admin);
            Message::pop('Deletado com sucesso!');
            $deletar_admin->execute();
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
    //
    public static function deletarCliente($cod_cliente)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $deletaruser_ = self::connect()->prepare("DELETE FROM `usuarios` WHERE codCliente = :cid")
                or die("Nenhum item relacionado a conta foi encontrado.");
            $deletaruser_->bindParam(':cid', $cod_cliente);
            $deletarpdd_ = self::connect()->prepare("DELETE FROM `pedidos` WHERE fk_usuarios_codCliente = :cid")
                or die("Nenhum item relacionado a conta foi encontrado.");
            $deletarpdd_->bindParam(':cid', $cod_cliente);
            $deletarcrt_ = self::connect()->prepare("DELETE FROM `carrinho` WHERE fk_usuarios_codCliente = :cid")
                or die("Nenhum item relacionado a conta foi encontrado.");
            $deletarcrt_->bindParam(':cid', $cod_cliente);
            Message::pop('Deletado com sucesso!');
            $deletaruser_->execute();
            $deletarpdd_->execute();
            $deletarcrt_->execute();
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
    public static function login(UsuariosDTO $usuariosDTO)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $usuario = filter_var($usuariosDTO->getNome(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_var($usuariosDTO->getEmail(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $senha = filter_var(md5($usuariosDTO->getSenha()), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($usuario != null) {
                $cred = $usuario;
                $qry = "SELECT * FROM `usuarios` WHERE nome = :cred AND senha = :senha";
            } else if ($usuario != null && $email != null) {
                $cred = $email;
                $qry = "SELECT * FROM `usuarios` WHERE email = :cred AND senha = :senha";
            } else {
                $cred = $email;
                $qry = "SELECT * FROM `usuarios` WHERE email = :cred AND senha = :senha";
            }

            $select_ = self::connect()->prepare($qry);
            $select_->bindParam(':cred', $cred);
            $select_->bindParam(':senha', $senha);
            $select_->execute();
            $fetchUser = $select_->fetch(PDO::FETCH_ASSOC);
            if ($fetchUser != null) {
                if ($fetchUser['user_type'] == 'admin') {
                    $session = 'admin_id';
                    $id = $fetchUser['codAdmin'];
                } else {
                    $session = 'client_id';
                    $id = $fetchUser['codCliente'];
                }
                $login = array(
                    'session' => $session,
                    'type' => $fetchUser['user_type'],
                    'id' => $id
                );
                return $login;
            }
            return null;
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
    public static function recuperarSenha()
    {
        try {

        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
}