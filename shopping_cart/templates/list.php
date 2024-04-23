<?php
$pageTitle = 'List of products';
?>

<?php require_once '_header.php'; ?>

<div class="row">
    <?php
    foreach($products as $id => $product):
        $price = number_format($product['price'], 2);
?>
        <div class="product col-md-2 text-center">
            <img src="/images/<?= $product['image'] ?>" alt="<?= $product['image'] ?>">

            <h4><?= $product['name'] ?></h4>
            <div class="price">
                $ <?= $price ?>
                <form method="post" action="/?action=addToCart&id=<?= $id ?>" style="display: inline">
                    <button class="btn btn-primary btn-sm">Add To Cart</button>
                </form>
            </div>
            <?= $product['description'] ?>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>

<?php
