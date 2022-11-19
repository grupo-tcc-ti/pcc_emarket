<?php
if (!isset($pdo)) {
    include_once '../model/connect.php';
}
require_once '../model/dao/CarrinhoDAO.php';
require_once '../model/dto/CarrinhoDTO.php';

$cart = new CarrinhoDTO;
if (isset($_SESSION['client_id']['id'])) {
    $cart->setFk_codCliente($_SESSION['client_id']['id']);
}
$fetchCart = CarrinhoDAO::listCart($cart);
$cartTotal['qty'] = $cartTotal['price'] = 0;
foreach ($fetchCart as $total) {
    $cartTotal['qty'] += $total['quantidade'];
    $cartTotal['price'] += ($total['quantidade'] * $total['preco']);
    // echo var_dump($produ) . '<br>'; //debug
}
// echo var_dump($cartTotal) . '<br>'; //debug

if (isset($_POST['add_cart'])) {

    if (!isset($_SESSION['client_id'])) {
        Message::pop('Faça uma conta e aproveite nossas ofertas!');
        Redirect::page('conta.php', 2);
    } else {
        // Message::pop('Produto adicionado ao carrinho!');
        $carrinho = new CarrinhoDTO;
        $carrinho->setFk_codCliente($_SESSION['client_id']['id']);
        (isset($_POST['pid'])) ? $carrinho->setFk_codProduto($_POST['pid']) : '';
        (isset($_POST['qty'])) ? $carrinho->setQuantidade($_POST['qty']) : '';
        // (isset($_POST['option'])) ? $carrinho->setQuantidade($_POST['option']) : '';

        // $cart = CarrinhoDAO::addToCart($carrinho);
        CarrinhoDAO::addToCart($carrinho);
        Redirect::page($_SERVER['PHP_SELF'], 1, 'self');
    }

}

if (isset($_POST['del_cart'])) {
    Message::pop('excluiu item!');
}
if (isset($_POST['buy'])) {
    Message::pop('fechou pedido!');
}
?>