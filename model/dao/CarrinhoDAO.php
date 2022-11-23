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
class CarrinhoDAO
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
    public static function listCart(CarrinhoDTO $carrinhoDTO)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $uid = filter_var($carrinhoDTO->getFk_codCliente(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // echo var_dump($uid) . '<br>';
            $qry = "SELECT * FROM `carrinho` crt
            LEFT OUTER JOIN `produtos` pdo
            ON crt.fk_produtos_codProduto = pdo.codProduto
            WHERE fk_usuarios_codCliente = :uid
            ORDER BY codCarrinho";
            $select_ = self::connect()->prepare($qry);
            $select_->bindParam(':uid', $uid);
            $select_->execute();
            return $select_->fetchAll(PDO::FETCH_ASSOC);
            // $cart = $select_->fetchAll(PDO::FETCH_ASSOC); //debug
            // echo var_dump($cart) . '<br>'; //debug
            // return $cart; //debug
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
    public static function buyCart(CarrinhoDTO $carrinhoDTO)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $uid = filter_var($carrinhoDTO->getFk_codCliente(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // echo var_dump($uid) . '<br>';
            $qry = "SELECT * FROM `carrinho` WHERE fk_usuarios_codCliente = :uid";
            $select_ = self::connect()->prepare($qry);
            $select_->bindParam(':uid', $uid);
            $select_->execute();
            $cartData = $select_->fetchAll(PDO::FETCH_ASSOC);
            // $qtyProd = $select_->rowCount(); //debug
            // echo var_dump($qtyProd) . '<br>'; //debug
            // echo var_dump($cart) . '<br>'; //debug
            // return $cart; //debug
            if (!is_null(PedidosDAO::fazerPedido($uid, $cartData))) {
                return true;
            }
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
    public static function addToCart(CarrinhoDTO $carrinhoDTO)
    {
        try {
            $codCliente = filter_var($carrinhoDTO->getFk_codCliente(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pid = filter_var($carrinhoDTO->getFk_codProduto(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $qty = filter_var($carrinhoDTO->getQuantidade(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // echo $codCliente . ' :: ' . $pid . ' :: ' . $qty . '<br>'; //debug

            $qry = "SELECT * FROM `carrinho` WHERE fk_produtos_codProduto = :pid AND fk_usuarios_codCliente = :uid";
            $fetchCart = self::connect()->prepare($qry);
            $fetchCart->bindParam(':pid', $pid);
            $fetchCart->bindParam(':uid', $codCliente);
            $fetchCart->execute();

            if ($fetchCart->rowCount() > 0) {
                // echo var_dump($fetchCart) . '::cart_post_count<br>';
                Message::pop('Produto já está no carrinho!');
                return;
            } else {
                // $qry = "SELECT favoritos FROM `carrinho` WHERE fk_produtos_codProduto = :pid AND fk_usuarios_codCliente = :uid";
                $qry = "SELECT favoritos FROM `usuarios` WHERE codCliente = :uid";
                $fetchWishlist = self::connect()->prepare($qry);
                // $fetchWishlist->bindParam(':pid', $pid);
                $fetchWishlist->bindParam(':uid', $codCliente);
                $fetchWishlist->execute();
                $favs = $fetchWishlist->fetchAll(PDO::FETCH_ASSOC);
                // echo var_dump($favs) . 'wishlist_pdo::<br>'; //debug
                if (count($favs)) {
                    // echo 'fav_count_true::<br>'; //debug
                    // CarrinhoDAO::removeFromWishlist(); //remover dos favoritos e adicionar ao carrinho (design ruim, melhor remover depois da compra)
                    ////     $qry = "DELETE FROM `wishlist` WHERE fk_produtos_codProduto = :pid AND fk_usuarios_codCliente = :uid";
                    ////     $delete_ = self::connect()->prepare($qry);
                    ////     $delete_->execute();
                }

                $qry = "INSERT INTO `carrinho`
                (quantidade, fk_usuarios_codUsuario, fk_usuarios_codCliente, fk_produtos_codProduto) 
                VALUES(:qty,(SELECT codUsuario FROM `usuarios` WHERE codCliente = :uid),:uid,:pid)";
                // VALUES(?,?,?,?,?,?)";
                $insert_ = self::connect()->prepare($qry);
                $insert_->bindParam(':qty', $qty);
                $insert_->bindParam(':uid', $codCliente);
                $insert_->bindParam(':pid', $pid);
                return $insert_->execute();
                // echo var_dump($inserir_) . 'insert_pdo::<br>'; //debug

            }
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
    public static function updateCart(CarrinhoDTO $carrinhoDTO)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $uid = filter_var($carrinhoDTO->getFk_codCliente(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pid = filter_var($carrinhoDTO->getFk_codProduto(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $qty = filter_var($carrinhoDTO->getQuantidade(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // funcionamento
            // $qry = "SELECT quantidade FROM `carrinho` WHERE fk_usuarios_codCliente = :uid AND fk_produtos_codProduto = :pid";
            // if ($quantidade != $qty) {
            //     echo 'alterar quantidade';
            // } else if ($quantidade == $qty) {
            //     return;
            // }

            $qry = "UPDATE `carrinho` SET quantidade = :qty WHERE fk_usuarios_codCliente = :uid AND fk_produtos_codProduto = :pid";
            $update_ = self::connect()->prepare($qry);
            $update_->bindParam(":uid", $uid);
            $update_->bindParam(":pid", $pid);
            $update_->bindParam(":qty", $qty);
            return $update_->execute();
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
    public static function deleteCartItem(CarrinhoDTO $carrinhoDTO)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $uid = filter_var($carrinhoDTO->getFk_codCliente(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pid = filter_var($carrinhoDTO->getFk_codProduto(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $qry = "DELETE FROM `carrinho` WHERE fk_usuarios_codCliente = :uid AND fk_produtos_codProduto = :pid";
            $delete_item_ = self::connect()->prepare($qry);
            $delete_item_->bindParam(":uid", $uid);
            $delete_item_->bindParam(":pid", $pid);
            return $delete_item_->execute();
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }
    public static function deleteCart(CarrinhoDTO $carrinhoDTO)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $uid = filter_var($carrinhoDTO->getFk_codCliente(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $qry = "DELETE FROM `carrinho` WHERE fk_usuarios_codCliente = :uid";
            $delete_ = self::connect()->prepare($qry);
            $delete_->bindParam(":uid", $uid);
            return $delete_->execute();
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
    }

}
?>