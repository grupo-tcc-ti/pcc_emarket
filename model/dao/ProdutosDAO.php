<?php
if (!isset($pdo)) {
    /**
     * Case page doesn't have connection to database
     */
    include_once __DIR__ . '/../connect.php';
}
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
    public static function qtyProdutos()
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $qry = ("SELECT * FROM `produtos`");
            $select_ = self::connect()->prepare($qry);
            $select_->execute();
            echo $select_->rowCount();
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
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
            return $select_->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
        }

    }
    public static function productByID($pid)
    {
        try {
            // $con = Connect::getInstance(); //renameit case fails
            // $qry = "SELECT * FROM `produtos` WHERE nome LIKE '%{$search_name}%'";
            $qry = "SELECT * FROM `produtos` WHERE codProduto = :pid";
            $select_ = self::connect()->prepare($qry);
            $select_->bindParam(':pid', $pid);
            $select_->execute();
            return $select_->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
        }

    }
    public static function pesquisarProduto(ProdutosDTO $produtosDTO)
    {
        try {
            // $con = Connect::getInstance(); //renameit case fails
            $search_box = filter_var($produtosDTO->getNome(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $qry = "SELECT * FROM `produtos` WHERE nome LIKE '%{$search_box}%' OR descricao LIKE '%{$search_box}%'";
            $select_ = self::connect()->prepare($qry);
            $select_->execute();
            // $search['found'] = true;
            $search['catalog'] = $select_->fetchAll(PDO::FETCH_ASSOC);
            // if (count($search['catalog']) == 0) {
            //     //se a pesquisa não econtrou itens, pesquisa de itens relacionados começa

            //     $search['found'] = false;
            //     // echo var_dump($search['found']) . '<br>'; //debug

            //     $search_box = explode(" ", $search_box);
            //     // echo var_dump($search_box). '<br>'; //debug

            //     foreach ($search_box as $str) {
            //         $qry = "SELECT * FROM `produtos` WHERE nome LIKE '%{$str}%' OR descricao LIKE '%{$str}%'";
            //         // echo var_dump($qry). '<br>'; //debug

            //         $select_ = self::connect()->prepare($qry);
            //         $select_->execute();

            //         //adiciona ao catalogo itens relacionados de cada palavra ex.: cadeira computador, ou , processador computador
            //         $fetch_prod = $select_->fetchAll(PDO::FETCH_ASSOC);
            //         if (count($fetch_prod) > 0) {
            //             foreach ($fetch_prod as $item) {
            //                 array_push($search['catalog'], $item);
            //             }
            //         }
            //     }
            // }
            return $search;
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
        }

    }
    public static function produtosCategoria(ProdutosDTO $produtosDTO)
    {
        try {
            // $con = Connect::getInstance(); //renameit case fails
            $category = filter_var($produtosDTO->getNome(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $qry = "SELECT * FROM `produtos` WHERE nome LIKE '%{$category}%'"; //nome -> categoria /mudar posteriormente
            $select_ = self::connect()->prepare($qry);
            $select_->execute();
            // return $select_->fetchAll(PDO::FETCH_ASSOC);
            $cat = $select_->fetchAll(PDO::FETCH_ASSOC);
            // echo var_dump(count($cat)) . '<br>'; //debug
            return $cat;
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
        }

    }
    public static function cadastrarProduto($nome, $descricao, $preco, $files_img)
    {
        try {
            // $pdo = Connect::getInstance(); //renameit case fails
            $nome = filter_var($nome, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $descricao = filter_var($descricao, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $preco = filter_var($preco, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $selecionar_ = self::connect()->prepare("SELECT * FROM `produtos` WHERE nome = :nome");
            $selecionar_->bindParam(':nome', $nome);
            $selecionar_->execute();

            $name_valid = false;
            //Verifica se produto com mesmo nome
            if ($selecionar_->rowCount() > 0) {
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
                $inserir_->bindValue(":image", is_array($image_hand) ? implode(',', $image_hand) : $image_hand);
                // $mensagem[] = 'Produto adicionado com sucesso!';
                Message::pop('Produto adicionado com sucesso!');
                $inserir_->execute();
            }
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
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
                        is_array($image_hand) ? 
                        ((count($image_hand) > 1) ? 
                            implode(',', $image_hand) :
                            implode($image_hand)) : $image_hand
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
            echo "Erro ao conectar :: " . $msg->getMessage();
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
                foreach ($fetched_imgs as $prod_img) {
                    if (file_exists($prod_img)) {
                        // echo ($prod_img . ':image_unlinked');
                        // unlink($prod_img); //apaga a imagem da pasta
                    } else {
                        echo ($prod_img . ':file_doesnt_exist; ');
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

            Message::pop('Produto deletado com sucesso!');
            $del_prod->execute();
            $del_prod_cart_wlist->execute();
        } catch (PDOException $msg) {
            echo "Erro ao conectar :: " . $msg->getMessage();
            die();
        }

    }
}
?>