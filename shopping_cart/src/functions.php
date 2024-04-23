<?php
function getAllProducts()
{
    $products = [];
    $products['010'] = [
        'name' => 'Sandwich',
        'description' => 'A filling, savoury snack of peanut butter andjelly.',
        'price' => 1.00,
        'stars' => 4,
        'image' => 'peanut_butter.png'];
    $products['025'] = [
        'name' => 'Slice of cheesecake',
        'description' => 'Treat yourself to a chocolate covered cheesecakeslice.',
        'price' => 2.00,
        'stars' => 5,
        'image' => 'chocolate_cheese_cake.png'];
    $products['005'] = [
        'name' => 'Pineapple',
        'description' => 'A piece of exotic fruit.',
        'price' => 3.00,
        'stars' => 2,
        'image' => 'pineapple.png'];
    $products['021'] = [
        'name' => 'Jelly Donut',
        'description' => 'The best type of donut - filled with sweet jam.',
        'price' => 4.50,
        'stars' => 3,
        'image' => 'jellydonut.png'];
    $products['002'] = [
        'name' => 'Banana',
        'description' => 'The basis for a good smoothie and high inpotassium.',
        'price' => 0.50,
        'stars' => 5,
        'image' => 'banana.png'];
    return $products;
}

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
    $cartItems = getShoppingCart();
    $cartItems[$id] = 1;

    $_SESSION['cart'] = $cartItems;
}

function removeItemFromCart($id)
{
    $cartItems = getShoppingCart();
    unset($cartItems[$id]);
    $_SESSION['cart'] = $cartItems;
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

function displayProducts()
{
    $products = getAllProducts();
    require_once __DIR__ . '/../templates/list.php';
}

function displayCart()
{
    $products = getAllProducts();
    $cartItems = getShoppingCart();
    if(!empty($cartItems)){
        require_once __DIR__ . '/../templates/cart.php';
    } else {
        require_once __DIR__ . '/../templates/emptyCart.php';
    }
}