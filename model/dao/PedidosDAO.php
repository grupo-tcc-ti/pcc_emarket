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
    public static function fazerPedido()
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            // $qry = ("SELECT * FROM `pedidos` WHERE statusPagamento = :status");
            // if (isset($_POST['order'])) {

            //     $name = $_POST['name'];
            //     $name = filter_var($name, FILTER_SANITIZE_STRING);
            //     $number = $_POST['number'];
            //     $number = filter_var($number, FILTER_SANITIZE_STRING);
            //     $email = $_POST['email'];
            //     $email = filter_var($email, FILTER_SANITIZE_STRING);
            //     $method = $_POST['method'];
            //     $method = filter_var($method, FILTER_SANITIZE_STRING);
            //     $address = 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code'];
            //     $address = filter_var($address, FILTER_SANITIZE_STRING);
            //     $total_products = $_POST['total_products'];
            //     $total_price = $_POST['total_price'];

            //     $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            //     $check_cart->execute([$user_id]);

            //     if ($check_cart->rowCount() > 0) {

            //         $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
            //         $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

            //         $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            //         $delete_cart->execute([$user_id]);

            //         $message[] = 'order placed successfully!';
            //     } else {
            //         $message[] = 'your cart is empty';
            //     }

            // }
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