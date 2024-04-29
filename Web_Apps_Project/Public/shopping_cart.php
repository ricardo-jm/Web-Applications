

<?php
$title = 'Shopping Cart';
include "templates/header.php";
require "../src/functions.php";

if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            addItemToCart($connection);
            break;
        case "remove":
            removeItemFromCart($connection);
            break;
        case 'changeCartQuantity':
            //Working change here
            changeCartQuantity($connection);
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
        <a id="btnEmpty" href="shopping_cart.php?action=empty" class="home-link text-uppercase mt-4">Empty Cart</a>
    </div>
</div>

<?php include "templates/footer.php"; ?>



