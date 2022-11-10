<?php
if (!isset($pdo)) {
    /**
     * Case page doesn't have connection to database
     */
    include_once __DIR__ . '/../connect.php';
}
require_once __DIR__ . '/../dao/_UsuarioDAO.php';
require_once __DIR__ . '/../dto/_UsuarioDTO.php';
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
    public static function listarPedidos($value = 'pendente')
    {
        try{
            // $pdo = Connect::getInstance(); //renameit case fails
            $qry = ("SELECT * FROM `pedidos` WHERE statusPagamento = :status");
            $select_ = self::connect()->prepare($qry);
            $select_->bindValue(':status', $value);
            $select_->execute();
            $pedidos = $select_->fetchAll(PDO::FETCH_ASSOC);
            return $pedidos;
        }
        catch (PDOException $msg){
            $message[] = $msg->getMessage();
            die();
        }
    }
    public static function alterarStatus($codPedido, $status)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            // $codPedido = $_POST['codPedido'];
            // if (empty($_POST['status_pagamento'])){
            if (empty($status)) {
                $statusPagamento = 'Pendente';
            } else { 
                // $statusPagamento = $_POST['status_pagamento'];
                $statusPagamento = $status;
            }
            // var_dump($statusPagamento); //debug
        
            $statusPagamento = filter_var($statusPagamento, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $statusPagamento = ucwords($statusPagamento);
            $statusPagamento = ucfirst($statusPagamento);
            $qry = "UPDATE `pedidos` SET statusPagamento = :status WHERE codPedido = :cpid";
            $alterar_status = self::connect()->prepare($qry);
            $alterar_status->bindParam(':status', $statusPagamento);
            // $alterar_status->bindParam(':cpid', $codPedido);
            $alterar_status->bindParam(':cpid', $codPedido);
            // $mensagem[] = 'Status do pagamento alterado!';
            Message::pop('Status do pagamento alterado!');
            return $alterar_status->execute();
        }
        catch (PDOException $msg){
            $message[] = $msg->getMessage();
            die();
        }
    }
    public static function deletarPedido($codPedido)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            // $codPedido = $_POST['codPedido'];
            $qry = "DELETE FROM `pedidos` WHERE codPedido = :cpid";
            $deletar_pedido = self::connect()->prepare($qry);
            $deletar_pedido->bindParam(':cpid', $codPedido);
            // header('location: pedidos.php');
            return $deletar_pedido->execute();
            // $mensagem[] = 'Produto deletado!';
            Message::pop('Produto deletado!');
            Redirect::page('pedidos.php', 1);
        } catch (PDOException $msg) {
            $message[] = $msg->getMessage();
            die();
        }
    }
}
?>
