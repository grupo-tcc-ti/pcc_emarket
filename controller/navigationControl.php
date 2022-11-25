<?php 
// page_test
  $section = [];
  $nav_label = 'nada encontrado!';
  if (!empty($_GET['category'])) {
    $cat = new ProdutosDTO;
    $cat->setNome(
      filter_var($_GET['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)
    );
    $section = ProdutosDAO::produtosCategoria($cat);
    $pageTitle = 'Categoria: '.$_GET['category'].'- Techgrifo';
    $nav_label = $cat->getNome();
  }

  else if (!empty($_GET['str'])) {
    $produtos = new ProdutosDTO;
    $produtos->setNome(
    filter_var($_GET['str'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)
    );
    $section = ProdutosDAO::pesquisarProduto($produtos);
    $pageTitle = 'Busca: '.$_GET['str'].'- Techgrifo';
    $nav_label = '"'.$produtos->getNome().'"';
  }
?>