<?php

session_start();
if($_SESSION['Active'] == false){
    header("location:login.php");
    exit;
}

if (isset($_GET["id"])) {
    try {
        require_once '../src/DBconnect.php';

        $id = $_GET["id"];

        $sql = "DELETE FROM product WHERE id = :id";

        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $success = "Product ". $id. " successfully deleted";
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

try {
    require "../src/functions.php";
    require_once '../src/DBconnect.php';
    $sql = "SELECT *
FROM product";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>

<?php include "templates/header.php"; ?>

<body>
<!-- Remove product -->
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
                        <a href="remove_product.php?id=<?php echo escape($products["id"]); ?> " class="home-link text-uppercase"> Remove </a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- End of Remove product -->

<?php include "templates/footer.php"; ?>

</body>
</html>