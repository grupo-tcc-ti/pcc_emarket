<?php
// require_once __DIR__ . '/../connect.php';
// include __DIR__ . '/../connect.php';
// include '../connect.php';

// require_once __DIR__ . '/../dto/UsuarioDTO.php';
// include __DIR__ . '/../dto/PedidosDTO.php';
if (!isset($pdo)){
    include '../model/connect.php'; //Caso a pagina ja possua um connect não precisa desse
}
class PedidosDAO {
    protected static $inst;
    // protected static $pdo = Connect::getInstance();
    public static function ListarPedidos($value = 'pendente') {
        try{
            $pdo = Connect::getInstance();
            $qry = ("SELECT * FROM `pedidos` WHERE statusPagamento = :status");
            $select_ = $pdo->prepare($qry);
            // $select_ = self::$pdo->prepare($qry);
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
    public static function Alterar_Status($codPedido, $status) {
        try {
        $pdo = Connect::getInstance();
        // $codPedido = $_POST['codPedido'];
        // if (empty($_POST['status_pagamento'])){
        if (empty($status)){
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
        $alterar_status = $pdo->prepare($qry);
        $alterar_status->bindParam(':status', $statusPagamento);
        // $alterar_status->bindParam(':cpid', $codPedido);
        $alterar_status->bindParam(':cpid', $codPedido);
        $mensagem[] = 'Status do pagamento alterado!';
        return $alterar_status->execute();
        }
        catch (PDOException $msg){
            $message[] = $msg->getMessage();
            die();
        }
    }
    public static function Deletar_Pedido($codPedido) {
        try {
        $pdo = Connect::getInstance();
        // $codPedido = $_POST['codPedido'];
        $qry = "DELETE FROM `pedidos` WHERE codPedido = :cpid";
        $deletar_pedido = $pdo->prepare($qry);
        $deletar_pedido->bindParam(':cpid',$codPedido);
        // header('location: pedidos.php');
        return $deletar_pedido->execute();
        $mensagem[] = 'Produto deletado!';
        Redirect::page('pedidos.php', 1);
    } catch (PDOException $msg) {
        $message[] = $msg->getMessage();
        die();
    }
    }
}
?>