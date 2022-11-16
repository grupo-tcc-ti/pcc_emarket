<?php 
// page_test
  $section = [];

  if (isset($_GET['category']) && !empty($_GET['category'])) {
    $cat = new ProdutosDTO;
    $cat->setNome(
      filter_var($_GET['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)
    );
    $section = ProdutosDAO::produtosCategoria($cat);
    $pageTitle = 'Categoria: '.$_GET['category'].'- Techgrifo';
    $nav_label = $cat->getNome();
  } 
  else if (isset($_GET['str']) && !empty($_GET['str'])) {
    $produtos = new ProdutosDTO;
    $produtos->setNome(
    filter_var($_GET['str'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)
    );
    $section = ProdutosDAO::pesquisarProduto($produtos); 
    $pageTitle = 'Busca: '.$_GET['str'].'- Techgrifo';
    $nav_label = '"'.$produtos->getNome().'"';
  } 
  else { 
    $nav_label = 'nada encontrado!';
  }
?>
