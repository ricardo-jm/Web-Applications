<?php

require "../common.php";


function validateLogin()
{
    try {
        //require "../common.php";
        require_once '../src/DBconnect.php';
        $password = escape($_POST['Password']);
        $username = strtolower(escape($_POST['Username']));
        $sql = "SELECT * FROM user WHERE username = :username";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, PDO::FETCH_ASSOC);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        #var_dump($user);

        if ($user && $statement->rowCount() > 0) {
            if (($user['username'] == $username) && ($user['pwd'] == $password)) {
                echo 'Username and Password are correct';

                $_SESSION['Username'] = $username; //store Username to the session
                $_SESSION['Active'] = true;
                header("location:index.php");
                exit; //we’ve just used header() to redirect to another page but we must terminate all current code so that it doesn’t run when we redirect
            } else echo 'Incorrect Username or Password';
        }else echo 'Incorrect Username or Password';
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function register()
{
    try {
        require_once '../src/DBconnect.php';
        echo "success";
        $new_user = array(
            "username" => strtolower(escape($_POST['username'])),
            "pwd" => escape($_POST['password']),
            "email" => escape($_POST['email']),
            "phone" => escape($_POST['phone'])
        );

        $sql = sprintf("INSERT INTO %s (%s) values (%s)", "user", implode(", ",
            array_keys($new_user)), ":" . implode(", :", array_keys($new_user)));
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function search()
{
    try {
        require_once '../src/DBconnect.php';
        $sql = "SELECT * FROM product WHERE prodname = :prodname";
        $prodname = $_POST['prodname'];
        $statement = $connection->prepare($sql);
        $statement->bindParam(':prodname', $prodname, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
    return $result;
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
    $id = $id - 1; // Product id passed in Get method starts with 1 and products array starts with 0 so adjusting value
    $cartItems = getShoppingCart();
    $cartItems[$id] = 1;
    $_SESSION['cart'] = $cartItems;
}

function removeItemFromCart($id)
{
    $cartItems = getShoppingCart();
    unset($cartItems[$id]);
    echo '    VARDUMP Cart items after remove:    ', "\n";

    var_dump($_SESSION['cart']);
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