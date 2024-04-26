<?php
session_start();
if($_SESSION['Active'] == false){
    header("location:login.php");
    exit;
}

try {
    require "../common.php";
    require_once '../src/DBconnect.php';
    $sql = "SELECT * FROM product";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>

<?php include "templates/header.php"; ?>

<body>
<!-- Products -->
<section  class="pt-4 bg-secondary">
    <div class="container-fluid py-4">
        <div class="row bg-secondary justify-content-center text-center align-items-center text-white pt-3">
            <?php foreach ($result as $products) { ?>
                <div class="col-lg-4 col-sm-6">
                    <img src="/Web_Apps_Project/Public/images/<?php echo $products['image']; ?>" class="img-rounded img-sales img-thumbnail">
                    <h2>
                        <?php echo $products['prodname']; ?>
                    </h2>

                    <h5><?php echo $products['category']; ?></span></h5>
                    <h5><?php echo 'Description: '. $products['proddescription']; ?></h5>
                    <h5><?php echo 'Price: '. $products['price']; ?>€</h5>
                    <a href="shopping_cart_2.php?code=<?php echo escape($products["id"]); ?>" class="home-link text-uppercase"> Add to cart </a>
                    <form method="post" action="shopping_cart_2.php?action=add&code=<?php echo $products["id"]; ?>">
                        <input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" />
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- End of Products -->

<?php include "templates/footer.php"; ?>

</body>
</html>
