<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/title-img.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>SVDNS</title>
</head>

<?php

session_start();
if($_SESSION['Active'] == false){
    header("location:login.php");
    exit;
}else {
    $hidden_when_login = 'd-none';
    if($_SESSION['Username'] != 'admin') {
        $hidden_when_not_admin = 'd-none';
    }
}

require "../common.php";
require "../src/functions.php";
require_once '../src/DBconnect.php';


if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            if(!empty($_POST["quantity"])) {

                try {
                    $sql = "SELECT * FROM product WHERE id = :id2";
                    $statement = $connection->prepare($sql);
                    $statement->bindParam(':id2', $_GET["code"], PDO::PARAM_STR);
                    $statement->execute();
                    $productByCode = $statement->fetch(PDO::FETCH_ASSOC);
                    //var_dump($productByCode);
                    //die();
                } catch(PDOException $error) {
                    echo $sql . "<br>" . $error->getMessage();
                }

                //$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
                //Change here
                $itemArray = array($productByCode["id"]=>array('name'=>$productByCode["prodname"], 'code'=>$productByCode["id"], 'proddescription'=>$productByCode["proddescription"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode["price"], 'image'=>$productByCode["image"]));

                echo ' Before IF to add   ';
                //var_dump($_SESSION["cart_item"]);

                if(!empty($_SESSION["cart_item"])) {
                    if(in_array($productByCode["id"],array_keys($_SESSION["cart_item"]))) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            if($productByCode["id"] == $k) {
                                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                        echo ' After else to add   ';
                        var_dump($_SESSION["cart_item"]);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        case "remove":
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                    echo ' Session CODE in remove block    ';
                    var_dump($_GET["code"]);
                    if($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                        echo ' $k in remove    ';
                        var_dump($k);
                    echo ' After remove   ';
                    var_dump($_SESSION["cart_item"]);
                    if(empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case 'changeCartQuantity':
            $amount = filter_input(INPUT_POST, 'amount');
            if($amount == 'increase'){
                foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_GET["code"] == $k)
                        $_SESSION["cart_item"][$k]["quantity"] = $_SESSION["cart_item"][$k]["quantity"] + 1;
                    if(empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            } else {
                foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_GET["code"] == $k) {
                        $_SESSION["cart_item"][$k]["quantity"] = $_SESSION["cart_item"][$k]["quantity"] - 1;
                        if ($_SESSION["cart_item"][$k]["quantity"] == 0)
                            unset($_SESSION["cart_item"][$k]); //Completed
                    }
                    if(empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            //displayCart();
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}


if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;


    foreach($_SESSION["cart_item"] as $item):
        $item_price = $item["quantity"]*$item["price"];
        $total_quantity += $item["quantity"];
        $total_price += ($item["price"]*$item["quantity"]);
        ?>
        <div class="row border-top">
            <div class="col product text-center">
                <img src="/Web_Apps_Project/Public/images/<?= $item['image'] ?>" alt="<?= $item['image'] ?>" class="img-rounded img-sales img-thumbnail">
            </div>
            <div class="col">
                <?php //echo 'VARDUMP product'; var_dump($product['prodname']);?>
                <h4><?= $item['name'] ?></h4>
                <?= $item['proddescription'] ?>
                <?= $item['code'] ?>
            </div>
            <div class="col price text-right align-self-center">
                $ <?= $item["price"] ?>
            </div>
            <div class="col text-center align-self-center">
                <form action="?action=changeCartQuantity&code=<?= $item["code"] ?>" method="post">
                    <button type="submit" name="amount" value="reduce"
                            class="btn btn-secondary btn-sm">
                        <i class="fa fa-minus text-bg-secondary mx-3"></i>
                    </button>
                    <?= $item["quantity"] ?>
                    <button type="submit" name="amount" value="increase"
                            class="btn btn-secondary btn-sm">
                        <i class="fa fa-plus text-bg-secondary mx-3"></i>
                    </button>
                </form>
            </div>
            <div class="col price text-right align-self-center">
                $ <?= $total_price ?>
            </div>
            <div class="col align-self-center">
                <form   action="?action=remove&code=<?= $item["code"] ?>" method="post">
                    <button class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-remove"></span>Remove
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="row border-top">
        <div class="col-10 price text-right">
            <?php
            $total_price = number_format($total_price, 2);
            ?>
            € <?= $total_price ?>
        </div>
        <div class="col font-weight-bold ">
            Total
        </div>
    </div>
<?php } ?>
<div class="row border-top">
    <div class="col-10 text-center">
        <a href="products.php" class="home-link text-uppercase mt-4">Continue Shopping</a>
    </div>
</div>
</body>
</html>



