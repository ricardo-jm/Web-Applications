

<?php

include "templates/header.php";
require "../src/functions.php";



if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            if(!empty($_POST["quantity"])) {

                $productByCode = querySingleProduct($connection);

                $itemArray = array($productByCode["id"]=>array('name'=>$productByCode["prodname"], 'code'=>$productByCode["id"], 'proddescription'=>$productByCode["proddescription"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode["price"], 'image'=>$productByCode["image"]));

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
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        case "remove":
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);
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
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}



if(isset($_SESSION["cart_item"])){
    $subtotal = 0;
    $total_price = 0;


    foreach($_SESSION["cart_item"] as $item):
        $subtotal = ($item["price"]*$item["quantity"]);

        ?>
        <div class="row border-top mt-5 pt-5">
            <div class="col product text-center">
                <img src="/Web_Apps_Project/Public/images/<?= $item['image'] ?>" alt="<?= $item['image'] ?>" class="img-rounded img-sales img-thumbnail mt-4">
            </div>
            <div class="col">
                <h4><?= $item['name'] ?></h4>
                <?= $item['proddescription'] ?>
                : SKU <?= $item['code'] ?>
            </div>
            <div class="col price text-right align-self-center">
                € <?= $item["price"] ?>
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
                € <?= $subtotal ?>
            </div>
            <div class="col align-self-center">
                <form   action="?action=remove&code=<?= $item["code"] ?>" method="post">
                    <button class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-remove"></span>Remove
                    </button>
                </form>
            </div>
        </div>
        <?php $total_price += $subtotal;?>
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
<div class="row border-top my-5 pt-5">
    <div class="col-6 text-center">
        <a href="products.php" class="home-link text-uppercase mt-4">Continue Shopping</a>
    </div>
    <div class="col-6 text-center">
        <a id="btnEmpty" href="shopping_cart_2.php?action=empty" class="home-link text-uppercase mt-4">Empty Cart</a>
    </div>
</div>

<?php include "templates/footer.php"; ?>



