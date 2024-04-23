<?php

function getShoppingCart()
{
    // default is empty shopping cart array
    $cartItems = [];
    if(isset($_SESSION['cart'])){
        $cartItems = $_SESSION['cart'];
    }
    return $cartItems;
}

function addItemToCart($id)
{
    $id = $id - 1; // Product id passed in Get method starts with 1 and products array starts with 0 so adjusting value
    $cartItems = getShoppingCart();
    $cartItems[$id] = 1;
    $_SESSION['cart'] = $cartItems;
}

function removeItemFromCart($id)
{
    $cartItems = getShoppingCart();
    unset($cartItems[$id]);
    $_SESSION['cart'] = $cartItems;
    echo '    VARDUMP SESSION after remove:    ', "\n";
    var_dump($_SESSION['cart']);
}

function getQuantity($id, $cart)
{
    if(isset($cart[$id])){
        return $cart[$id];
    } else {return 0;}
}

function increaseCartQuantity($id)
{
    $cartItems = getShoppingCart();
    $quantity = getQuantity($id, $cartItems);
    $newQuantity = $quantity + 1;
    $cartItems[$id] = $newQuantity;
    $_SESSION['cart'] = $cartItems;
}

function reduceCartQuantity($id)
{
    $cartItems = getShoppingCart();
    $quantity = getQuantity($id, $cartItems);
    $newQuantity = $quantity - 1;
    if($newQuantity < 1){
        unset($cartItems[$id]);
    } else {
        $cartItems[$id] = $newQuantity;
    }
    $_SESSION['cart'] = $cartItems;
}

/*function displayCart()
{
    //$products = getAllProducts();
    $cartItems = getShoppingCart();
    if(!empty($cartItems)){
        require_once __DIR__ . '/../templates/cart.php';
    } else {
        require_once __DIR__ . '/../templates/emptyCart.php';
    }
}*/