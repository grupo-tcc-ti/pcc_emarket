<?php
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
            // $qry = "SELECT * FROM `carrinho` WHERE fk_usuarios_codCliente = :uid ORDER BY codCarrinho";
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
                $inserir_ = self::connect()->prepare($qry);
                $inserir_->bindParam(':qty', $qty);
                $inserir_->bindParam(':uid', $codCliente);
                $inserir_->bindParam(':pid', $pid);
                $inserir_->execute();
                // echo var_dump($inserir_) . 'insert_pdo::<br>'; //debug

                Message::pop('Produto adicionado ao carrinho!');
            }
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
        return null;
    }
    public static function updateCart()
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            // $qry = "UPDATE `cart` SET quantity = ? WHERE id = ?";
            // Message::pop('Quantidade atualizada!');

        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
        return null;
    }
    public static function deleteCartItem()
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            // $qry = "DELETE FROM `cart` WHERE id = ?";
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
        return null;
    }
    public static function deleteCart($uid)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            // $qry = "DELETE FROM `cart` WHERE user_id = ?";
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }
        return null;
    }

}
?>