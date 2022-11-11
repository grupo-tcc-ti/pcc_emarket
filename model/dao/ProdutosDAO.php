<?php
if (!isset($pdo)) {
    /**
     * Case page doesn't have connection to database
     */
    include_once __DIR__ . '/../connect.php';
}
require_once __DIR__ . '/../dao/_UsuarioDAO.php';
require_once __DIR__ . '/../dto/_UsuarioDTO.php';
require '../model/image_handle.php';
class ProdutosDAO
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
    public static function QtyProdutos()
    {
        try{
            // $pdo = Connect::getInstance(); //renameit case fails
            $qry = ("SELECT * FROM `produtos`");
            $select_ = self::connect()->prepare($qry);
            $select_->execute();
            return $select_->rowCount();
        }
        catch (PDOException $msg){
            $message[] = $msg->getMessage();
            die();
        }
    }
    public static function listarProdutos()
    {
        try {
            // $con = Connect::getInstance(); //renameit case fails
            $qry = "SELECT * FROM `produtos` ORDER BY nome";
            $select_ = self::connect()->prepare($qry);
            $select_->execute();
            $usuarios = $select_->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios;
        } catch ( PDOException $msg ) {
            echo $msg->getMessage();
        }
        
    }
    // 
    public static function cadastrarProduto($nome, $descricao, $preco, $files_img)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            // $nome = $_POST['nome'];
            $nome = filter_var($nome, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $descricao = $_POST['descricao'];
            $descricao = filter_var($descricao, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $preco = $_POST['preco'];
            $preco = filter_var($preco, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $selecionar_ = self::connect()->prepare("SELECT * FROM `produtos` WHERE nome = :nome");
            $selecionar_->bindParam(':nome', $nome);
            $selecionar_->execute();

            $name_valid = false;
            //Verifica se produto com mesmo nome
            if ($selecionar_->rowCount() > 0) {
                // $mensagem[] = 'Um produto com o mesmo nome ja existe!';
                Message::pop('Um produto com o mesmo nome ja existe!');
                $name_valid = false;
                // echo ':name_invalid:'; //debug
            } else {
                $name_valid = true;
                // echo ':name_valid:'; //debug
            }
            // $image_hand = Image::AddProces($_FILES['image']);
            $image_hand = Image::addProces($files_img);
            //Confirma se imagens validas
            // if ($name_valid && $path_valid && $size_valid && $upload_valid) {
            if ($name_valid && Image::Validate()) {
                //Insere o produto
                $inserir_ = self::connect()->prepare(
                    "INSERT INTO `produtos` (nome, descricao, preco, image)
                VALUES (:nome, :descricao, :preco, :image)"
                );
                $inserir_->bindParam(":nome", $nome);
                $inserir_->bindParam(":descricao", $descricao);
                $inserir_->bindParam(":preco", $preco);
                $inserir_->bindValue(":image", is_array($image_hand)?implode(',', $image_hand):$image_hand);
                // $mensagem[] = 'Produto adicionado com sucesso!';
                Message::pop('Produto adicionado com sucesso!');
                return $inserir_->execute();
            }
        } catch (PDOException $msg) {
            $message[] = $msg->getMessage();
            die();
        }
    }
    // 
    public static function alterarProduto($codProduto, $nome, $nome_anterior, $descricao, $preco, $files_img)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $codProduto = filter_var($codProduto, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $nome = filter_var($nome, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $nome_anterior = filter_var($nome_anterior, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $descricao = filter_var($descricao, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $preco = filter_var($preco, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $image_hand = Image::addProces($files_img);
            if (Image::Validate()) {
                $alterar_prod = self::connect()->prepare(
                    "UPDATE `produtos` 
                SET nome = :nome, descricao = :descricao, preco = :preco 
                WHERE codProduto = :cpid"
                );
                $alterar_prod->bindParam(':nome', $nome);
                $alterar_prod->bindParam(':descricao', $descricao);
                $alterar_prod->bindValue(':preco', $preco);
                $alterar_prod->bindParam(':cpid', $codProduto);
                $alterar_prod->execute();
                if (!implode($files_img['error']) == 4) {
                    $alterar_prod = self::connect()->prepare("UPDATE `produtos` SET image = :image WHERE codProduto = :cpid");
                    $alterar_prod->bindValue(
                        ":image", 
                        is_array($image_hand)?
                        ((count($image_hand) > 1)?
                        implode(',', $image_hand):
                        implode($image_hand)): $image_hand
                    );
                    $alterar_prod->bindParam(':cpid', $codProduto);
                    $alterar_prod->execute();
                }
                $hostname = $_SERVER['HTTP_HOST'];
                $current_directory = rtrim(dirname($_SERVER['PHP_SELF']), '/');
                $page = 'alterar_produto.php';
                // $mensagem[] = 'Produto alterado com sucesso!';
                Message::pop('Produto alterado com sucesso!');
            }
        } catch (PDOException $msg) {
            echo $msg->getMessage();
        }
    }
    // 
    public static function deletarProduto($prod_id)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            // $delete_id = $_POST['deletar_prod'];
            $del_prod_img = self::connect()->prepare("SELECT * FROM `produtos` WHERE codProduto = :id"); //_img
            $del_prod_img->bindParam(':id', $prod_id);
            $del_prod_img->execute();
            /* Unlink image from product*/
            $fetch_del_img = $del_prod_img->fetch(PDO::FETCH_ASSOC);
            if ($fetch_del_img['image']) {
                $fetched_imgs = explode(",", $fetch_del_img['image']);
                foreach ($fetched_imgs as $prod_img){
                    if(file_exists($prod_img)) {
                        echo($prod_img.':image_unlinked');
                        // unlink($prod_img);
                    }else{
                        echo($prod_img.':file_doesnt_exist; ');
                    }
                }
            }
            /* Deleta produto do banco */
            $del_prod = self::connect()->prepare("DELETE FROM `produtos` WHERE codProduto = :id");
            $del_prod->bindParam(':id', $prod_id);

            /* Deleta produto do carrinho e listadedesejo*/
            $del_prod_cart_wlist = self::connect()->prepare("DELETE FROM `carrinho` WHERE :fk_id = :id");
            $del_prod_cart_wlist->bindParam(':id', $prod_id);
            $del_prod_cart_wlist->bindValue(':fk_id', 'produtos_codProduto');

            return $del_prod->execute();
            return $del_prod_cart_wlist->execute();
            // return $mensagem[] = 'Produto deletado com sucesso!';
            Message::pop('Produto deletado com sucesso!');
        } catch (PDOException $msg) {
            echo $msg->getMessage();
            die();
        }
    
    }
}
?>
