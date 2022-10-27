<?php
// require_once __DIR__ . '/../connect.php';
// include __DIR__ . '/../connect.php';

// require_once __DIR__ . '/../dto/UsuarioDTO.php';
// include __DIR__ . '/../dto/PedidosDTO.php';
if (!isset($pdo)){
    include '../model/connect.php'; //Caso a pagina ja possua um connect não precisa desse
}
include '../model/image_handle.php';
class ProdutosDAO {
    protected static $inst;
    public static function QtyProdutos() {
        try{
            $pdo = Connect::getInstance();
            $qry = ("SELECT * FROM `produtos`");
            $select_ = $pdo->prepare($qry);
            $select_->execute();
            return $select_->rowCount();
        }
        catch (PDOException $msg){
            $message[] = $msg->getMessage();
            die();
        }
    }
    ###################################################################################################################
    public static function Cadastrar_Produto($nome, $descricao, $preco, $files_img) {
        try {
            $pdo = Connect::getInstance();
            // $nome = $_POST['nome'];
            $nome = filter_var($nome, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $descricao = $_POST['descricao'];
            $descricao = filter_var($descricao, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $preco = $_POST['preco'];
            $preco = filter_var($preco, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $selecionar_ = $pdo->prepare("SELECT * FROM `produtos` WHERE nome = :nome");
            $selecionar_->bindParam(':nome', $nome);
            $selecionar_->execute();

            $name_valid = false;
            //Verifica se produto com mesmo nome
            if ($selecionar_->rowCount() > 0) {
                $mensagem[] = 'Um produto com o mesmo nome ja existe!';
                $name_valid = false;
                // echo ':name_invalid:'; //debug
            } else {
                $name_valid = true;
                // echo ':name_valid:'; //debug
            }
            // $image_hand = Image::AddProces($_FILES['image']);
            $image_hand = Image::AddProces($files_img);
            //Confirma se imagens validas
            // if ($name_valid && $path_valid && $size_valid && $upload_valid) {
            if ($name_valid && Image::Validate()) {
                //Insere o produto
                $inserir_ = $pdo->prepare("INSERT INTO `produtos` (nome, descricao, preco, image)
                VALUES (:nome, :descricao, :preco, :image)");
                $inserir_->bindParam(":nome", $nome);
                $inserir_->bindParam(":descricao", $descricao);
                $inserir_->bindParam(":preco", $preco);
                $inserir_->bindValue(":image", is_array($image_hand)?implode(',', $image_hand):$image_hand);
                $mensagem[] = 'Produto adicionado com sucesso!';
                return $inserir_->execute();

                $_GET = $_POST = array();
                unset($_POST);
                unset($_GET);
            }
        } catch (PDOException $msg) {
            $message[] = $msg->getMessage();
            die();
        }
    }
    ###################################################################################################################
    public static function Alterar_Produto($codProduto, $nome, $nome_anterior, $descricao, $preco, $files_img) {
        try {
            $pdo = Connect::getInstance();
            // $codProduto = $_POST['codProduto'];
            $codProduto = filter_var($codProduto, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $nome = $_POST['nome'];
            $nome = filter_var($nome, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $nome_anterior = $_POST['nome_anterior'];
            $nome_anterior = filter_var($nome_anterior, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $descricao = $_POST['descricao'];
            $descricao = filter_var($descricao, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $preco = $_POST['preco'];
            $preco = filter_var($preco, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // $image_hand = Image::AddProces($_FILES['image']);
            $image_hand = Image::AddProces($files_img);

            if (Image::Validate()) {
                $alterar_prod = $pdo->prepare("UPDATE `produtos` 
                SET nome = :nome, descricao = :descricao, preco = :preco 
                WHERE codProduto = :cpid");
                $alterar_prod->bindParam(':nome', $nome);
                $alterar_prod->bindParam(':descricao', $descricao);
                $alterar_prod->bindValue(':preco', $preco);
                $alterar_prod->bindParam(':cpid', $codProduto);
                $alterar_prod->execute();
                if (!implode($files_img['error']) == 4) {
                    $alterar_prod = $pdo->prepare("UPDATE `produtos` SET image = :image WHERE codProduto = :cpid");
                    $alterar_prod->bindValue(":image", 
                    is_array($image_hand)?
                        ((count($image_hand) > 1)?
                        implode(',', $image_hand):
                        implode($image_hand)): $image_hand
                    );
                    $alterar_prod->bindParam(':cpid', $codProduto);
                    $alterar_prod->execute();
                }
                $hostname = $_SERVER['HTTP_HOST'];
                $current_directory = rtrim(dirname($_SERVER['PHP_SELF']),'/');
                $page = 'alterar_produto.php';
                $mensagem[] = 'Produto alterado com sucesso!';
                // header('refresh: 1, url=http://'.$hostname.$current_directory.'/'.$page);
                // exit;
            }
        } catch (PDOException $msg) {
            echo $msg->getMessage();
        }
    }
    ###################################################################################################################
    public static function Deletar_Produto($prod_id) {
        try {
            $pdo = Connect::getInstance();
            // $delete_id = $_POST['deletar_prod'];
            $del_prod_img = $pdo->prepare("SELECT * FROM `produtos` WHERE codProduto = :id"); //_img
            $del_prod_img->bindParam(':id', $prod_id);
            $del_prod_img->execute();
            /* Unlink image from product*/
            $fetch_del_img = $del_prod_img->fetch(PDO::FETCH_ASSOC);
            if ($fetch_del_img['image']) {
                $fetched_imgs = explode(",", $fetch_del_img['image']);
                foreach ($fetched_imgs as $prod_img){
                    // echo($prod_img);
                    // unlink($prod_img);
                    if(file_exists($prod_img)){
                        // echo($prod_img.':image_unlinked');
                        echo(':image_unlinked; ');
                        // unlink($prod_img);
                    }else{
                        echo($prod_img.':file_doesnt_exist; ');
                    }
                }
            }
            /* Deleta produto do banco */
            $del_prod = $pdo->prepare("DELETE FROM `produtos` WHERE codProduto = :id");
            $del_prod->bindParam(':id', $prod_id);
            // $del_prod->execute();

            /* Deleta produto do carrinho e listadedesejo*/
            $del_prod_cart_wlist = $pdo->prepare("DELETE FROM `carrinho` WHERE :fk_id = :id");
            // $del_prod_cart_wlist = $pdo->prepare("DELETE FROM `listadedesejo` WHERE :fk_id = :id");
            $del_prod_cart_wlist->bindParam(':id', $prod_id);
            $del_prod_cart_wlist->bindValue(':fk_id', 'produtos_codProduto');
            // $del_prod_cart_wlist->execute();
            
            return $del_prod->execute();
            return $del_prod_cart_wlist->execute();
            return $mensagem[] = 'Produto deletado com sucesso!';

            $_GET = $_POST = array();
            unset($_POST);
            unset($_GET);
        } catch (PDOException $msg) {
            echo $msg->getMessage();
            die();
        }
    
    }
}
?>