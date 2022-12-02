<?php
if (!isset($pdo)) {
    /**
     * Case page doesn't have connection to database
     */
    include_once __DIR__ . '/../connect.php';
}
//undo requirefolder if fails!
File_Path::requireFolder('../model/dao');
File_Path::requireFolder('../model/dto');
class PedidosDAO
{
    protected static $inst;
    private static $pdo;
    private static function connect()
    {
        if (!isset(self::$pdo)) {
            self::$pdo = Connect::getInstance();
        }
        return self::$pdo;
    }
    // public static function listarPedidos($value = 'pendente')
    public static function listarPedidos()
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $qry = ("SELECT *
            FROM `pedidos` pd
            LEFT JOIN (
                SELECT *, CONCAT(cidade, ', ', endereco, ', Número: ', numero, ', ', complemento, ' - ', estado) AS fullAddress
                FROM `usuarios`
                WHERE codCliente > 0
            ) usr
            ON pd.fk_usuarios_codCliente = usr.codCliente
            ORDER BY pd.statusPagamento ASC");
            $select_ = self::connect()->prepare($qry);
            $select_->execute();
            return $select_->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
    public static function listarPedidosTipo($value = 'pendente')
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $qry = ("SELECT * FROM `pedidos` WHERE statusPagamento = :status");
            $select_ = self::connect()->prepare($qry);
            $select_->bindValue(':status', $value);
            $select_->execute();
            return $select_->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
    public static function listarPedidosUserId($uid)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $qry = ("SELECT * FROM `pedidos` WHERE fk_usuarios_codCliente  = :uid");
            $select_ = self::connect()->prepare($qry);
            $select_->bindValue(':uid', $uid);
            $select_->execute();
            return $select_->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }

    public static function fazerPedido($uid, $cartData)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $qry = ("SELECT * FROM `usuarios` WHERE codCliente = :uid");
            $select_ = self::connect()->prepare($qry);
            $select_->bindValue(':uid', $uid);
            $select_->execute();
            $fetch_user_ = $select_->fetch(PDO::FETCH_ASSOC);

            // reminder: form com tipoEntrega, tipoPagamento(inserir no banco) - inserir endereco, 
            $codUsuario = filter_var($fetch_user_['codUsuario'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $totalProduto = [];
            $totalPreco = 0;
            foreach ($cartData as $data) {
                $qry = ("SELECT nome, preco, image FROM `produtos` WHERE codProduto = :pid");
                $select_ = self::connect()->prepare($qry);
                $select_->bindValue(':pid', $data['fk_produtos_codProduto']);
                $select_->execute();
                $produto = $select_->fetch();
                // $totalProduto[] = "$produto[nome]  ($data[quantidade])";
                $totalProduto[] = array('nome' => $produto['nome'], 'preco' => $produto['preco'], 'quantidade' => $data['quantidade'], 'image' => $produto['image']);

                $totalPreco += ($data['quantidade'] * $produto['preco']);
            }

            $qry = ("INSERT INTO `pedidos` (tipoEntrega, totalProduto, totalPreco, dataEnvio, dataEntrega, statusPagamento, fk_usuarios_codUsuario, fk_usuarios_codCliente)
            VALUES ('Correríos', :totalprod, :totalprc, CURRENT_DATE(), NULL, 'pendente', :pkey, :uid)");
            $insert_ = self::connect()->prepare($qry);
            // $insert_->bindValue(':totalprod', implode(", ", $totalProduto));
            $insert_->bindValue(':totalprod', serialize($totalProduto));
            $insert_->bindValue(':totalprc', $totalPreco);
            $insert_->bindValue(':pkey', $codUsuario);
            $insert_->bindValue(':uid', $uid);

            $del_cart_ = new CarrinhoDTO;
            $del_cart_->setFk_codCliente($uid);
            if (CarrinhoDAO::deleteCart($del_cart_)) {
                return $insert_->execute();
            }

        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
    public static function alterarStatus(PedidosDTO $pedidoDTO)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            if (is_null($pedidoDTO->getStatusPagamento())) {
                return;
            } else {
                $statusPagamento = filter_var($pedidoDTO->getStatusPagamento(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
            $statusPagamento = ucfirst($statusPagamento);
            $qry = "UPDATE `pedidos` SET statusPagamento = :status WHERE codPedido = :cpid";
            $alterar_status = self::connect()->prepare($qry);
            $alterar_status->bindParam(':status', $statusPagamento);
            $alterar_status->bindValue(':cpid', $pedidoDTO->getCodPedido());
            Message::pop('Status do pagamento alterado!');
            $alterar_status->execute();
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
    public static function deletarPedido($codPedido)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $qry = "DELETE FROM `pedidos` WHERE codPedido = :cpid";
            $deletar_pedido = self::connect()->prepare($qry);
            $deletar_pedido->bindParam(':cpid', $codPedido);
            Message::pop('Pedido deletado!');
            Redirect::page('pedidos.php', 1);
            $deletar_pedido->execute();
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
}
?>