<?php 
if (!isset($pdo)) {
    include_once '../model/connect.php';
}
require_once '../model/dao/ProdutosDAO.php';
require_once '../model/dto/ProdutosDTO.php';
if (isset($_GET['str']) && !empty($_GET['str'])){
    $search = [];
    $produtos = new ProdutosDTO;
    $produtos->setNome($_GET['str']);
    $search = ProdutosDAO::pesquisarProduto($produtos);
} else { $_GET['str'] = 'nada encontrado!'; }
?>