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

// $cartTeste = CarrinhoDAO::listCart($cart);
// echo var_dump($cartTeste) . '<br>';


$fetchCart = CarrinhoDAO::listCartByUserId($cart);
$cartTotal['qty'] = $cartTotal['price'] = 0;
foreach ($fetchCart as $total) {
    $cartTotal['qty'] += $total['quantidade'];
    $cartTotal['price'] += ($total['quantidade'] * $total['preco']);
    // echo var_dump($total) . '<br><br>'; //debug
}
// echo var_dump($cartTotal) . '<br>'; //debug

if (isset($_POST['client_cart'])) {
    // echo var_dump($_POST['client_cart']) . '<br>'; //debug

    if (!isset($_SESSION['client_id'])) {
        Message::pop('Faça uma conta e aproveite nossas ofertas!');
        Redirect::page('conta.php', 2);
    } else {
        $carrinho = new CarrinhoDTO;
        $carrinho->setFk_codCliente($_SESSION['client_id']['id']);
        (isset($_POST['pid'])) ? $carrinho->setFk_codProduto($_POST['pid']) : '';
        (isset($_POST['qty'])) ? $carrinho->setQuantidade($_POST['qty']) : '';
        // (isset($_POST['option'])) ? $carrinho->setOption($_POST['option']) : '';

        // echo var_dump($carrinho->getFk_codCliente()) . '<br>'; //debug
        // echo var_dump($carrinho->getFk_codProduto()) . '<br>'; //debug
        // echo var_dump($carrinho->getQuantidade()) . '<br>'; //debug
        // echo var_dump($_POST['client_cart']) . '<br>';
        switch (true) {
            // melhorar design para alterar produto
            // case (isset($_POST['updt_cart'])):
            //     if (!is_null(CarrinhoDAO::updateCart($carrinho))) {
            //         Message::pop('atualizou quantidade!');
            //     }
            //     break;
            case (isset($_POST['add_cart'])):
                if (!is_null(CarrinhoDAO::addToCart($carrinho))) {
                    Message::pop('Produto adicionado ao carrinho!');
                    // Redirect::page($_SERVER['PHP_SELF'], 2, 'self');
                }
                break;
            case (isset($_POST['del_cart_item'])):
                if (!is_null(CarrinhoDAO::deleteCartItem($carrinho))) {
                    Message::pop('excluiu item!');
                }
                break;
            case (isset($_POST['del_cart'])):
                if (!is_null(CarrinhoDAO::deleteCart($carrinho))) {
                    Message::pop('esvaziou carrinho!');
                }
                break;
            case ($_POST['client_cart'] == 'purchase'):
                if (!is_null(CarrinhoDAO::buyCart($carrinho))) {
                    return;
                }
                break;
            default:
                Message::pop('procedimento cart falhou!');
                unset($_POST['client_cart']);
        }
        unset($_POST['client_cart']);
        Redirect::page($_SERVER['PHP_SELF'], 1, 'self');
    }
}
?>