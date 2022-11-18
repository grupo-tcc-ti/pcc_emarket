<?php
if (!isset($pdo)) {
    /**
     * Case page doesn't have connection to database
     */
    include_once __DIR__ . '/../connect.php';
}
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
            // $qry = ("SELECT * FROM `pedidos` WHERE statusPagamento = :status");
            $qry = ("SELECT * FROM `pedidos`
            LEFT JOIN `usuarios`
            ON `pedidos`.fk_usuarios_codCliente = `usuarios`.codCliente;
            ORDER BY `pedidos`.statusPagamento ASC");
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
            // $qry = ("SELECT * FROM `pedidos` WHERE statusPagamento = :status");
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
    public static function alterarStatus(PedidosDTO $pedidoDTO)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            if (
                empty($pedidoDTO->getStatusPagamento())
                || is_null($pedidoDTO->getStatusPagamento())
            ) {
                // Message::pop('Status do pagamento alterado!');
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
            Message::pop('Produto deletado!');
            Redirect::page('pedidos.php', 1);
            $deletar_pedido->execute();
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
}
?>