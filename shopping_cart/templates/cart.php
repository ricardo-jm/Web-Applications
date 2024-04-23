<?php
$total = 0;
$pageTitle = 'Shopping Cart';
require_once '_header.php';
?>
<div class="row">
    <div class="col font-weight-bold text-center">
        Image
    </div>
    <div class="col font-weight-bold">
        Item
    </div>
    <div class="col font-weight-bold text-right">
        Price
    </div>
    <div class="col font-weight-bold text-center">
        Quantity
    </div>
    <div class="col font-weight-bold text-right">
        Subtotal
    </div>
    <div class="col font-weight-bold">
        Action
    </div>
</div>


<?php
foreach($cartItems as $id => $quantity):
    $product = $products[$id];
    $price = $product['price'];
    $subtotal = $quantity * $price;
    // update total
    $total += $subtotal;
    // format prices to 2 d.p.
    $price = number_format($price, 2);
    $subtotal = number_format($subtotal, 2);
?>

    <div class="row border-top">
        <div class="col product text-center">
            <img src="/images/small/<?= $product['image'] ?>" alt="<?= $product['image'] ?>">
        </div>
        <div class="col">
            <h4><?= $product['name'] ?></h4>
            <?= $product['description'] ?>
        </div>
        <div class="col price text-right align-self-center">
            $ <?= $price ?>
        </div>
        <div class="col text-center align-self-center">
            <form action="/?action=changeCartQuantity&id=<?= $id ?>" method="post">
                <button type="submit" name="amount" value="reduce" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-minus"></span>
                </button>
                <?= $quantity ?>
                <button type="submit" name="amount" value="increase"
                        class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </form>
        </div>
        <div class="col price text-right align-self-center">
            $ <?= $subtotal ?>
        </div>
        <div class="col align-self-center">
            <form action="/?action=removeFromCart&id=<?= $id ?>" method="post">
                <button class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span>Remove</button>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<div class="row border-top">
    <div class="col-10 price text-right">
        <?php
        $total = number_format($total, 2);
        ?>
        $ <?= $total ?>
    </div>
    <div class="col font-weight-bold ">
        Total
    </div>
</div>
</body>
</html>